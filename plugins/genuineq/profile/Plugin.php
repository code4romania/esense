<?php namespace Genuineq\Profile;

use Log;
use Lang;
use Mail;
use Event;
use System\Classes\PluginBase;
use Genuineq\User\Models\User;
use Genuineq\Profile\Models\School;
use Genuineq\Profile\Models\Specialist;
use Genuineq\Addresses\Models\City;
use Genuineq\Addresses\Models\County;


class Plugin extends PluginBase
{
    /**
     * @var array   Require the dependency plugins
     */
    public $require = [
        'Genuineq.User',
        'Genuineq.Addresses'
    ];

    /** Function for registering Profile component. */
    public function registerComponents()
    {
        return [
            \Genuineq\Profile\Components\ProfileStaticData::class => 'profileStaticData'
        ];
    }

    /** Function for registering Profile mail templates. */
    public function registerMailTemplates()
    {
        return [
            'genuineq.profile::mail.new_teacher',
        ];
    }

    public function boot()
    {
        /** Extend the "Genuineq\User\Models\User" model. */
        $this->userExtendRelationships();
        $this->userExtendBackendForm();
        $this->userExtendComponents();
    }

    /***********************************************
     ********** Register report widgets ************
     ***********************************************/

    public function registerReportWidgets()
    {
        return [
            'Genuineq\Profile\ReportWidgets\TotalSpecialists' => [
                'label'   => 'genuineq.profile::lang.reportwidgets.total_specialists.label',
                'context' => 'dashboard',
            ],
        ];
    }

    /***********************************************
     *************** User extensions ***************
     ***********************************************/

    /**
     * Function that performs all the relationships extensions of the User model.
     */
    protected function userExtendRelationships()
    {
        User::extend(function($model) {
            /** Link "Profile" model to user model. */
            $model->morphTo['profile'] = [];
        });
    }

    /**
     * Function that performs all the backend form extensions of the User model.
     */
    protected function userExtendBackendForm()
    {
        /** Listen to backend extend forms user. */
        Event::listen('backend.form.extendFields', function($widget) {
            /** Extend the user backend form. */
            if ($widget->model instanceof \Genuineq\User\Models\User) {

                /** Add an extra users profile_type text type field. */
                $widget->addFields([
                    'profile_type' => [
                        'label'    => 'genuineq.profile::lang.backendForm.user.profile_type.label',
                        'comment'  => 'genuineq.profile::lang.backendForm.user.profile_type.comment',
                        'type'     => 'text',
                        'span'     => 'auto',
                        'context'  => 'preview',
                    ],

                    /** Add an extra users profile_id text type field. */
                    'profile_id' => [
                        'label'    => 'genuineq.profile::lang.backendForm.user.profile_id.label',
                        'comment'  => 'genuineq.profile::lang.backendForm.user.profile_id.comment',
                        'type'     => 'text',
                        'span'     => 'auto',
                        'context'  => 'preview',
                    ]
                ]);
            }
        });
    }

    /**
     * Function that contains all the component extensions of the User component.
     */
    protected function userExtendComponents()
    {
        /** Add extra fields and validation rules. */
        Event::listen('genuineq.user.beforeValidate', function(&$data, &$rules, &$messages, $postData) {
            /** Check user type. */
            if ('school' == $postData['type']) {
                /** Add the school slug to be validated. */
                $data['slug'] = School::slug($postData['school_name']);
                /** Add the validation rules. */
                $rules['slug'] = 'required|unique:genuineq_profile_schools';
                /** Add the validation messages. */
                $messages['slug.required'] = Lang::get('genuineq.profile::lang.components.register.validation.slug_required');
                $messages['slug.unique'] = Lang::get('genuineq.profile::lang.components.register.validation.slug_unique');
            }
        });

        /** Create user profile after user registration. */
        Event::listen('genuineq.user.register', function($user, $data) {
            $profile = null;

            /** Create user profile based on user type. */
            if ('specialist' == $user->type) {
                $profile = new Specialist([
                    'slug' => Specialist::slug($user->full_name),
                    'phone' => $data['phone'],
                    'county_id' => $data['county'],
                    'city_id' => $data['city'],
                    'school_id' => null,
                    'description' => $data['description']
                    ]
                );
            } else {
                $profile = new School([
                    'name' => $data['school_name'],
                    'slug' => School::slug($data['school_name']),
                    'phone' => $data['phone'],
                    'county_id' => $data['county'],
                    'city_id' => $data['city'],
                    'description' => $data['description']
                ]);
            }
            /** Save the profile. */
            $profile->save();

            /** Link profile and user. */
            $user->profile = $profile;

            $user->save();
        });

        /** Notify a registered school that a teacher wants to register. */
        Event::listen('genuineq.user.notifySchool', function($data) {
            /** Extract the school. */
            $school = School::find($data['school']);
            /** Extract the school user. */
            $user =  $school->user;

            $data = [
                'name' => $school->contact_name,
                'school_name' => $school->name,
                'teacher_name' => $data['name'],
                'teacher_surname' => $data['surname'],
                'teacher_email' => $data['email'],
                'teacher_phone' => $data['phone'],
                'teacher_county' => County::find($data['county'])->name,
                'teacher_city' => City::find($data['city'])->name,
                'teacher_description' => $data['description'],
            ];

            Mail::send('genuineq.profile::mail.new_teacher', $data, function($message) use ($user) {
                $message->to($user->email, $user->full_name);
            });
        });
    }
}
