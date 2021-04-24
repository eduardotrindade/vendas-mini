<?php

namespace App\Http\Controllers;

use App\Gateway\ContaAzul\ContaAzul;
use Illuminate\Http\Request;

class ContaAzulController extends Controller
{
    public function auth()
    {
        return response()->json(['redirect_authorize' => ContaAzul::auth()->authorize()]);
    }

    public function token(Request $request)
    {
        ContaAzul::auth()->token($request->get('code'));

        return redirect(url('/admin'));
    }

    public function refreshToken()
    {
        ContaAzul::auth()->getAccessToken();

        return response()->json(['message' => 'Token renovado']);
    }
}
