@extends('layouts.myApp')
@section('content')

<h3>Courses</h3>

<p>Before departing from the USA :<br/>
Choose your VWPP Courses</p>
</p>

@include('courses.student_vwpp')

<div id='map'><img src='img/map.png' alt='' /></div>

<p style='margin:30px 0 0 0;'>A Paris, saisissez l'information concernant :
  <ul style='margin:5px 0 0 0'>
    <li>Vos cours universitaires</li>
    <li>Vos cours au CIPh ou autre institution</li>
  </ul>
</p>


@include('courses.student_form_university')
@include('tutoring.form')
@include('internship.form')

@endsection
