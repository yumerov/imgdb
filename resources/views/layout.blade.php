<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Laravel {{ app()->version() }}</title>

      <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
<body>
  <section class="hero is-fullheight is-default is-bold">
  <div class="hero-head">
    <nav class="navbar">
      <div class="container">
        <div class="navbar-brand">
          <a class="navbar-item" href="../">
            <img src="../images/bulma.png" alt="Logo">
          </a>
          <span class="navbar-burger burger" data-target="navbarMenu">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </div>
        <div id="navbarMenu" class="navbar-menu">
          <div class="navbar-end">
            <a class="navbar-item" href="{{ route("images.index") }}">
              Images
            </a>
            <a class="navbar-item" href="{{ route("tags.index") }}">
              Tags
            </a>
            <a class="navbar-item" href="{{ route("tags.create") }}">
              Create tag
            </a>
          </div>
        </div>
      </div>
    </nav>
  </div>
    <div class="hero-body">
      <div class="container">
          @yield("main")
      </div>
    </div>

    <div class="hero-foot">
      <div class="container">
        <div class="tabs is-centered">
          <ul>
            <li><a>And this at the bottom</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <script async type="text/javascript" src="../js/bulma.js"></script>
</body>
</html>
