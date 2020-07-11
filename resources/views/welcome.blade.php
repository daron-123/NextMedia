<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->

    </head>
    <body>

        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                <a class="navbar-brand" href="#">Lamalem Yasser</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name:'product.index'}">Produits</router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name:'category.index'}">Categories</router-link>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container">
                <router-view :key="$route.fullPath"></router-view>
            </div>
        </div>

        <script src="{{ asset("js/app.js") }}"></script>
    </body>


</html>
