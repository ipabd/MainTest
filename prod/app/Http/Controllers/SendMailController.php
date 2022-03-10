<?php

namespace App\Http\Controllers;

use App\Mail\MainMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function send(Request $request, $prod)
    {
        $body = 'Добавлен продукт-' . $prod;
        try {
            Mail::to(env('MAIL_ADMIN'))->send(new MainMail($body));
        } catch (err $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }
}
