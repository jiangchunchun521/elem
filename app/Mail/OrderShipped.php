<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    //声明一个仅供的属性用来存订单模型对象
    public $order;

    /**
     * OrderShipped constructor.
     * Create a new message instance.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        //从外部传入订单实例
        $this->order = $order;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this
            ->from("1272201461@qq.com")
            ->view('mail.order', ['order' => $this->order]);
    }
}
