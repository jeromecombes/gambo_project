@extends('layouts.myApp')
@section('content')

  <h3>{{ $user->firstname }} {{ $user->lastname }}</h3>

  <fieldset>
    <form name='form' action='{{ route("user.update") }}' method='post' onsubmit='return ctrl_form2("{{ $user->email }}");'>
      <input type='hidden' name='id' id='id' value='{{ $user->id }}' />
      @csrf

      <div>
        <strong><u>General information</u></strong>

        <table id='myTab2' border='0' style='width:100%; margin-top:25px;'>

          <tr>
            <td style='width:30%;'>
              <label for='lastname'>Last name</label>
            </td>
            <td style='width:40%;'>
              {!! Form::text('lastname', $user->lastname, ['id' => 'lastname']) !!}
            </td>
            <td></td>
          </tr>

          <tr>
            <td>
              <label for='firstname'>First name</label>
            </td>
            <td>
              {!! Form::text('firstname', $user->firstname, ['id' => 'firstname']) !!}
            </td>
          </tr>

          <tr>
            <td>
              <label for='email'>Email</label>
            </td>
            <td>
              {!! Form::email('email', $user->email, ['id' => 'email']) !!}
            </td>
          </tr>

          <tr>
            <td>
              <label for='university'>University</label>
            </td>
            <td>
              {!! Form::select('university', array('' => '', 'Vassar' => 'Vassar', 'Wesleyan' => 'Wesleyan', 'VWPP' => 'VWPP'), $user->university) !!}
            </td>
          </tr>

          @if ($user->id)
            <tr>
              <td>
                <label for='password_checkbox'>Change password</label>
              </td>
              <td>
                {!! Form::checkbox('password_checkbox', 'on', false, ['id' => 'password_checkbox', 'onclick' => 'change_password(this);']) !!}
              </td>
            </tr>
          @endif

          <tr id='tr_password' @if ($user->id) style='display:none;' @endif>
            <td>
              <label for='password'>Password</label>
            </td>
            <td>
              {!! Form::password('password', $password_attributes) !!}
            </td>
            <td style='color:red;' id='passwd1'></td>
          </tr>
          <tr id='tr_password_confirmation' @if ($user->id) style='display:none;' @endif>
            <td>
              <label for='password2'>Retype password</label>
            </td>

            <td>
              {!! Form::password('password_confirmation', $password_attributes) !!}
            </td>
            <td style='color:red;' id='passwd2'></td>
          </tr>

          <tr>
            <td>
              <label for='language'>Language</label>
            </td>
            <td>
              {!! Form::select('language', array('en' => 'English', 'fr' => 'Français'), $user->language) !!}
            </td>
          </tr>

          <tr>
            <td>
              <label for='alerts'>E-mail alerts ?</label>
            </td>
            <td>
              {!! Form::checkbox('alerts', '1', $user->alerts, ['id' => 'alerts']) !!}
            </td>
          </tr>

        </table>
      </div>

      <div style='margin-top:50px;height: 300px;'>
        <label><u>Access</u></label>
        <br/>

        <div style='margin:20px 0 0 0;display:inline-block; width:30%;vertical-align:top;'>

          @foreach ($accesses as $key => $access)
            {!! Form::checkbox('access[]', $access[0], in_array($access[0], $user->access), ['id' => 'access' . $access[0]]) !!}
            {!! Form::label('access' . $access[0], $access[1]) !!}
            <br/>
            @if ($key == 7 or $key == 15)
              </div>
              <div style='margin:20px 0 0 0;display:inline-block; width:30%;vertical-align:top;'>
            @endif
          @endforeach
        </div>
      </div>

      <div style='margin:20px; text-align:right;'>

        {!! Form::button('Cancel', ['onclick' => 'location.href="' . route('users.index') . '";', 'class' => 'btn']) !!}

        @if (in_array(12, Auth::user()->access) and $user->id)
          {!! Form::button('Delete', ['onclick' => "user_delete($user->id)", 'class' => 'btn']) !!}
        @endif

        {!! Form::submit($user->id ? 'Update' : 'Add', ['class' => 'btn btn-primary']) !!}

      </div>

    </form>
  </fieldset>

@endsection
