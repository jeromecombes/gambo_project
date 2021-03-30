<h3>Tutorat</h3>

<fieldset>
  <form name='tutoring_form' method='post' action='{{ asset('tutoring/update') }}'>
  <input type='hidden' name='id' value='{{ $tutoring->id }}' />
  {{ csrf_field() }}

  <table>
    <tr>
      <td style='width:250px; font-weight:bold;'>Tuteur</td>
      <td>
        @if ($edit)
          <input type='text' name='tutor' value='{{ $tutoring->tutor }}' />
        @else
          <font>{{ $tutoring->tutor }}</font>
        @endif
      </td>
    </tr>

    <tr>
      <td>
        <b>Jour et heures du tutorat</b>
      </td>
      <td>
        @if ($edit)
          <select name='day' style='width:33%;'>
            <option value=''></option>
            @for ($i = 0; $i < 7; $i++)
              <option value='{{ $i }}' @if ($tutoring->day === "$i") selected='selected' @endif >{{ __(jddayofweek($i, 1)) }}</option>
            @endfor
          </select>

          <select name='start' style='width:32%;'>
            <option value=''></option>
            @for ($i = 8; $i < 22; $i++)
              @for ($j = 0; $j < 60; $j = $j + 15 )
                @php
                  $h1 = sprintf("%02d",$i) . ':' . sprintf("%02d",$j);
                  $h2 = sprintf("%02d",$i) . 'h'. sprintf("%02d",$j);
                @endphp
                <option value='{{ $h1 }}' @if ($tutoring->start == $h1) selected='selected' @endif >de {{ $h2 }}</option>
              @endfor
            @endfor
          </select>

          <select name='end' style='width:32%;'>
            <option value=''></option>
            @for ($i = 8; $i < 22; $i++)
              @for ($j = 0; $j < 60; $j = $j + 15 )
                @php
                  $h1 = sprintf("%02d",$i) . ':' . sprintf("%02d",$j);
                  $h2 = sprintf("%02d",$i) . 'h'. sprintf("%02d",$j);
                @endphp
                <option value='{{ $h1 }}' @if ($tutoring->end == $h1) selected='selected' @endif >à {{ $h2 }}</option>
              @endfor
            @endfor
            </select>
          @elseif ($tutoring->id)
            <div>{{ __(jddayofweek($tutoring->day, 1)) }} de {{ $tutoring->start }} à {{ $tutoring->end }}</div>
          @endif
        </td>
      </tr>

      @if (!session('admin') or $admin2)
        <tr>
          <td colspan='2' style='padding-top:20px; text-align:right;'>
          @if ($edit)
            <input type='button' onclick='location.href="{{ asset('courses') }}";' value='Annuler' class='btn' />
            <input type='submit' value='Valider' class='btn btn-primary' />
          @elseif (session('admin') or !$tutoring->lock)
            @if ($tutoring->id)
              <input type='button' onclick='document.location.href="{{ asset('tutoring/') }}/{{ $tutoring->id }}/edit";' value='Modifier' class='btn btn-primary' />
            @else
              <input type='button' onclick='document.location.href="{{ asset('tutoring/') }}/add";' value='Ajouter' class='btn btn-primary' />
            @endif
            @if ($admin2 and $tutoring->id)
              <input type='button' id='tutoring_lock_button' onclick='lock(this, "tutorat", {{ $tutoring->id }});' value='@if ($tutoring->lock) Déverrouiller @else Verrouiller @endif' class='btn' />
            @endif
          @endif
        </td>
      </tr>
    @endif

    </table>
  </form>
</fieldset>
