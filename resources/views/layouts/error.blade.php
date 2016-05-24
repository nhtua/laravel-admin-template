<!DOCTYPE html>
<html>
    <head>
        <title>ERROR</title>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,vietnamese' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Open Sans Condensed', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .message {
                font-size: 24px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
