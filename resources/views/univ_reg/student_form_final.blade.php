@if (!$edit)
  @if (session('admin'))
    <fieldset>

      <form method='post' action='/univ_reg3'>
        {{ csrf_field() }}

        <table>
          <tr>
            <td colspan='2'>
              <h3>University Registration</h3>
            </td>
          </tr>

          <tr>
            <td>University</td>
            <td>
              <select name='university' style='width:800px;'>
                <option value=''>&nbsp;</option>
                <option value='Paris 3' @if ($university == 'Paris 3') selected='selected' @endif >Paris 3</option>
                <option value='Paris 4' @if ($university == 'Paris 4') selected='selected' @endif >Paris 4</option>
                <option value='Paris 7' @if ($university == 'Paris 7') selected='selected' @endif >Paris 7</option>
                <option value='Paris 12' @if ($university == 'Paris 12') selected='selected' @endif >Paris 12</option>
                <option value='CIPh' @if ($university == 'CIPh') selected='selected' @endif >CIPh</option>
              </select>
              <div style='text-align:right;'>
                <input type='submit' value='Save' class='btn btn-primary' />
              </div>
            </td>
          </tr>
        </table>

      </form>
    </fieldset>

  @elseif ($university and $published)
    <fieldset>

      <table>
        <tr>
          <td colspan='2'>
            <h3>University Registration</h3>
          </td>
        </tr>

        <tr>
          <td>University</td>
          <td class='response'>{{ $university }}</td>
        </tr>
      </table>
    </fieldset>

  @endif
@endif
