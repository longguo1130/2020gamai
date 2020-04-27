<?php

namespace App\Notifications;

use App\Product;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SentBid extends Notification implements  ShouldQueue
{
    use Queueable;
    protected $buyer;
    protected $bid;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $buyer,$bid)
    {
        //
        $this->buyer = $buyer;
        $this->bid = $bid;


    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

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

    public function toDatabase($notifiable)
    {
        if ($this->buyer->id==$this->bid->buyer_id)
            return [
                'buyer_id' => $this->buyer->id,
                'buyer_name' => $this->buyer->name,
                'product_id' =>$this->bid->product_id,
                'message'=>"Your product:".Product::find($this->bid->product_id)->title."has received bid from:".$this->buyer->username,
            ];
        else {
            if ($this->bid->status == 2)
                return [
                    'buyer_id' => $this->buyer->id,
                    'buyer_name' => $this->buyer->name,
                    'product_id' => $this->bid->product_id,
                    'message' => "Your bid accepted to " . Product::find($this->bid->product_id)->title . "by" . $this->buyer->username,
                ];
            else
                return [
                    'buyer_id' => $this->buyer->id,
                    'buyer_name' => $this->buyer->name,
                    'product_id' => $this->bid->product_id,
                    'message' => "Your bid was not accepted to " . Product::find($this->bid->product_id)->title . "by" . $this->buyer->username,
                ];
        }


    }
    public function toBroadcast($notifiable)
    {
        if ($this->buyer->id==$this->bid->buyer_id)
            return [
                'buyer_id' => $this->buyer->id,
                'buyer_name' => $this->buyer->name,
                'product_id' =>$this->bid->product_id,
                'message'=>"Your product:".Product::find($this->bid->product_id)->title."has received bid from:".$this->buyer->username,
            ];
        else {
            if ($this->bid->status == 2)
                return [
                    'buyer_id' => $this->buyer->id,
                    'buyer_name' => $this->buyer->name,
                    'product_id' => $this->bid->product_id,
                    'message' => "Your bid accepted to " . Product::find($this->bid->product_id)->title . "by" . $this->buyer->username,
                ];
            else
                return [
                    'buyer_id' => $this->buyer->id,
                    'buyer_name' => $this->buyer->name,
                    'product_id' => $this->bid->product_id,
                    'message' => "Your bid was not accepted to " . Product::find($this->bid->product_id)->title . "by" . $this->buyer->username,
                ];
        }
    }
}
