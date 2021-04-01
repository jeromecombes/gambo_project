@extends('layouts.myApp')
@section('content')


<form name='form' id='grades-form' action='{{ route('grades.update') }}' method='post'>
{{ csrf_field() }}

  <h3>VWPP Courses</h3>
  <fieldset>
    <table>
      <tr>
        <th>Course title</th>
        <th>Note</th>
        <th>Date received</th>
        @if ($us_ro)
          <th>Pass/Fail NRO</th>
          <th>Actual Grade</th>
          <th>Reported Grade</th>
          <th>Date Recorded</th>
        @endif
      </tr>

      @foreach ($courses->local as $course)
        <tr>
          <td>{{ $course->title }}, {{ $course->professor }}</td>
          <td>
            @if ( $edit and $fr_rw)
              <input type='text' name='local_fr_{{ $course->id }}' value='{{ $grades['local'][$course->id]->note }}' onkeyup='verifNote("form",this);'>
            @else
              <span>{{ $grades['local'][$course->id]->note }}</span>
            @endif
          </td>
          <td>
            @if ( $edit and $fr_rw)
              <input type='text' name='local_fr_date_{{ $course->id }}' value='{{ $grades['local'][$course->id]->date1 }}' class='myUI-datepicker-string' />
            @else
              <span>{{ $grades['local'][$course->id]->date1 }}</span>
            @endif
          </td>

          @if ($us_ro)
            <td>
              @if ($edit and $us_rw)
                <select name='local_us1_{{ $course->id }}'>
                  <option value=''></option>
                  @foreach ($grades_tab as $grade)
                    <option value='{{ $grade }}' @if ($grades['local'][$course->id]->grade1 == $grade) selected='selected' @endif >{{ $grade }}</option>
                  @endforeach
                </select>
              @else
                <span>{{ $grades['local'][$course->id]->grade1 }}</span>
              @endif
            </td>

            <td>
              @if ($edit and $us_rw)
                <select name='local_us2_{{ $course->id }}'>
                  <option value=''></option>
                  @foreach ($grades_tab as $grade)
                    <option value='{{ $grade }}' @if ($grades['local'][$course->id]->grade2 == $grade) selected='selected' @endif>{{ $grade }}</option>
                  @endforeach
                </select>
              @else
                <span>{{ $grades['local'][$course->id]->grade2 }}</span>
              @endif
            </td>

            <td>
              @if ($edit and $us_rw)
                <select name='local_us_{{ $course->id }}'>
                  <option value=''></option>
                  @foreach ($grades_tab as $grade)
                    <option value='{{ $grade }}' @if ($grades['local'][$course->id]->grade == $grade) selected='selected' @endif >{{ $grade }}</option>
                  @endforeach
                </select>
              @else
                <span>{{ $grades['local'][$course->id]->grade }}</span>
              @endif
            </td>

            <td>
              @if ($edit and $us_rw)
                <input type='text' name='local_us_date_{{ $course->id }}' value='{{ $grades['local'][$course->id]->date2 }}' class='myUI-datepicker-string' />
              @else
                <span>{{ $grades['local'][$course->id]->date2 }}</span>
              @endif
            </td>
          @endif
        </tr>
      @endforeach
    </table>
  </fieldset>

  <h3>University Courses</h3>
  <fieldset>
    <table>
      <tr>
        <th>Course title</th>
        <th>Note</th>
        <th>Date received</th>
        @if ($us_ro)
          <th>Pass/Fail NRO</th>
          <th>Actual Grade</th>
          <th>Reported Grade</th>
          <th>Date Recorded</th>
        @endif
      </tr>

      @foreach ($courses->univ as $course)
        <tr>
          <td>{{ $course->nom }}, {{ $course->prof }} ({{ $course->nature }})</td>
          <td>
            @if ($edit and $fr_rw)
              <input type='text' name='univ_fr_{{ $course->id }}' value='{{ $grades['univ'][$course->id]->note }}' onkeyup='verifNote("form",this);'>
            @else
              <span>{{ $grades['univ'][$course->id]->note }}</span>
            @endif
          </td>
          <td>

            @if ($edit and $fr_rw)
              <input type='text' name='univ_fr_date_{{ $course->id }}' value='{{ $grades['univ'][$course->id]->date1 }}' class='myUI-datepicker-string' />
            @else
              <span>{{ $grades['univ'][$course->id]->date1 }}</span>
            @endif
          </td>

          @if ($us_ro)
            <td>
              @if ($edit and $us_rw)
                <select name='univ_us1_{{ $course->id }}'>
                  <option value=''></option>
                  @foreach ($grades_tab as $grade)
                    <option value='{{ $grade }}' @if ($grades['univ'][$course->id]->grade1 == $grade) selected='selected' @endif >{{ $grade }}</option>
                  @endforeach
                </select>
              @else
                <span>{{ $grades['univ'][$course->id]->grade1 }}</span>
              @endif
            </td>

            <td>
              @if ($edit and $us_rw)
                <select name='univ_us2_{{ $course->id }}'>
                  <option value=''></option>
                  @foreach ($grades_tab as $grade)
                    <option value='{{ $grade }}' @if ($grades['univ'][$course->id]->grade2 == $grade) selected='selected' @endif >{{ $grade }}</option>
                  @endforeach
                </select>
              @else
                <span>{{ $grades['univ'][$course->id]->grade2 }}</span>
              @endif
            </td>

            <td>
              @if ($edit and $us_rw)
                <select name='univ_us_{{ $course->id }}'>
                  <option value=''></option>
                  @foreach ($grades_tab as $grade)
                    <option value='{{ $grade }}' @if ($grades['univ'][$course->id]->grade == $grade) selected='selected' @endif >{{ $grade }}</option>
                  @endforeach
                  }
                </select>
              @else
                <span>{{ $grades['univ'][$course->id]->grade }}</span>
              @endif
            </td>

            <td>
              @if ($edit and $us_rw)
                <input type='text' name='univ_us_date_{{ $course->id }}' value='{{ $grades['univ'][$course->id]->date2 }}' class='myUI-datepicker-string' />
              @else
                <span>{{ $grades['univ'][$course->id]->date2 }}</span>
              @endif
            </td>
          @endif
        </tr>
      @endforeach
    </table>
  </fieldset>

  <br/>
  <br/>

  @if ($fr_rw or $us_rw)
    <div style='text-align:right; margin-bottom:20px;'>
      @if ($edit)
        <input type='button' value='Cancel' onclick='location.href="{{ route('grades.show') }}";' class='btn' />
        <input type='submit' value='Submit' class='btn btn-primary' />
      @else
        <input type='button' value='Change' onclick='location.href="{{ route('grades.edit', 'edit') }}";' class='btn btn-primary' />
      @endif
    </div>
  @endif

</form>

@endsection
