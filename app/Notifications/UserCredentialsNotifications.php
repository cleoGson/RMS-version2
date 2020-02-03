<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCredentialsNotifications extends Notification
{
   /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $passwdDetails;
    public $userName;
    public $emailDetails;
    public function __construct($passwdDetails,$emailDetails,$userName)
    {
        $this->passwdDetails = $passwdDetails;
        $this->emailDetails = $emailDetails;
        $this->userName = $userName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) 
    {
        return (new MailMessage)
                    ->subject('Result Management System CREDENTIALS')
                    ->greeting("Hello  $this->userName, Greetings!")
                    ->line("Your account 
                    has been created, Please use Your  USERNAME as : $this->emailDetails and  PASSWORD: 
                        <b>" . trim($this->passwdDetails) ."</b> as login Credentials")
                        ->action('Click to Login', route("login"));
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
