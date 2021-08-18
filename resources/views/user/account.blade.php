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

  @if (Auth::user()->admin)
    <h3>Notifications</h3>

    <fieldset>
      <form method='post' action='{{ route('notifications.update') }}'>
      {{ csrf_field() }}
        <table>
          <tr>
            <td class='td-button same-line' >
              @if (Auth::user()->alerts)
                <input type='hidden' name='notifications' value='0' />
                <input type='submit' value='Disable notifications' class='btn btn-primary' />
              @else
                <input type='hidden' name='notifications' value='1' />
                <input type='submit' value='Enable notifications' class='btn btn-primary' />
              @endif
            </td>
          </tr>

        </table>
      </form>
    </fieldset>
  @endif

  <h3>Two Factor Authentication</h3>

  <fieldset>
    <form method='post' action='{{ route('two-factor.enable') }}'>
    {{ csrf_field() }}
      <table>
        <tr>
          <td colspan='2' class='td-button same-line' >
            @if (!Auth::user()->two_factor_secret)
              <input type='submit' value='Enable Two Factor Authentication' class='btn btn-primary' />
            @else
              <input type='hidden' name='_method' value='DELETE' />
              <input type='submit' value='Disable Two Factor Authentication' class='btn btn-primary' />
            @endif
          </td>
        </tr>

        @if (Auth::user()->two_factor_secret)
          <tr>
            <td style='padding-top:20px;'>
              Please scan this QR Code with an TOTP application (e.g. Duo)
            </td>
            <td style='padding:20px 30px; text-align:right;'>
              {!! Auth::user()->twoFactorQrCodeSvg() !!}
            </td>
          </tr>
        @endif

      </table>
    </form>
  </fieldset>


</section>

@endsection
