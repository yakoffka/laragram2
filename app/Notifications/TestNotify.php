<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TestNotify extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private $parentMethod;

    /**
     * Create a new notification instance.
     *
     * @param string $parentMethod
     */
    public function __construct(string $parentMethod)
    {
        $this->parentMethod = $parentMethod;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // dd($notifiable, $this->parentMethod);
        return [/*'mail', */TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    /**
     * @param $notifiable
     * @return mixed
     */
    public function toTelegram($notifiable)
    {
        $return = TelegramMessage::create()
            // Optional recipient user id.
            //->to($notifiable->telegram_user_id)
            // Markdown supported.
            ->content("Hello there!\nYour invoice has been *PAID*")
            // (Optional) Inline Buttons
            //->button('View Invoice', $url)
            //->button('Download Invoice', $url)
        ;

        dd($return);
        return $return;
    }
}
