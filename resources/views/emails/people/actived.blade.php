@extends('emails.layout')

@section('content')
    <p style="margin:0;-webkit-font-smoothing:antialiased;padding-bottom:20px;">
        <strong style="margin:0;-webkit-font-smoothing:antialiased">
            Olá {{ $person->name }},
        </strong>
        <br>
        Confirmamos que sua candidatura foi aprovada, um Diretor ou Máster entrará em contato para
        informações adicionais, formalizações e início imediato.
    </p>
    @if($referralLink)
    <p style="margin:0;-webkit-font-smoothing:antialiased;padding-bottom:20px;">
        Segue seu link de indicação: {{ $referralLink }}
    </p>
    @endif
    <p style="margin:0;-webkit-font-smoothing:antialiased;padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #eee">
        <strong style="margin:0;-webkit-font-smoothing:antialiased">
            Você foi indicado por
        </strong>
        <br>
        Nome: {{ $person->people->name }}<br>
        E-mail: {{ $person->people->email }}<br>
        Telefone: {{ $person->people->cellphone }}<br>
    </p>
@endsection
