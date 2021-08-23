@extends('auth.layouts')
@section('content')

  <p id='login_info'>Please confirm your password</p>

  <form class="form-horizontal" method='POST' action='{{ route("password.confirm") }}'>
    {{ csrf_field() }}

    <div class="form-group">
      <label for="password" class="col-md-4 control-label">Your password</label>

      <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" required autofocus autocomplete='off' />
      </div>
    </div>

    <div class="form-group" style="margin-top: 40px;">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                Confirm
            </button>
        </div>
    </div>

  </form>

@endsection
