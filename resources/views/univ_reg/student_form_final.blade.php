@if (!$edit)
  @if (Auth::user()->admin)
    <h3>University Registration</h3>
    <fieldset>

      <form method='post' action='/univ_reg3'>
        {{ csrf_field() }}

        <table>
          <tr>
            <td>University</td>
            <td>
              <select name='university' style='width:800px;'>
                <option value=''>&nbsp;</option>
                @foreach ($partners as $partner)
                  <option value='{{ $partner->name }}' @if ($university == $partner->name ) selected='selected' @endif >{{ $partner->name }}</option>
                @endforeach
              </select>
            </td>
            <td style='text-align:right;'>
              <input type='submit' value='Save' class='btn btn-primary' />
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
