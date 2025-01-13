<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderDelivered extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('An order has been confirmed as delivered.')
                    ->action('View Order', url('/admin/orders/'.$this->order->id))
                    ->line('Order ID: '.$this->order->id)
                    ->line('Customer: '.$this->order->user->name)
                    ->line('Total: $'.number_format($this->order->total, 2));
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'customer_name' => $this->order->user->name,
            'total' => $this->order->total,
        ];
    }
}

