<?php

namespace App\Http\Controllers;

use App\Mail\IWantMoreInfomation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function iWantMoreInfomation(Request $request)
    {
        Mail::send(new IWantMoreInfomation(
            $request->get('numberWhatsApp'),
            $request->get('name'),
            $request->get('city'),
            $request->get('email')
        ));

        return response()->json(['message' => 'Em breve entramos em contato.']);
    }
}
