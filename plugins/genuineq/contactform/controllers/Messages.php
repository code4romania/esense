<?php namespace Genuineq\ContactForm\Controllers;

use Log;
use Lang;
use Mail;
use Flash;
use BackendMenu;
use Carbon\Carbon;
use Backend\Classes\Controller;
use Genuineq\ContactForm\Models\Message as MessageModel;

class Messages extends Controller
{
    public $implement = ['Backend\Behaviors\ListController', 'Backend\Behaviors\FormController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.ContactForm', 'contactform', 'messages');
    }


    /**
     * Function that show replyForm at click on a list item
     * @return false|mixed
     */
    public function onReplyForm()
    {
        /*Get the selected record ID */
        $this->asExtension('FormController')->update(post('record_id'));

        /* Get all model fields */
        $messageToReply = MessageModel::find(post('record_id'));

        /* Add variables to view */
        $this->vars['recordId'] = $id = $messageToReply->id;
        $this->vars['first_name'] = $first_name = $messageToReply->first_name;
        $this->vars['last_name'] = $last_name = $messageToReply->last_name;
        $this->vars['email'] = $email = $messageToReply->email;
        $this->vars['message'] = $message = $messageToReply->message;

        return $this->makePartial('reply_form', [$first_name, $last_name, $email, $message]);

    }


    /***********************************************
     ************* Reply to the message ************
     ***********************************************/

    /**
     * Function that keeps the logic for Reply to messages
     * @return mixed
     */
    public function onReply()
    {

        $receiverEmail = post('email'); /* Email value from hidden field, because in view is disabled */
        $messageToReply = wordwrap(post('Message[message]'), 70); /* Wrap  text to 70 chars line long */

        $bodyMessage = [
            'text' => $messageToReply,
            'raw' => true
        ];

        $data = [
            'email' => post('email'),
            'message' => strip_tags(post('Message[message]')),
        ];

        /* try to SEND email */
        try {

            if ($this->validateReceiverEmail($receiverEmail)) {
                Mail::send($bodyMessage, $data, function ($message) use ($receiverEmail) {
                    $message->subject(Lang::get('genuineq.contactform::lang.backend.email.subject'));
                    $message->to($receiverEmail);
                });

                /* Create/Save reply message to database if no errors occurs */
                MessageModel::create([
                    'first_name' => 'Admin', /* required / can be empty string, but not NULL */
                    'email' => $receiverEmail,
                    'message' => $messageToReply,
                ]);

                /* Set replied_at timestamp to the reply message */
                $modelToUpdate = MessageModel::find(post('record_id'));
                $modelToUpdate->replied_at = Carbon::createFromTimestamp(time());
                $modelToUpdate->save();

            }

        } catch (\InvalidArgumentException $ex) {

            /* Write error to log and flash a message to admin frontend */
            Log::error('Invalid user email address at message with id = ' . post('record_id') . '. Error: ' . $ex);
            Flash::error(Lang::get('genuineq.contactform::lang.backend.flash.invalid_email'), 20);
        }

        return $this->listRefresh();
    }


    /***********************************************
     ********** Email validation function **********
     ***********************************************/

    /**
     * Function that validate email address from the message you want to reply
     * @param $receiverEmail
     * @return bool
     */
    private function validateReceiverEmail($receiverEmail)
    {
        $parts = explode("@", $receiverEmail);

        /* Extract domain name from email address */
        $domain = $parts[1] /*. '.'*/;

        /* Check domain validity and throw an error if fails */
        if (! /* NOT */checkdnsrr($domain, 'MX')) {
            throw new \InvalidArgumentException('Invalid receiver email format: DOMAIN incorrect');
        }else{
            return true;
        }

    }


}
