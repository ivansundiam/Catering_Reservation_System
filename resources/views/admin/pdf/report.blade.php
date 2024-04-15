<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>

    <style>
        *{
            padding: 0;
            margin: 0;
        }
        body{
            font-family: 'arimo';
            margin: 0.7in 1in;
        }
        @font-face{
            font-family: 'Noticia Text';
            src: url({{ storage_path('fonts/Noticia_Text/NoticiaText-Regular.ttf') }});
        }

        .w-full{
            width: 100%;
        }
        .brand-logo{
            display: flex;
            align-items: center;
        }

        .logo {
            max-width: 56px;
            width: 100%;
        }

        .info {
            font-family: 'serif';
            line-height: 1.5;
            text-transform: uppercase;
        }

        .title {
            font-size: 1.2rem;
            letter-spacing: 0.05em;
        }

        .subtitle {
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }
        
        .text-end{
            text-align: right;
        }

        table tr td{
            /* border: 1px black solid; */
        }

    </style>
</head>
<body>
    <header>
        <table class="w-full">
            <tr>
                <td style="width: 56px; padding-right: 5px">
                     <img src="{{ public_path("assets/images/logo-black.png") }}" class="logo" width="56px" alt="Brand logo">
                </td>
                <td>
                    <div class="info">
                        <p class="title">robert camba's</p>
                        <p class="subtitle">catering services</p> 
                    </div>
                </td>
                <td class="text-end">
                    <span >{{ $date }}</span>
                </td>
            </tr>
        </table>
        <div class="brand-logo">
            
        </div>
    </header>
    <main>
        <div class="w-full">
        </div>
    
        <div class="flex justify-center">
            <p>{{ $title }}</p>
        </div>
    </main>
</body>
</html>