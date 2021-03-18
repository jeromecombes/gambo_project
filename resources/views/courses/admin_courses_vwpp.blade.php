<h3>VWPP Courses</h3>

<fieldset>
  <form name='form' action='/courses' method='post'>
    {{ csrf_field() }}
    <input type='hidden' name='univ' value='Reid hall' />

    <table>
      <tr>
        <td colspan='4' style='padding:0 0 10px 0;'>
          <b><u>1.) Student's choices</u></b>
          <div style='text-align:right;'>
            <input type='button' value='{{ $button_lock }}' onclick='lockRH(this, {{ $student->id }});' class='btn btn-primary' />
          </div>
        </td>
      </tr>
      <tr>
        <td colspan='2'><b>Writing-Intensive Course</b></td>
      </tr>
      <tr>
        <td style='padding-left:30px;'>1<sup>st</sup> choice</td>
        @if ($choices->a1)
          <td>{{ $rhCourses->find($choices->a1)->code }} {{ $rhCourses->find($choices->a1)->title }}</td>
          <td>{{ $rhCourses->find($choices->a1)->professor }}</td>
        @endif
      </tr>
      <tr>
        <td style='padding-left:30px;'>2<sup>nd</sup> choice</td>
        @if ($choices->b1)
          <td>{{ $rhCourses->find($choices->b1)->code }} {{ $rhCourses->find($choices->b1)->title }}</td>
          <td>{{ $rhCourses->find($choices->b1)->professor }}</td>
        @endif
      </tr>
      <tr>
        <td colspan='2'><b>Seminar</b></td>
      </tr>
      <tr>
        <td style='padding-left:30px;'>1<sup>st</sup> choice</td>
        @if ($choices->a2)
          <td>{{ $rhCourses->find($choices->a2)->code }} {{ $rhCourses->find($choices->a2)->title }}</td>
          <td>{{ $rhCourses->find($choices->a2)->professor }}</td>
        @endif
      </tr>
      <tr>
        <td style='padding-left:30px;'>2<sup>nd</sup> choice</td>
        @if ($choices->b2)
          <td>{{ $rhCourses->find($choices->b2)->code }} {{ $rhCourses->find($choices->b2)->title }}</td>
          <td>{{ $rhCourses->find($choices->b2)->professor }}</td>
        @endif
      </tr>

      <tr>
        <td colspan='3' style='font-weight:bold;padding:50px 0 10px 0;'><u>2.) Total registered</u></td>
      </tr>
      <tr>
        <td colspan='2'><b>Writing-Intensive Course</b></td>
      </tr>
      <tr>
        <td colspan='3'><ul style='margin-top:0px;'>
          <ul>
            @foreach ($occurences['Writing'] as $elem)
              <li>{{ $elem['code'] }} {{ $elem['title'] }}, {{ $elem['professor'] }} : {{ $elem['count'] }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      <tr>
        <td colspan='2'><b>Seminars</b></td>
      </tr>
      <tr>
        <td colspan='3'><ul style='margin-top:0px;'>
          <ul>
            @foreach ($occurences['Seminar'] as $elem)
              <li>{{ $elem['code'] }} {{ $elem['title'] }}, {{ $elem['professor'] }} : {{ $elem['count'] }}</li>
            @endforeach
          </ul>
        </td>
      </tr>

      <tr>
        <td colspan='3' style='font-weight:bold;padding-top:30px;'><u>3.) Final registration</u></td>
      </tr>
      <tr>
        <td style='padding-left:15px;font-weight:bold;' colspan='3'>Writing-Intensive Courses</td>
      </tr>
      <tr>
        <td style='text-align:right;'>N°1</td>
        <td colspan='2'>
          <select name='writing1'>
            <option value=''>&nbsp;</option>
            @foreach ($rhCourses->where('type', 'Writing') as $elem)
              <option value='{{ $elem->id }}' @if ($elem->id == $assignment->writing1) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
            @endforeach
          </select>
        </td>
        <td style='text-align:right;padding-right:0px;'>
          <input type='submit' value='Submit' class='btn btn-primary'/>
        </td>
      </tr>

      <tr>
        <td style='text-align:right;'>N°2</td>
        <td colspan='2'>
          <select name='writing2'>
            <option value=''>&nbsp;</option>
            @foreach ($rhCourses->where('type', 'Writing') as $elem)
              <option value='{{ $elem->id }}' @if ($elem->id == $assignment->writing2) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
            @endforeach
          </select>
        </td>
        <td style='text-align:right;padding-right:0px;'>
          <input type='button' value='{{ $button_publish }}' onclick='lockRH2(this, {{ $student->id }});' class='btn btn-primary' />
        </td>
      </tr>
      <tr>
        <td style='padding-left:15px;font-weight:bold;' colspan='3'>Seminars</td>
      </tr>
      <tr>
        <td style='text-align:right;'>N°1</td>
        <td colspan='2'>
          <select name='seminar1'>
            <option value=''>&nbsp;</option>
            @foreach ($rhCourses->where('type', 'Seminar') as $elem)
              <option value='{{ $elem->id }}' @if ($elem->id == $assignment->seminar1) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
            @endforeach
          </select>
        </td>
      </tr>
      <tr>
        <td style='text-align:right;'>N°2</td>
        <td colspan='2'>
          <select name='seminar2'>
            <option value=''>&nbsp;</option>
            @foreach ($rhCourses->where('type', 'Seminar') as $elem)
              <option value='{{ $elem->id }}' @if ($elem->id == $assignment->seminar2) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
            @endforeach
          </select>
        </td>
      </tr>
      <tr>
        <td style='text-align:right;'>N°3</td>
        <td colspan='2'>
          <select name='seminar3'>
            <option value=''>&nbsp;</option>
            @foreach ($rhCourses->where('type', 'Seminar') as $elem)
              <option value='{{ $elem->id }}' @if ($elem->id == $assignment->seminar3) selected='selected' @endif >{{ $elem->code }} {{ $elem->title }}, {{ $elem->professor }}</option>
            @endforeach
          </select>
        </td>
      </tr>
    </table>
  </form>
</fieldset>
