<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminSendCodeNotification extends Notification
{
    use Queueable;

    private $user_code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_code)
    {
        $this->$user_code = $user_code;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];  
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
            ->subject(trans('New user from customer ' . $this->user_code))
            ->action(trans('user Page '), url(env('APP_URL') . '/admin/all_users'));
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
         
                "message" => trans("You've new user"),
                "user_code" => $this->user_code,
                // "customer_name" => $this->user->neme,
                // "seller_id" => $this->user->co
      
        ];
    }
}
