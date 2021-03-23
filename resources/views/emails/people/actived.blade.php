@extends('emails.layout')

@section('content')
    <p style="margin:0;-webkit-font-smoothing:antialiased;padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #eee">
        <strong style="margin:0;-webkit-font-smoothing:antialiased">
            Olá {{ $name }},
        </strong>
        <br/>
        Confirmamos que sua candidatura foi aprovada, um Diretor ou Máster entrará em contato para
        informações adicionais, formalizações e início imediato.
    </p>
@endsection
