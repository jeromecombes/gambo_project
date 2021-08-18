<!doctype html>
  <html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>VWPP Database</title>

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}?rev=20210330" rel="stylesheet">
      <link href="{{ asset('css/jquery-ui.min.css') }}?rev=20210330" rel="stylesheet">
      <link href="{{ asset('css/dataTables/jquery.dataTables_themeroller.css') }}?rev=20210330" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}?rev=20210330" rel="stylesheet">
      <link href="{{ asset('css/print.css') }}?rev=20210330" rel="stylesheet" media='print'>

      <link rel='shortcut icon' href="{{ asset('favicon.ico') }}" type='image/x-icon' />

      <script type='text/JavaScript' src='/js/jquery-ui-1.10.4/jquery-1.10.2.js?rev=20210330'></script>
      <script type='text/JavaScript' src='/js/jquery-ui-1.10.4/ui/jquery-ui.js?rev=20210330'></script>
      <script type='text/JavaScript' src='/js/dataTables/jquery.dataTables.min.js?rev=20210330'></script>
      <script type='text/JavaScript' src='/js/dataTables/sort.js?rev=20210330'></script>
      <script type='text/JavaScript' src='/js/CJScript.js?rev=20210330'></script>
      <script type='text/JavaScript' src='/js/script.js?rev=20210330'></script>
  </head>

  <body id='login_body'>
    <div id='login_div'>

      <h1>Vassar-Wesleyan Program in Paris</h1>
      <h2>Administrative Portal</h2>

      <img src="/img/header.jpg" alt="Header" />

      <p id='login_info'>Please provide your 6 digits two factor authenfication code.</p>

      <form class="form-horizontal" method='POST' action='/two-factor-challenge'>
        {{ csrf_field() }}

        <div class="form-group">
          <label for="code" class="col-md-4 control-label">Code</label>

          <div class="col-md-6">
            <input id="code" type="text" class="form-control" name="code" required autofocus autocomplete='off' />
          </div>
        </div>

        <div class="form-group" style="margin-top: 50px;">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
        </div>

      </form>
    </div>
  </body>

  <footer style='font-size:1.5em;'>
    <a href='http://www.jeromecombes.com' target='_blank'>Created by jeromecombes.com</a>
  </footer>
</html>
