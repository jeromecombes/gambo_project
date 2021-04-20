@extends('emails.layouts.html')

@section('content')
  <p>
    Les étudiants suivants ont été enregistrés dans la base de données VWPP :
    <br/>
    <ul>
      @foreach ($data as $student)
        <li>{{ $student->lastname }} {{ $student->firstname }}, {{ $student->email }} {{ $student->visiting }}</li>
      @endforeach
    </ul>
    <br/>
    <br/>
    Université : {{ Auth::user()->university }}
    <br/>
  </p>
@endsection
