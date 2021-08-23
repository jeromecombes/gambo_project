@extends('auth.layouts')
@section('content')

  <p id='login_info'>Please provide your login information</p>

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

  <p id='login_p'>
    If you have not received a message with your information, please contact the Office of International Programs<br/> at <a href='http://internationalprograms.vassar.edu/contact/index.html' target='_blank' ><b>Vassar College</b></a> or the Office of International Studies at <a href='http://www.wesleyan.edu/ois/aboutus.html' target='_blank' ><b>Wesleyan University</b></a>.
  </p>

  <p id='login_links'>
    <a href='http://en.vwpp.org' target='_blank'>Return to VWPP's site in the US</a>
    <a href='http://fr.vwpp.org' target='_blank'>Return to VWPP's site in France</a>
  </p>

  </form>

@endsection
