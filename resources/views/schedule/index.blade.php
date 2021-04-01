@extends('layouts.myApp')
@section('content')

<h3>My Schedule</h3>

<table class='datatable' data-sort='[]'>
  <thead>
    <tr>
      <th class='dataTableNoSort'>Jour</th class='dataTableNoSort'>
      <th class='dataTableNoSort'>Début</th>
      <th class='dataTableNoSort'>Fin</th>
      <th class='dataTableNoSort'>Type</th>
      <th class='dataTableNoSort'>Cours</th>
      <th class='dataTableNoSort'>Professeur</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($courses as $course)
      <tr>
        <td>{{ __($course->dayText) }}</td>
        <td>{{ $course->start }}</td>
        <td>{{ $course->end }}</td>
        <td>{{ __($course->type) }}</td>
        <td>{{ __($course->name) }}</td>
        <td>{{ $course->professor }}</td>
      </tr>
    @endforeach

  </tbody>
</table>

@endsection
