<?php

namespace App\Mail;

use App\Models\EventPrize;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PrizeShipped extends Mailable
{
    use Queueable, SerializesModels;
    //声明一个仅供的属性用来存订单模型对象
    public $prize;

    /**
     * PrizeShipped constructor.
     * @param EventPrize $prize
     */
    public function __construct(EventPrize $prize)
    {
        //从外部传入订单实例
        $this->prize = $prize;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this
            ->from("1272201461@qq.com")
            ->view('mail.prize', ['prize' => $this->prize]);
    }
}
