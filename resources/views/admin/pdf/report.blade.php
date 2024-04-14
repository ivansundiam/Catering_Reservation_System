<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>report</title>

    <style>
        /* body{
            font-family: 'Noticia Text', serif;
        } */
        @font-face{
            font-family: 'Noticia Text';
            src: url('assets/fonts/Noticia_Text/NoticiaText-Regular.ttf');
        }
    </style>
</head>
<body>
    <div class="flex items-end my-2 ">
        <x-application-mark class="block" />
        <x-brand-name class="ml-2" />
    </div>

    <div class="w-full">
        {{-- <span class="ms-auto">{{ $date }}</span> --}}
        <span class="ms-auto">{{ date('M d, Y') }}</span>
    </div>

    <div class="flex justify-center">
        <h1>Reports</h1>
        {{-- <h1>{{ $title }}</h1> --}}
    </div>
</body>
</html>