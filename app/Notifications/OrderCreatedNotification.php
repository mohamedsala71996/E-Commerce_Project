<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
       $name= $this->order->billing->name;
        return (new MailMessage)
                    ->subject("new order #{$this->order->number}")
                    ->greeting("Hi {$notifiable->name}")
                    ->line("A new order #{$this->order->number} created by {$name}.")
                    ->action('view order', url('/dashboard'))
                    ->line('Thank you for using our application!');
                    // ->view();
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $name= $this->order->billing->name;
        return [
            'order_id' => $this->order->id,
            'message' => "A new order #{$this->order->number} created by {$name}.",
            'url' => '/dashboard', 
            'icon'=>'fas fa-file'
        ];
    }
    public function toBroadcast(object $notifiable): array
    {
        $name= $this->order->billing->name;
        return [
            'order_id' => $this->order->id,
            'message' => "A new order #{$this->order->number} created by {$name}.",
            'url' => '/dashboard', 
            'icon'=>'fas fa-file'
        ];
    }
}
