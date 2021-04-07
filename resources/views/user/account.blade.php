@extends('layouts.myApp')
@section('content')

<h3>Change password</h3>

<section id='account'>
  <fieldset>
    <form method='post' action='{{ route('password.update') }}'>
    {{ csrf_field() }}
      <table>
        <tr>
          <td>
            <label for='current'>Current password :</label>
          </td>
          <td>
            <input type='password' name='current' id='current' />
          </td>
        </tr>
        <tr>
          <td>
            <label for='password'>New password :</label>
          </td>
          <td>
            <input type='password' name='password' id='password' />
          </td>
        </tr>
        <tr>
          <td>
            <label for='confirm'>Confirm new password :</label>
          </td>
          <td>
            <input type='password' name='confirm' id='confirm' />
          </td>
        </tr>

        <tr>
          <td colspan='2' class='td-button' >
            <input type='reset' value='Cancel' class='btn' />
            <input type='submit' value='Change password' class='btn btn-primary' />
          </td>
        </tr>
      </table>
    </form>
  </fieldset>

  @if (session('admin'))
    <h3>Notifications</h3>

    <fieldset>
      <form method='post' action='{{ route('notifications.update') }}'>
      {{ csrf_field() }}
        <table>
          <tr>
            <td>
              <label for='notifications'>Enable notifications ?</label>
            </td>
            <td>
              <input type='checkbox' name='notifications' value='1' @if ($notifications) checked='checked' @endif />
            </td>
            <td class='td-button same-line' >
              <input type='submit' value='Update' class='btn btn-primary' />
            </td>
          </tr>

        </table>
      </form>
    </fieldset>
  @endif
</section>

@endsection
