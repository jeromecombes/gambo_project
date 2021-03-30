<h3>Stage</h3>

<fieldset>
  <form name='internship_form' method='post' action='{{ route('internship.update') }}'>
    <input type='hidden' name='id' value='{{ $internship->id }}' />
    {{ csrf_field() }}

    <table>
      <tr>
        <td style='width:250px; font-weight:bold;'>Faites-vous un stage</td>
        <td>
          @if ($edit)
            <input type='radio' name='internship' id='radio_yes' value='Yes' @if ($internship->internship == 'Yes') checked='checked' @endif />
            <label for='radio_yes' style='margin-left:10px;'>Oui</label>
            <input type='radio' name='internship' id='radio_no' value='No' @if ($internship->internship == 'No') checked='checked' @endif style='margin-left:30px;'/>
            <label for='radio_no' style='margin-left:10px;'>Non</label>
          @else
            <span>{{ __($internship->internship) }}</span>
          @endif
        </td>
      </tr>

      <tr>
        <td><label for='name'>Lequel ?</label></td>
        <td>
          @if ($edit)
            <input type='text' name='name' id='name' value='{{ $internship->name }}' />
          @else
            <span>{{ $internship->name }}</span>
          @endif
        </td>
      </tr>

      @if (session('admin'))
        <tr>
          <td><label for='notes'>Notes</label></td>
          <td>
            @if ($edit)
              <textarea name='notes' id='notes'>{{ $internship->notes }}</textarea>
            @else
              <span>{!! nl2br(e($internship->notes)) !!}</span>
            @endif
          </td>
        </tr>
      @endif

      @if (! session('admin') or $admin2)
        <tr>
          <td colspan='2' style='padding-top:20px; text-align:right;'>
            @if ($edit)
              <input type='button' onclick='location.href="{{ asset('courses') }}";' value='Annuler' class='btn' />
              <input type='submit' value='Valider' class='btn btn-primary' />
            @else
              <input type='button' onclick='document.location.href="{{ route('internship.edit') }}";' value='Modifier' class='btn btn-primary' />
              <input type='button' id='internship_lock_button' onclick='lock(this, "internship", 0);' value='@if ($internship->lock) Déverrouiller @else Verrouiller @endif' class='btn' />
            @endif
          </td>
        </tr>
      @endif
    </table>
  </form>
</fieldset>
