<fieldset>
  <form method='post' action='/univ_reg_plus' onsubmit='return ctrl_form_univreg();'>
  <input type='hidden' id='category' value='{{ $_SESSION['vwpp']['category'] }}' />

    <table>
      <tr>
        <td>1. Diplôme de fin d'études (High school diploma, etc.)</td>
        <td>
          @if ($edit)
            <input type='text' name='data[0]' value='{{ $answer_plus[0] }}' />
          @else
            <font class='response'>{{ $answer_plus[0] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td style='padding-left:30px; width:500px;'>a. Année d'obtention</td>
        <td>
          @if ($edit)
            <select name='data[1]'>
              <option value=''>&nbsp;</option>
              @for ($i = date('Y'); $i > date('Y')-30; $i--)
                <option value='{{ $i }}' @if ($answer_plus[1] == $i) selected='selected' @endif >{{ $i }}</option>
              @endfor
            </select>
          @else
            <font class='response'>{{ $answer_plus[1] }}</font>
          @endif
        </td>
      </tr>
      <tr>
        <td style='padding-left:30px;'>b. Pays</td>
        <td>
          @if ($edit)
            <select name='data[2]'>
              <option value=''>&nbsp;</option>
              @foreach ($countries as $country)
                <option value='{{ $country }}' @if ($country == $answer_plus[2]) selected='selected' @endif >{{ $country }}</option>
              @endforeach
            </select>
          @else
            <font class='response'>{{ $answer_plus[2] }}</font>
          @endif
        </td>
      </tr>
      <tr>
        <td style='padding-left:30px;'>c. Ville</td>
        <td>
          @if ($edit)
            <input type='text' name='data[3]' value='{{ $answer_plus[3] }}' />
          @else
            <font class='response'>{{ $answer_plus[3] }}</font>
          @endif
        </td>
      </tr>
      <tr>
        <td style='padding-left:30px;'>d. Etat</td>
        <td>
          @if ($edit)
            <select name='data[4]'>
              <option value=''>&nbsp;</option>
              @foreach ($states as $state)
                <option value='$state' @if ($state == $answer_plus[4]) selected='selected' @endif >{{ $state }}</option>
              @endforeach
            </select>
          @else
            <font class='response'>{{ $answer_plus[4] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>2. Etudes actuelles (at home institution)</td>
        <td>
          @if ($edit)
            <input type='radio' name='data[5]' value='Sophomore' @if ($answer_plus[5] == 'Sophomore') checked='checked' @endif /> a. Sophomore
          @else
            <font class='response'>{{ $answer_plus[5] }}</font>
          @endif
        </td>
      </tr>
      @if ($edit)
        <tr>
          <td>&nbsp;</td>
          <td>
            <input type='radio' name='data[5]' value='Junior' @if ($answer_plus[5] == 'Junior') checked='checked' @endif /> b. Junior
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
            <input type='radio' name='data[5]' value='Senior' @if ($answer_plus[5] == 'Senior') checked='checked' @endif /> c. Senior
          </td>
        </tr>
      @endif

      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan='2'>3. Faculté/Ecole/Département dans l’Etablissement d'origine (major dept. at home institution)</td>
      </tr>
      <tr>
        <td colspan='2'>
          @if ($edit)
            <input type='text' name='data[6]' value='{{ $answer_plus[6] }}' />
          @else
            <font class='response'>{{ $answer_plus[6] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>4. Début des études dans cet établissement</td>
        <td>
          @if ($edit)
            <select name='data[7]'>
              <option value=''>&nbsp;</option>
              @for ($i = date('Y'); $i > date('Y')-30; $i--)
                <option value='{{ $i }}' @if ($i == $answer_plus[7]) selected='selected' @endif >{{ $i }}</option>
              @endfor
            </select>
          @else
            <font class='response'>{{ $answer_plus[7] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>5. Domaine disciplinaire (major) dans cet établissement</td>
        <td>
          @if ($edit)
            <input type='text' name='data[8]' value='{{ $answer_plus[8] }}' />
          @else
            <font class='response'>{{ $answer_plus[8] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>6. Discipline voulue à l’université française (French University major, vous ne devez en mentionner qu'une seule) *</td>
        <td>
          @if ($edit)
            <input type='text' name='data[9]' value='{{ $answer_plus[9] }}' />
          @else
            <font class='response'>{{ $answer_plus[9] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>7. Avez-vous un handicap ou des besoins particuliers?</td>
        @if ($edit)
          <td style='padding-left:30px;'>
            <input type='radio' name='data[10]' value='Oui' @if ($answer_plus[10] == 'Oui') checked='checked' @endif /> Oui
          </td>
        @else
          <td class='response'>{{ $answer_plus[10] }}</td>
        @endif
      </tr>
      @if ($edit)
        <tr id='univreg_1_radio_4'>
          <td>&nbsp;</td>
          <td style='padding-left:30px;'>
            <input type='radio' name='data[10]' value='Non' @if ($answer_plus[10] == 'Non') checked='checked' @endif /> Non
          </td>
        </tr>
      @endif

      <tr>
        <td colspan='2'>Si oui, précisez</td>
      </tr>
      <tr>
        <td colspan='2'>
          @if ($edit)
            <textarea name='data[11]'>{{ $answer_plus[11] }}</textarea>
          @else
            <font class='response' colspan='2'>{{ $answer_plus[12] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>8. Discipline</td>
        <td>
          @if ($edit)
            <input type='text' name='data[13]' value='{{ $answer_plus[13] }}' />
          @else
            <font class='response'>{{ $answer_plus[13] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>9. UFR</td>
        <td>
          @if ($edit)
            <input type='text' name='data[14]' value='{{ $answer_plus[14] }}' />
          @else
            <font class='response'>{{ $answer_plus[14] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>10. MoveOnLine Username</td>
        <td>
          @if ($edit)
            <input type='text' name='data[15]' value='{{ $answer_plus[15] }}' />
          @else
            <font class='response'>{{ $answer_plus[15] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>11. MoveOnLine Password</td>
        <td>
          @if ($edit)
            <input type='text' name='data[16]' value='{{ $answer_plus[16] }}' />
          @else
            <font class='response'>{{ $answer_plus[16] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='2' style='text-align:right;'>
          <br/>

          @if ($edit)
            <input type='submit' value='Valider' class='btn btn-primary' />
          @else
            @if (session('admin') or !$loecked)
              <input type='button' value='Edit' onclick='location.href="/univ_reg_plus/{{ $student->id }}/edit";' class='btn btn-primary' />
            @endif
          @endif

        </td>
      </tr>
    </table>
  </form>
</fieldset>