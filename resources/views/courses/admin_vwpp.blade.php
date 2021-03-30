<h3>VWPP Courses</h3>

<fieldset>
  <form name='form' action='/courses/reidhall/assignment' method='post'>
    {{ csrf_field() }}
    <input type='hidden' name='univ' value='Reid hall' />

    <table>
      <tr>
        <td colspan='4' style='padding:0 0 10px 0;'>
          <b><u>1.) Student's choices</u></b>
        </td>
      </tr>

      @include('courses.student_form_vwpp')

      <tr>
        <td colspan='4' style='font-weight:bold; padding:50px 0 10px 0;'><u>2.) Total registered</u></td>
      </tr>
      <tr>
        <td colspan='4'><b>Writing-Intensive Course</b></td>
      </tr>
      <tr>
        <td colspan='4'>
          <ul style='margin-top:0px;'>
            @foreach ($occurences['Writing'] as $elem)
              <li>{{ $elem['code'] }} {{ $elem['title'] }}, {{ $elem['professor'] }} : {{ $elem['count'] }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      <tr>
        <td colspan='4'><b>Seminars</b></td>
      </tr>
      <tr>
        <td colspan='4'>
          <ul style='margin-top:0px;'>
            @foreach ($occurences['Seminar'] as $elem)
              <li>{{ $elem['code'] }} {{ $elem['title'] }}, {{ $elem['professor'] }} : {{ $elem['count'] }}</li>
            @endforeach
          </ul>
        </td>
      </tr>

      <tr>
        <td colspan='4' style='font-weight:bold; padding:30px 0 10px 0;'><u>3.) Final registration</u></td>
      </tr>
      <tr>
        <td style='padding-left:15px;font-weight:bold;' colspan='3'>Writing-Intensive Courses</td>
        @if (in_array(16, session('access')))
          <td rowspan='8' style='text-align:right; padding-right:0px;'>
            <input type='submit' value='Submit' class='btn btn-primary'/> <br/>
            <input type='button' value='{{ $button_publish }}' onclick='lockRH2(this, {{ $student->id }});' class='btn btn-primary' />
          </td>
        @endif
      </tr>
      <tr>
        <td style='width:250px; text-align:right;'>N°1</td>
        <td colspan='2'>
          @if (in_array(16, session('access')))
            <select name='writing1'>
              <option value=''>&nbsp;</option>
              @foreach ($rhCourses->where('type', 'Writing') as $elem)
                <option value='{{ $elem->id }}' @if ($elem->id == $assignment->writing1) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
              @endforeach
            </select>
          @else
            {{ $assignment_text->writing1 }}
          @endif
        </td>
      </tr>

      <tr>
        <td style='text-align:right;'>N°2</td>
        <td colspan='2'>
          @if (in_array(16, session('access')))
            <select name='writing2'>
              <option value=''>&nbsp;</option>
              @foreach ($rhCourses->where('type', 'Writing') as $elem)
                <option value='{{ $elem->id }}' @if ($elem->id == $assignment->writing2) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
              @endforeach
            </select>
          @else
            {{ $assignment_text->writing2 }}
          @endif
        </td>
      </tr>
      <tr>
        <td style='padding-left:15px;font-weight:bold;' colspan='3'>Seminars</td>
      </tr>
      <tr>
        <td style='text-align:right;'>N°1</td>
        <td colspan='2'>
          @if (in_array(16, session('access')))
            <select name='seminar1'>
              <option value=''>&nbsp;</option>
              @foreach ($rhCourses->where('type', 'Seminar') as $elem)
                <option value='{{ $elem->id }}' @if ($elem->id == $assignment->seminar1) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
              @endforeach
            </select>
          @else
            {{ $assignment_text->seminar1 }}
          @endif
        </td>
      </tr>
      <tr>
        <td style='text-align:right;'>N°2</td>
        <td colspan='2'>
          @if (in_array(16, session('access')))
            <select name='seminar2'>
              <option value=''>&nbsp;</option>
              @foreach ($rhCourses->where('type', 'Seminar') as $elem)
                <option value='{{ $elem->id }}' @if ($elem->id == $assignment->seminar2) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
              @endforeach
            </select>
          @else
            {{ $assignment_text->seminar2 }}
          @endif
        </td>
      </tr>
      <tr>
        <td style='text-align:right;'>N°3</td>
        <td colspan='2'>
          @if (in_array(16, session('access')))
            <select name='seminar3'>
              <option value=''>&nbsp;</option>
              @foreach ($rhCourses->where('type', 'Seminar') as $elem)
                <option value='{{ $elem->id }}' @if ($elem->id == $assignment->seminar3) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
              @endforeach
            </select>
          @else
            {{ $assignment_text->seminar3 }}
          @endif
        </td>
      </tr>
    </table>
  </form>
</fieldset>
