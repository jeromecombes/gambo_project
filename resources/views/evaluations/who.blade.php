@extends('layouts.myApp')
@section('content')

  <h3>Evaluation Forms {{ session('semester') }} </h3>

  <table class='datatable' data-sort='[[0,"asc"],[1,"asc"]]'>
    <thead>
      <tr>
        <th>Lastname</th>
        <th>Firstname</th>
        <th>Program</th>
        <th>VWPP Courses</th>
        <th>Univ. Courses</th>
        <th>Tutorats</th>
        <th>Ateliers Linguistiques</th>
        <th>Ateliers Méthodologiques</th>
        <th>Internship</th>
      </tr>
    </thead>

    <tbody>
      @foreach($evaluations as $evaluation)
        <tr>
          <td>{{ $evaluation->lastname }}</td>
          <td>{{ $evaluation->firstname }}</td>
          <td class='@if ($evaluation->program) green @else red @endif bold'>{{ $evaluation->program }}</td>
          <td class='@if ($evaluation->local == $evaluation->local_total) green bold @endif'>{{ $evaluation->local }} / {{ $evaluation->local_total }}</td>
          <td class='@if ($evaluation->univ == $evaluation->univ_total) green bold @endif'>{{ $evaluation->univ }} / {{ $evaluation->univ_total }}</td>
          <td class='@if ($evaluation->tutoring) green @else red @endif bold'>{{ $evaluation->tutoring }}</td>
          <td class='@if ($evaluation->linguistic) green @else red @endif bold'>{{ $evaluation->linguistic }}</td>
          <td class='@if ($evaluation->method) green @else red @endif bold'>{{ $evaluation->method }}</td>
          <td class='@if ($evaluation->internship) green bold @endif'>{{ $evaluation->internship }}</td>
        </tr>
      @endforeach

    </tbody>
  </table>
@endsection
