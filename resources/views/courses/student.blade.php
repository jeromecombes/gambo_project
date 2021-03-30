@extends('layouts.myApp')
@section('content')

<h3>Courses</h3>

<p>Before departing from the USA :<br/>
Choose your VWPP Courses</p>
</p>

@include('courses.student_vwpp')
@include('courses.student_form_university')
@include('tutoring.form')
@include('internship.form')

@endsection
