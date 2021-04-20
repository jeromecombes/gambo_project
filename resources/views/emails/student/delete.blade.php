@extends('emails.layouts.html')

@section('content')
  <p>
    Les étudiants suivants ont été supprimés de la base de données VWPP :
    <br/>
    <ul>
      @foreach ($data as $student)
        <li>{{ $student->lastname }} {{ $student->firstname }}, {{ $student->email }}, {{ $student->university }} {{ $student->visiting }}</li>
      @endforeach
    </ul>
    <br/>
    <br/>
  </p>
@endsection
