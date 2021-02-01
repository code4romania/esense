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
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];

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
        /** Extract the message. */
        $messageToReply = MessageModel::find(post('record_id'));

        /** Initialize the Form behavior. */
        $this->asExtension('FormController')->initForm($messageToReply);

        /** Add variables to view. */
        $this->vars['recordId'] = $messageToReply->id;
        $this->vars['email'] = $messageToReply->email;

        return $this->makePartial('reply_form');
    }


    /***********************************************
     **************** Reply to message *************
     ***********************************************/

    /**
     * Function that keeps the logic for Reply to messages
     * @return mixed
     */
    public function onReply()
    {
        /**
         * Extract the email value from the hidden field
         *  because default one is disabled.
         */
        $receiverEmail = post('email');

        /** Construct the email body message. */
        $bodyMessage = [
            'html' => post('Message[reply_message]'),
            'raw' => true
        ];

        $data = [
            'email' => post('email'),
            'message' => post('Message[reply_message]'),
        ];

        /** Try to SEND html email. */
        try {

            if ($this->validateReceiverEmail($receiverEmail)) {
                Mail::send($bodyMessage, $data, function ($message) use ($receiverEmail) {
                    $message->subject(Lang::get('genuineq.contactform::lang.backend.email.subject'));
                    $message->to($receiverEmail);
                });

                /* Set replied_at timestamp to the reply message and save the message in `reply_message` column*/
                $modelToUpdate = MessageModel::find(post('record_id'));
                $modelToUpdate->replied_at = Carbon::createFromTimestamp(time());
                $modelToUpdate->reply_message = $modelToUpdate->replied_at . "<br>" . implode(PHP_EOL, $data);
                $modelToUpdate->save();

                Flash::success(Lang::get('genuineq.contactform::lang.backend.flash.send_message.success'), 20);

                return $this->listRefresh();
            }

        } catch (\InvalidArgumentException $ex) {
            /* Write error to log and flash a message to admin frontend */
            Log::error('Invalid user email address in the message with id = ' . post('record_id') . '. Error: ' . $ex);
            Flash::error(Lang::get('genuineq.contactform::lang.backend.flash.invalid_email'), 20);
        }
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
        $domain = $parts[1];

        /* Check domain validity and throw an error if fails */
        if (! /* NOT */checkdnsrr($domain, 'MX')) {
            throw new \InvalidArgumentException('Invalid receiver email format: DOMAIN incorrect');
        } else {
            return true;
        }
    }
}
