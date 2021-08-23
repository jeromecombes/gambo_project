<!doctype html>
  <html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>VWPP Database</title>

      <link href="{{ asset('css/app.css') }}?rev=20210330" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}?rev=20210330" rel="stylesheet">
      <link rel='shortcut icon' href="{{ asset('favicon.ico') }}" type='image/x-icon' />
  </head>

  <body id='login_body'>
    <div id='login_div'>

      <h1>Vassar-Wesleyan Program in Paris</h1>
      <h2>Administrative Portal</h2>

      <img src="/img/header.jpg" alt="Header" />
      @yield('content')

    </div>
  </body>

  <footer style='font-size:1.5em;'>
    <a href='http://www.jeromecombes.com' target='_blank'>Created by jeromecombes.com</a>
  </footer>
</html>
