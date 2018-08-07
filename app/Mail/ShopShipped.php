<?php

namespace App\Mail;

use App\Models\EventPrize;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShopShipped extends Mailable
{
    use Queueable, SerializesModels;
    //声明一个仅供的属性用来存订单模型对象
    public $shop;

    /**
     * PrizeShipped constructor.
     * @param Shop $shop
     */
    public function __construct(Shop $shop)
    {
        //从外部传入订单实例
        $this->shop = $shop;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this
            ->from("1272201461@qq.com")
            ->view('mail.shop', ['shop' => $this->shop]);
    }
}
