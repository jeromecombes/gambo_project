@extends('layouts.myApp')
@section('content')

  <h3>Evaluation Forms {{ session('semester') }} </h3>

  <div class='align-right'>
    @if ($evaluations_enabled)
      <input type='button' id='enableEvaluation' data-semester='{{ session("semester") }}' data-enabled='1' value='Disable evaluations' class='btn btn-primary' />
    @else
      <input type='button' id='enableEvaluation' data-semester='{{ session("semester") }}' data-enabled='0' value='Enable evaluations' class='btn btn-primary' />
    @endif
  </div>

  <fieldset id='evaluations_home_fieldset'>

    <h4>Program Evaluations</h4>
    <ul>
      <li><a href='/admin/eval_tab.php?form=program'>Table</a></li>
      <li><a href='/admin/eval_all.php?form=program'>Individual evaluations</a></li>
    </ul>

    <h4>VWPP Course Evaluations</h4>
    <ul>
      <li><a href='/admin/eval_tab.php?form=local'>Table</a></li>
      <li><a href='/admin/eval_all.php?form=local'>Individual evaluations</a></li>
    </ul>

    <h4>University Course Evaluation</h4>
    <ul>
      <li><a href='/admin/eval_tab.php?form=univ'>Table</a></li>
      <li><a href='/admin/eval_all.php?form=univ'>Individual evaluations</a></li>
    </ul>

    <h4>Tutoring Evaluations</h4>
    <ul>
      <li><a href='/admin/eval_tab.php?form=tutoring'>Table</a></li>
      <li><a href='/admin/eval_all.php?form=tutoring'>Individual evaluations</a></li>
    </ul>

    <h4>Ateliers Linguistiques</h4>
    <ul>
      <li><a href='/admin/eval_tab.php?form=linguistic'>Table</a></li>
      <li><a href='/admin/eval_all.php?form=linguistic'>Individual evaluations</a></li>
    </ul>

    <h4>Ateliers Méthodologiques</h4>
    <ul>
      <li><a href='/admin/eval_tab.php?form=method'>Table</a></li>
      <li><a href='/admin/eval_all.php?form=method'>Individual evaluations</a></li>
    </ul>

    <h4>Internship Evaluations</h4>
    <ul>
      <li><a href='/admin/eval_tab.php?form=internship'>Table</a></li>
      <li><a href='/admin/eval_all.php?form=internship'>Individual evaluations</a></li>
    </ul>
  </fieldset>

@endsection
