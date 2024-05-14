<!DOCTYPE html>
<html>
    <head>
        <title>BotMan Widget</title>
        <meta charset="UTF-8" />
        {{-- <link
            rel="stylesheet"
            type="text/css"
            href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"
        /> --}}

        <link rel="stylesheet" href="assets/css/chat.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body >
        <script>
            var botmanWidget = {
                title: 'Chat with Robert',
                frameEndpoint: '/botman-frame',
                // bubbleAvatarUrl: "https://cdn.icon-icons.com/icons2/3251/PNG/512/chat_help_regular_icon_202982.png",
                aboutText: "Robert Camba's Catering Services",
                introMessage:
                    "Welcome to Robert Camba's Catering Services. Ask me a question if you need help.",
                mainColor: "#1f2937",
                bubbleBackground: "#1f2937",
                headerTextColor: "#fff",
            };            
        </script>

        <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js" defer></script>
     
    </body>
</html>
