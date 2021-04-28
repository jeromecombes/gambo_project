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
            <li><a href='{{ route("evaluations.form", ["program", $elem->id]) }}'>Program Evaluation ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('local')
        <h3>VWPP Courses Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='{{ route("evaluations.form", ["local", $elem->id]) }}'>{{ $elem['course'] }}, {{ $elem['professor'] }} ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('univ')
        <h3>University Courses Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='{{ route("evaluations.form", ["univ", $elem->id]) }}'>{{ $elem['course'] }}, {{ $elem['professor'] }} ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('tutoring')
        <h3>Tutorats Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='{{ route("evaluations.form", ["tutoring", $elem->id]) }}'>Tutorats Evaluation ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('linguistic')
        <h3>Ateliers Linguistiques</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='{{ route("evaluations.form", ["linguistic", $elem->id]) }}'>Ateliers Linguistiques ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('method')
        <h3>Ateliers Méthodologiques</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='{{ route("evaluations.form", ["method", $elem->id]) }}'>Ateliers Méthodologiques ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

      @case ('internship')
        <h3>Internship Evaluations</h3>
        <ul>
          @foreach ($evaluations as $elem)
            <li style='margin-left:20px;'><a href='{{ route("evaluations.form", ["internship", $elem->id]) }}'>Internship Evaluation ({{ $elem->id }})</a></li>
          @endforeach
        </ul>
        @break

    @endswitch

  </fieldset>

@endsection
