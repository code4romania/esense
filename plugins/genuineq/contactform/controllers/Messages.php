<?php namespace Genuineq\ContactForm\Controllers;

use Mail;
use BackendMenu;
use Carbon\Carbon;
use Backend\Classes\Controller;
use Genuineq\ContactForm\Models\Message as MessageModel;
use Egulias\EmailValidator\Exception\DomainAcceptsNoMail as DomainException;

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

        return $this->makePartial('reply_form');

    }

    /**
     * Function that keep the logic for Reply to messages
     * @return mixed
     */
    public function onReply()
    {

        $email = post('email'); /* Email value from hidden field, because in view is disabled */
        $message = post('Message[message]');

        $bodyMessage =  [
            'text' => $message,
            'raw' => true
        ];

        $data = [
            'email' => post('email'),
            'message' => strip_tags(post('Message[message]')),
        ];

        /* SEND email */
        try {
            Mail::send($bodyMessage, $data, function ($message2) use ($email) {
                $message2->to($email);
            });
        }catch (DomainException $ex) {
            $this->vars['error'] = $ex->getMessage();
        }


        /* Create/Save reply message to database */
        MessageModel::create([
            'first_name' => '',
            'last_name' => '',
            'email' => $email,
            'message' => $message,
            'replied_at' => time(),
        ]);


        /* Set replied_at timestamp on message to the reply message */
        $modelToUpdate = MessageModel::find(post('record_id'));
        $modelToUpdate->replied_at = Carbon::createFromTimestamp(time());
        $modelToUpdate->save();


        return $this->listRefresh();
    }


}
