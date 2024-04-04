<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #f5ebdb;
                color: #636b6f;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
                display: flex;
                align-items: center;
                flex-direction: column;
                line-height: 4rem;
            }

            .code{
                font-size: 5rem;
                font-weight: bold;
            }

            .title {
                font-size: 36px;
                padding-bottom: 20px;
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="max-w-[25rem] w-full">
                    <img src="{{ asset('assets/coffee-spill-animation.gif') }}" alt="">
                    {{-- <svg width="101px" height="101px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 17C9.85038 16.3697 10.8846 16 12 16C13.1154 16 14.1496 16.3697 15 17" stroke="#636b6f" stroke-width="1.5" stroke-linecap="round"></path> <ellipse cx="15" cy="10.5" rx="1" ry="1.5" fill="#636b6f"></ellipse> <ellipse cx="9" cy="10.5" rx="1" ry="1.5" fill="#636b6f"></ellipse> <path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8" stroke="#636b6f" stroke-width="1.5" stroke-linecap="round"></path> </g></svg> --}}
                </div>
                <div class="code">
                    @yield('code')
                </div>
                <div class="title">
                    @yield('message')
                </div>
                <button onclick="window.history.back();" class="shadow-md btn-primary">Go back</button>
            </div>
        </div>
    </body>
</html>
