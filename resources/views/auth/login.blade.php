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
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/dataTables/jquery.dataTables_themeroller.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <link href="{{ asset('css/print.css') }}?rev=20190529" rel="stylesheet" media='print'>

      <link rel='shortcut icon' href="{{ asset('favicon.ico') }}" type='image/x-icon' />

      <script type='text/JavaScript' src='/js/jquery-ui-1.10.4/jquery-1.10.2.js'></script>
      <script type='text/JavaScript' src='/js/jquery-ui-1.10.4/ui/jquery-ui.js'></script>
      <script type='text/JavaScript' src='/js/dataTables/jquery.dataTables.min.js'></script>
      <script type='text/JavaScript' src='/js/dataTables/sort.js'></script>
      <script type='text/JavaScript' src='/js/CJScript.js'></script>
      <script type='text/JavaScript' src='/js/script.js?rev=20190529'></script>
  </head>

  <body id='login_body'>
    <div id='login_div'>

      <h1>Vassar-Wesleyan Program in Paris</h1>
      <h2>Administrative Portal</h2>

      <img src="/img/header.jpg" alt="Header" />

      <p id='login_info'>Please provide your login information.</p>

      <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete='off' />

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required autocomplete='off' />

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group" style="margin-top: 50px;">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>
        </div>

      </form>

      <p id='login_p'>
        If you have not received a message with your information, please contact the Office of International Programs<br/> at <a href='http://internationalprograms.vassar.edu/contact/index.html' target='_blank' ><b>Vassar College</b></a> or the Office of International Studies at <a href='http://www.wesleyan.edu/ois/aboutus.html' target='_blank' ><b>Wesleyan University</b></a>.
      </p>

      <p id='login_links'>
        <a href='http://en.vwpp.org' target='_blank'>Return to VWPP's site in the US</a>
        <a href='http://fr.vwpp.org' target='_blank'>Return to VWPP's site in France</a>
      </p>
    </div>
  </body>

  <footer style='font-size:1.5em;'>
    <a href='http://www.jeromecombes.com' target='_blank'>Created by jeromecombes.com</a>
  </footer>
</html>
