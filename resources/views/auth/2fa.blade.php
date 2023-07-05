@extends('auth.layouts')
@section('content')

  <p id='login_info'>
    Please provide your 6 digits two factor authenfication code.<br/>
    We sent your code to your email address ({{ auth()->user()->partialEmail }})
  </p>

  <form class="form-horizontal" method="POST" action="{{ route('2fa.post') }}">
    {{ csrf_field() }}

    @if ($message = Session::get('success'))
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
          </div>
        </div>
      </div>
    @endif

    @if ($message = Session::get('error'))
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
          </div>
        </div>
      </div>
    @endif

    <div class="form-group">
      <label for="code" class="col-md-4 control-label">6 digits code</label>

      <div class="col-md-6">
        <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

        @error('code')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="form-group" style="margin-top: 50px;">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">
          Login
        </button>

        <a class="btn btn-link" href="{{ route('2fa.resend') }}">Resend Code?</a>
      </div>
    </div>

  </form>

@endsection
