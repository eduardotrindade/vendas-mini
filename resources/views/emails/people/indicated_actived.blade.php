@extends('emails.layout')

@section('content')
    <p style="margin:0;-webkit-font-smoothing:antialiased;padding-bottom:20px;">
        <strong style="margin:0;-webkit-font-smoothing:antialiased">
            Olá {{ $person->people->name }},
        </strong>
        <br>
        Confirmamos que a candidatura do {{ $person->name }} foi aprovada, entre em contato e forneça mais
        informações adicionais, formalizações e início imediato.
    </p>
    <p style="margin:0;-webkit-font-smoothing:antialiased;padding-bottom:20px;margin-bottom:20px;border-bottom:1px solid #eee">
        <strong style="margin:0;-webkit-font-smoothing:antialiased">
            Dados do Representante
        </strong>
        <br>
        Nome: {{ $person->name }}<br>
        E-mail: {{ $person->email }}<br>
        Telefone: {{ $person->cellphone }}<br>
    </p>
@endsection
