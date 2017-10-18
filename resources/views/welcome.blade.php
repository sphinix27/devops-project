<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DevOps API</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <div id="app">
            <v-app>
                <nav class="toolbar toolbar--fixed theme--dark indigo" id="main-toolbar" style="margin-top: 0px; padding-left: 0px; padding-right: 0px;">
                    <div class="toolbar__content" style="height: 64px;">
                        <div class="toolbar__title d-flex" style="position: relative;">Employees
                        </div>
                    </div>
                </nav>
                <div class="content" style="padding: 64px 0px 0px;">
                    <employee></employee>
                </div>
            </v-app>
        </div>
        <script src="js/app.js"></script>
    </body>
</html>
