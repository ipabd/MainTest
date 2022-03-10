<?php

namespace App\Jobs;

use App\Mail\MainMail;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $product;

    public function __construct($product)
    {
        $this->product = 'Добавлен продукт!!!' . $product;
    }

    public function handle()
    {
        $body = $this->product;
        Mail::to(env('MAIL_ADMIN'))->send(new MainMail($body));
    }
}