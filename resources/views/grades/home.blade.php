@extends('layouts.myApp')
@section('content')


<h3>Grades, {{ session('semester') }}</h3>
  <div style='text-align:right;'>
    <input type='button' value='Export to Excel' onclick='location.href="/admin/grades3_export.php";' class='btn btn-primary' />
  </div>

  <h4>VWPP Courses</h4>
  <table class='datatable'>
    <thead>
      <tr>
        <th class='dataTableNoSort'></th>
        <th>Code</th>
        <th>Course title</th>
        <th>Professor</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($local as $course)
        <tr>
          <td><a href='/admin/grades3-2.php?univ=VWPP&id={{ $course->id }}'><img src='../img/edit.png' alt='Edit' border='0'/></a></td>
          <td>{{ $course->code }}</td>
          <td>{{ $course->name }}</td>
          <td>{{ $course->professor }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <h4>University courses</h4>
  <table class='datatable'>
    <thead>
      <tr>
        <th class='dataTableNoSort'></th>
        <th>Institution</th>
        <th>Discipline</th>
        <th>Code</th>
        <th>Course title</th>
        <th>Professor</th>
        <th>Student</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($univ as $course)
        <tr>
          <td><a href='/admin/grades3-2.php?univ=univ&id={{ $course->id }}'><img src='../img/edit.png' alt='Edit' border='0'/></a></td>
          <td>
            @if ($course->linkedTo)
              &rdsh;
            @endif
            {{ $course->institution}}
          </td>
          <td>{{ $course->discipline }}</td>
          <td>{{ $course->code }}</td>
          <td>{{ $course->name }}</td>
          <td>{{ $course->professor }}</td>
          <td>{{ $students->find($course->student)->lastname }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>


@endsection
