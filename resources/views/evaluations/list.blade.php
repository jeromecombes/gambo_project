@extends('layouts.myApp')
@section('content')

  <h3>Evaluation Forms {{ session('semester') }} </h3>

  <div class='align-right'>
    <input type='button' value='All evaluations' class='btn btn-primary' onclick='location.href="{{ route('evaluations.home') }}";'/>
  </div>

  <fieldset>

    @switch ($form)
      @case ('program')
        <h3>Program Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li><a href='/evaluation/program/{{ $elem->id }}'>Program Evaluation ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('local')
        <h3>VWPP Courses Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='/evaluation/local/{{ $elem->id }}'>{{ $elem['course'] }}, {{ $elem['professor'] }} ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('univ')
        <h3>University Courses Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='/evaluation/univ/{{ $elem->id }}'>{{ $elem['course'] }}, {{ $elem['professor'] }} ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('tutoring')
        <h3>Tutorats Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='/evaluation/tutoring/{{ $elem->id }}'>Tutorats Evaluation ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('linguistic')
        <h3>Ateliers Linguistiques</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='/evaluation/linguistic/{{ $elem->id }}'>Ateliers Linguistiques ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('method')
        <h3>Ateliers Méthodologiques</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='/evaluation/method/{{ $elem->id }}'>Ateliers Méthodologiques ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('internship')
        <h3>Internship Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='/evaluation/internship/{{ $elem->id }}'>Internship Evaluation ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

    @endswitch

  </fieldset>

@endsection
