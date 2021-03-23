<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <style>.email-link:visited {
            color: #0070c9;
            text-decoration: underline;
            font-weight: bold
        }

        a:visited {
            color: #0070c9;
            text-decoration: underline;
            font-weight: bold
        }</style>
</head>
<body>
<div
    style="margin:0;-webkit-font-smoothing:antialiased;color:#333333;background-color:#ffffff;margin:0;font-family:system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica Neue, Helvetica, Arial, sans-serif;-webkit-font-smoothing:antialiased;">
    <table align="center" cellpadding="0" cellspacing="0"
           style="margin:0;-webkit-font-smoothing:antialiased;color:#333333;max-width:685px;padding:0px 20px;margin:38px auto 0px auto;">
        <tbody style="margin:0;-webkit-font-smoothing:antialiased">
        <tr style="margin:0;-webkit-font-smoothing:antialiased">
            <td style="margin:0;-webkit-font-smoothing:antialiased;padding:0;text-align:left;font-family:system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica Neue, Helvetica, Arial, sans-serif;font-size:17px;-webkit-font-smoothing:antialiased;line-height:26px;">

                @yield('content')

                <p style="margin:0;-webkit-font-smoothing:antialiased;padding-bottom:10px;margin-bottom:10px;">
                    Atenciosamente, <br/>
                    My Card City
                </p>

                <a style="margin:0;-webkit-font-smoothing:antialiased;color:#0070c9;text-decoration:underline;font-weight:bold;padding-top:20px;padding-bottom:20px;"
                   href="https://play.google.com/store/apps/details?id=net.mycardcity">
                    Baixe o APP MINISITIO grátis
                </a>
                <div style="margin:0;-webkit-font-smoothing:antialiased;font-size:12px;color:#777777;">
                    <p>E-mail gerado automaticamente, favor não responder.</p>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
