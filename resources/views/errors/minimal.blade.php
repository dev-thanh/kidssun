<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="shortcut icon" href="{{ getOptions('general', 'favicon') }}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/mobilemenu.css">
        <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/slick.css">
        <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/all.fontawesome.min.css">
        <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/styles.css">
	    <link rel="stylesheet" type="text/css" title="" href="{{ __BASE_URL__ }}/css/reponsive.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
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

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        {{-- <div class="flex-center position-ref full-height">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>
        </div> --}}
    </body>
</html>
