@extends('layouts.myApp')
@section('content')

  <h3>Grades, {{ session('semester') }}</h3>

  <h4>{{ $course->code }} {{ $course->name }}, {{ $course->professor }}</h4>

  @if (empty($students))
    <p>No student</p>
  @else
    {{ Form::open(['route' => 'grades.list_update', 'name' => 'form']) }}
    {{ Form::hidden('id', $id) }}
    {{ Form::hidden('univ', $univ) }}

    <table class='datatable' data-sort='[["0","asc"],["1","asc"]]' >
      <thead>
        <tr>
          <th>Lastname</th>
          <th>Firstname</th>
          <th>Note</th>
          <th>Date received</th>

          @if (in_array(19, Auth::user()->access) or in_array(20, Auth::user()->access))
            <th>Pass/Fail NRO</th>
            <th>Actual Grade</th>
            <th>Reported Grade</th>
            <th>Date Recorded</th>
          @endif

        </tr>
      </thead>

      <tbody>

        @foreach ($students as $student)
          <tr>
            <td>{{ $student->lastname }}</td>
            <td>{{ $student->firstname }}</td>

              @if (in_array(18, Auth::user()->access) and $edit)
                <td>
                  {{ Form::text('note_' . $student->id, $student->note, ['onkeyup' => 'verifNote("form",this);']) }}
                </td>
                <td>
                  {{ Form::text('date1_' . $student->id, $student->date1, ['class' => 'myUI-datepicker-string']) }}
                </td>
              @else
                <td>{{ $student->note }}</td>
                <td>{{ $student->date1 }}</td>
              @endif

              @if (in_array(19, Auth::user()->access) and $edit)
                <td>
                  {{ Form::select('grade1_' . $student->id, $grades, $student->grade1) }}
                </td>

                <td>
                  {{ Form::select('grade2_' . $student->id, $grades, $student->grade2) }}
                </td>

                <td>
                  {{ Form::select('grade_' . $student->id, $grades, $student->grade) }}
                </td>

                <td>
                  {{ Form::text('date2_' . $student->id, $student->date2, ['class' => 'myUI-datepicker-string']) }}
                </td>

              @elseif (in_array(19, Auth::user()->access) or in_array(20, Auth::user()->access))
                <td>{{ $student->grade1 }}</td>
                <td>{{ $student->grade2 }}</td>
                <td>{{ $student->grade }}</td>
                <td>{{ $student->date2 }}</td>
              @endif

          </tr>
        @endforeach

      </tbody>
    </table>

    <div style='text-align:right;margin:20px 0 0 0;'>
      {{ Form::button('Back to list', ['class' => 'btn', 'onclick' => 'location.href="' . route('grades.home') .'";']) }}

      @if (in_array(18, Auth::user()->access) or in_array(19, Auth::user()->access))
        @if ($edit)
          {{ Form::button('Cancel', ['class' => 'btn', 'onclick' => 'location.href="' . route('grades.list', [$univ, $id]) . '";']) }}
          {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        @else
          {{ Form::button('Edit', ['class' => 'btn btn-primary', 'onclick' => 'location.href="' . route('grades.list', [$univ, $id, 'edit']) .'";']) }}
        @endif
      @endif
    </div>

    {{ Form::close() }}

  @endif

@endsection
