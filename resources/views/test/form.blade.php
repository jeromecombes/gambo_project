@extends('layouts.myApp')
@section('content')

<div>
  <h3>Test form 1</h3>

  <fieldset>
    {!! Form::open(['route' => 'test.form', 'name' => 'form', 'onsubmit' => 'return someJSFunction();']) !!}
      <div>
        {!! Form::hidden('id', 120) !!}
        {!! Form::hidden('hidden_input_name', 'value', ['id' => 'hidden_input_id']) !!}

        <table>
          <tr>
            <td>
              {!! Form::label('lastname', 'Lastname') !!}
            </td>
            <td>
              {!! Form::text('lastname', 'A lastname', ['id' => 'lastname', 'required']) !!}
            </td>
            <td class='bold red'>
              @if ($errors->has('lastname'))
                {{ $errors->first('lastname') }}
              @endif
            </td>
          </tr>

          <tr>
            <td>
              {!! Form::label('firstname', 'Firstname') !!}
            </td>
            <td>
              {!! Form::text('firstname', 'A firstname', ['id' => 'firstname', 'required']) !!}
            </td>
            <td class='bold red'>
              @if ($errors->has('firstname'))
                {{ $errors->first('firstname') }}
              @endif
            </td>
          </tr>

          <tr>
            <td>
              {!! Form::label('email', 'Email', ['class' => 'email_label_class']) !!}
            </td>
            <td>
              {!! Form::email('email', old('email'), ['id' => 'email_id', 'required', 'class' => 'email_class']) !!}
            </td>
            <td class='bold red'>
              @if ($errors->has('email'))
                {{ $errors->first('email') }}
              @endif
            </td>
          </tr>

          <tr>
            <td>
              {!! Form::label('university', 'University') !!}
            </td>
            <td>
              {!! Form::select('university', array('' => '', 'Vassar' => 'Vassar', 'Wesleyan' => 'Wesleyan', 'VWPP' => 'VWPP'), old('university'), ['required']) !!}
            </td>
            <td class='bold red'>
              @if ($errors->has('university'))
                {{ $errors->first('university') }}
              @endif
            </td>
          </tr>

          <tr>
            <td>
              {!! Form::label('password_checkbox', 'Change password') !!}
            </td>
            <td>
              {!! Form::checkbox('password_checkbox', 'on', false, ['id' => 'password_checkbox', 'onclick' => 'change_password();', 'class' => 'password_checkbox test_class']) !!}
            </td>
          </tr>

          <tr id='tr_password'>
            <td>
              {!! Form::label('password', 'Password') !!}
            </td>
            <td>
              {!! Form::password('password', ['onkeyup' => 'password_ctrl(this);', 'onblur' => 'password_ctrl(this);', 'required']) !!}
              <br/>
              {!! Form::password('password_disabled', ['id' => 'password_id', 'disabled' => 'disabled']) !!}
            </td>
            <td id='passwd1' class='bold red'>
              @if ($errors->has('password'))
                {{ $errors->first('password') }}
              @endif
            </td>
          </tr>
          <tr id='tr_password_confirmation'>
            <td>
              <label for='password2'>Retype password</label>
            </td>

            <td>
              {!! Form::password('password_confirmation', ['onkeyup' => 'password_ctrl(this);', 'onblur' => 'password_ctrl(this);', 'required']) !!}
            </td>
            <td></td>
          </tr>

          <tr>
            <td>
              <label for='language'>Language</label>
            </td>
            <td>
              {!! Form::select('language', array('en' => 'English', 'fr' => 'Français'), 'fr') !!}
            </td>
          </tr>

          <tr>
            <td>
              <label for='alerts'>E-mail alerts ?</label>
            </td>
            <td>
              {!! Form::checkbox('alerts', '1', '1', ['id' => 'alerts_id']) !!}
            </td>
          </tr>

        </table>
      </div>

      <div style='margin-top:50px;height: 300px;'>
        <label><u>Access</u></label>
        <br/>

        <div style='margin:20px 0 0 0;display:inline-block; width:30%;vertical-align:top;'>

          {!! Form::checkbox('access[]', 'on', true, ['id' => 'access0']) !!}
          {!! Form::label('access0', 'Access 0') !!}
          {!! Form::checkbox('access[]', 'on', true, ['id' => 'access1']) !!}
          {!! Form::label('access1', 'Access 1') !!}
          {!! Form::checkbox('access[]', 'on', false, ['id' => 'access2']) !!}
          {!! Form::label('access2', 'Access 2') !!}

          <br/>
          {!! Form::radio('radio_name', 'yes', true, ['id' => 'radio1', 'class' => 'radio_class']) !!}
          {!! Form::label('radio1', 'Radio 1') !!}
          {!! Form::radio('radio_name', 'no', false, ['id' => 'radio2', 'class' => 'radio_class']) !!}
          {!! Form::label('radio2', 'Radio 2') !!}

        </div>
      </div>

      <div style='margin:20px; text-align:right;'>

        {!! Form::button('Cancel', ['onclick' => 'location.href="' . route('test.form') . '";', 'class' => 'btn btn-secondary']) !!}

        {!! Form::button('Delete', ['onclick' => "someJSAFunction();", 'class' => 'btn']) !!}

        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

      </div>

    {!! Form::close() !!}
  </fieldset>

  {!! Form::open(['route' => 'test.form', 'id' => 'delete-form']) !!}
  {!! Form::hidden('_method', 'DELETE') !!}
  {!! Form::hidden('id', 120) !!}
  {!! Form::close() !!}

  {!! Form::open() !!}
  {!! Form::close() !!}

  {!! Form::open(['method' => 'GET', 'url' => '/test.form.php']) !!}
  {!! Form::close() !!}

  {!! Form::open(['name' => 'form1', 'url' => '/test.form.php']) !!}
  {!! Form::text('lastname', 'A lastname', ['id' => 'lastname', 'required', 'class' => 'text_class', 'id' => 'text_id', 'onkeyup' => 'onkeyupFonction();', 'onkeydown' => 'onkeydownFonction();']) !!}
  {!! Form::textarea('textarea_name', 'Some text', ['class' => 'textarea_class class']) !!}
  {!! Form::close() !!}

  {!! Form::open(['name' => 'form1', 'id' => 'form_id', 'url' => '/test.form.php', 'onsubmit' => 'someJSAction();']) !!}
  {!! Form::select('university', array('' => '', 'Vassar' => 'Vassar', 'Wesleyan' => 'Wesleyan', 'VWPP' => 'VWPP'), old('university'), ['required', 'id' => 'select_id', 'class' => 'select_class']) !!}
  {!! Form::close() !!}
</div>

@endsection
