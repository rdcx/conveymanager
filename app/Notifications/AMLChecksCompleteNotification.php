<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ConveyancingCase;

class AMLChecksCompleteNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $conveyancingCase;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\ConveyancingCase  $conveyancingCase
     * @return void
     */
    public function __construct(ConveyancingCase $conveyancingCase)
    {
        $this->conveyancingCase = $conveyancingCase;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];  
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
                    ->subject('AML Checks Completed')
                    ->line('The AML checks for conveyancing case ' . $this->conveyancingCase->id . ' have been completed.')
                    ->action('View Case', url('/conveyancing-cases/' . $this->conveyancingCase->id))
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
            'case_id' => $this->conveyancingCase->id,
            'message' => 'AML checks have been completed for conveyancing case ' . $this->conveyancingCase->id,
        ];
    }
}