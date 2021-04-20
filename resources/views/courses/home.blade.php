@extends('layouts.myApp')
@section('content')

  <h3>VWPP Courses for {{ session('semester') }} ( {{ count($courses->local) }})</h3>

  <table class='datatable' data-sort='[[2,"asc"],[3,"asc"]]' >
    <thead>
      <tr>
        <th class='dataTableNoSort'></th>
        <th>Type</th>
        <th>Code</th>
        <th>Title</th>
        <th>Professor</th>
      </tr>
    </thead>

    <tbody>
    @foreach ($courses->local as $course)
      <tr>
        <td>
          <a href="/course/local/{{ $course->id }}">
            <img src='/img/edit.png' alt='Edit' />
          </a>
          <a href="/admin/courses-students.php?id={{ $course->id }}">
            <img src='/img/people.png' alt='Students' />
          </a>
        </td>
        <td>{{ $course->type }}</td>
        <td>{{ $course->code }}</td>
        <td>{{ $course->title }}</td>
        <td>{{ $course->professor }}</td>
      </tr>
    @endforeach
    </tbody>

  </table>

  <div style='margin:30px 0; text-align:right;'>
    <input type='button' onclick='location.href="/admin/courses_excel_vwpp.php";' value='Export Final Reg. to Excel' class='btn' />
    <input type='button' onclick='location.href="/admin/courses_excel_vwpp2.php";' value='Export Students choices to Excel' class='btn' />

    @if (in_array(16, Auth::user()->access))
      <input type='button' onclick='location.href="/course/local";' value='Add a VWPP Course' class='btn btn-primary' />
    @endif
  </div>


  <h3>University Courses for {{ session('semester') }} ( {{ count($courses->univ) }})</h3>

  <table class='datatable' data-sort='[[1,"asc"],[2,"asc"],[3,"asc"]]' >
    <thead>
      <tr>
        <th class='dataTableNoSort'></th>
        <th>Institution</th>
        <th>Discipline</th>
        <th>Course Code</th>
        <th>Course Name</th>
        <th>Professor</th>
        <th>Type</th>
        <th>Student</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($courses->univ as $course)
        <tr>
          <td>
            <a href="/course/univ/{{ $course->id }}">
              <img src='/img/edit.png' alt='Edit' />
            </a>
          </td>
          <td>
            @if ($course->linkedTo)
              &rdsh;
            @endif
            {{ $course->institution2 }}
          </td>
          <td>{{ $course->discipline }}</td>
          <td>{{ $course->code }}</td>
          <td>{{ $course->nom }}</td><td>{{ $course->prof }}</td><td>{{ $course->nature }}</td>
          <td>{{ $course->studentName }}</td>
        </tr>
      @endforeach
    </tbody>

  </table>

  <div style='margin:20px 0; text-align:right;' >
    <input type='button' onclick='location.href="/admin/courses4_excel.php";' value='Export to excel' class='btn' />
  </div>

@endsection