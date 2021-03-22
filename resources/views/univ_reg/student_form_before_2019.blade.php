      <tr>
        <td>Major 1:</td>
        <td colspan='2'>
          @if ($edit)
            <input type='text' name='question[1]' value='{{ $answer[1] }}' />
          @else
            <font class='response'>{{ $answer[1] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>Major 2:</td>
        <td colspan='2'>
          @if ($edit)
            <input type='text' name='question[2]' value='{{ $answer[2] }}' />
          @else
            <font class='response'>{{ $answer[2] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>Minor / Correlate 1</td>
        <td colspan='2'>
          @if ($edit)
            <input type='text' name='question[3]' value='{{ $answer[3] }}' />
          @else
            <font class='response'>{{ $answer[3] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>Minor / Correlate 2</td>
        <td colspan='2'>
          @if ($edit)
            <input type='text' name='question[4]' value='{{ $answer[4] }}' />
          @else
            <font class='response'>{{ $answer[4] }}</font>
          @endif
        </td>
      </tr>

      @if (!empty($dates))
        <tr>
          <td colspan='6' style='padding:20px 0 0 0; text-align:justify;'>
            Please note that each university has a different calendar :<br/>
            Paris 3, end of course <b>{{ $dates->date5 }}</b><br/>
            Paris 4, end of course <b>{{ $dates->date6 }}</b><br/>
            Paris 7, end of course <b>{{ $dates->date7 }}</b><br/>
            Paris 12, end of course <b>{{ $dates->date8 }}</b><br/>
          </td>
        </tr>
      @endif

      <tr>
        <td colspan='6' style='padding:20px 0 0 0; text-align:justify;'>
          <b>Please rank your choices </b>(fill in 1<sup>st</sup>, 2<sup>nd</sup>, 3<sup>rd</sup> and 4<sup>th</sup> in the appropriate boxes)
        </td>
      </tr>

      <tr>
        <td>Paris 3</td>
        <td colspan='2'>
          @if ($edit)
            <select name='question[5]'>
              <option value=''>&nbsp;</option>
              <option value='1st' {@if ($answer[5] == '1st') selected='selected' @endif}>1st Choice</option>
              <option value='2nd' {@if ($answer[5] == '2nd') selected='selected' @endif}>2nd Choice</option>
              <option value='3rd' {@if ($answer[5] == '3rd') selected='selected' @endif}>3rd Choice</option>
              <option value='4th' {@if ($answer[5] == '4th') selected='selected' @endif}>4th Choice</option>
              <option value='5th' {@if ($answer[5] == '5th') selected='selected' @endif}>5th Choice</option>
            </select>
          @else
            <font class='response'>{{ $answer[5] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>Paris 4</td>
        <td colspan='2'>
          @if ($edit)
            <select name='question[6]'>
              <option value=''>&nbsp;</option>
              <option value='1st' {@if ($answer[6] == '1st') selected='selected' @endif}>1st Choice</option>
              <option value='2nd' {@if ($answer[6] == '2nd') selected='selected' @endif}>2nd Choice</option>
              <option value='3rd' {@if ($answer[6] == '3rd') selected='selected' @endif}>3rd Choice</option>
              <option value='4th' {@if ($answer[6] == '4th') selected='selected' @endif}>4th Choice</option>
              <option value='5th' {@if ($answer[6] == '5th') selected='selected' @endif}>5th Choice</option>
            </select>
          @else
            <font class='response'>{{ $answer[6] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>Paris 7</td>
        <td colspan='2'>
          @if ($edit)
            <select name='question[7]'>
              <option value=''>&nbsp;</option>
              <option value='1st' {@if ($answer[7] == '1st') selected='selected' @endif}>1st Choice</option>
              <option value='2nd' {@if ($answer[7] == '2nd') selected='selected' @endif}>2nd Choice</option>
              <option value='3rd' {@if ($answer[7] == '3rd') selected='selected' @endif}>3rd Choice</option>
              <option value='4th' {@if ($answer[7] == '4th') selected='selected' @endif}>4th Choice</option>
              <option value='5th' {@if ($answer[7] == '5th') selected='selected' @endif}>5th Choice</option>
            </select>
          @else
            <font class='response'>{{ $answer[7] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>Paris 12</td>
        <td colspan='2'>
          @if ($edit)
            <select name='question[1]'>
              <option value=''>&nbsp;</option>
              <option value='1st' {@if ($answer[12] == '1st') selected='selected' @endif}>1st Choice</option>
              <option value='2nd' {@if ($answer[12] == '2nd') selected='selected' @endif}>2nd Choice</option>
              <option value='3rd' {@if ($answer[12] == '3rd') selected='selected' @endif}>3rd Choice</option>
              <option value='4th' {@if ($answer[12] == '4th') selected='selected' @endif}>4th Choice</option>
              <option value='5th' {@if ($answer[12] == '5th') selected='selected' @endif}>5th Choice</option>
            </select>
          @else
            <font class='response'>{{ $answer[12] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td>CIPh</td>
        <td colspan='2'>
          @if ($edit)
            <select name='question[8]'>
              <option value=''>&nbsp;</option>
              <option value='1st' {@if ($answer[8] == '1st') selected='selected' @endif}>1st Choice</option>
              <option value='2nd' {@if ($answer[8] == '2nd') selected='selected' @endif}>2nd Choice</option>
              <option value='3rd' {@if ($answer[8] == '3rd') selected='selected' @endif}>3rd Choice</option>
              <option value='4th' {@if ($answer[8] == '4th') selected='selected' @endif}>4th Choice</option>
              <option value='5th' {@if ($answer[8] == '5th') selected='selected' @endif}>5th Choice</option>
            </select>
          @else
            <font class='response'>{{ $answer[8] }}</font>
          @endif
        </td>
      </tr>

      <tr>
        <td colspan='6' style='padding:20px 0 0 0;text-align:justify';>
          <b>Please provide an academic justification for your 1<sup>st</sup> and 2<sup>nd</sup> choices in the text box below</b> (Maximum 1200 characters with spaces) :
        </td>
      </tr>

      <tr>
        <td colspan='6'>
          @if ($edit)
            <textarea name='question[9]'>{{ $answer[9] }}</textarea>
          @else
            <font class='response'>{!! nl2br(e($answer[9])) !!}</font>
          @endif
        </td>
      </tr>

      @if (!empty($dates))
        <tr>
          <td colspan='6' style='padding:20px 0 0 0; text-align:justify;'>
            <b>Please indicate if your choice of university is motivated by the calendar and explain your reason</b> : job, internship, graduation ...
          </td>
        </tr>

        <tr>
          <td colspan='6'>
            @if ($edit)
              <textarea name='question[11]'>{{ $answer[11] }}</textarea>
            @else
              <font class='response'>{!! nl2br(e($answer[11])) !!}</font>
            @endif
          </td>
        </tr>
      @endif

      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan='6' style='padding:0 0 0 0; text-align:justify;'>
          Your wishes will be taken into account but university placement cannot be guaranteed as each university has a specific number of spots for our students.<br/>
        </td>
      </tr>

      <tr>
        <td colspan='6' style='text-align:right;'>
          <br/><br/>

          {{--
          @if ($edit)
            <input type='button' value='Cancel' class='btn' onclick='location.href="/univ_reg/";' />
            <input type='submit' value='Submit' class='btn btn-primary' />
          @else
            @if (session('admin') or !$university)
              <input type='button' value='Edit' class='btn btn-primary' onclick='location.href="/univ_reg/{{ $student->id }}/edit";' />
            @endif
          @endif
          --}}

        </td>
      </tr>
    </table>
  </form>
</fieldset>
