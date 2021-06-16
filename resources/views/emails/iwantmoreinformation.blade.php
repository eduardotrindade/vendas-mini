@extends('emails.layout')

@section('content')
    <p style="margin:0;-webkit-font-smoothing:antialiased;padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #eee">
        <strong style="margin:0;-webkit-font-smoothing:antialiased">Olá,</strong>
        <br/>
        Meu WhatsApp é: {{ $whatsapp }}
    </p>
@endsection
