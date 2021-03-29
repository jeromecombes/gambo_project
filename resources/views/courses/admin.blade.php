@extends('layouts.myApp')
@section('content')

<h3>Courses</h3>

@include('courses.admin_vwpp')
@include('courses.student_form_university')
@include('courses.student_form_tutoring')
@include('courses.student_form_internship')

@endsection
