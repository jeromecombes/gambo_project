@extends('emails.layouts.html')

@section('content')
<style type='text/css'>
  body, p, fieldset {
    color: black;
  }

  fieldset {
    border: none;
  }

  .response {
    margin: 5px 0 20px 0;
    color:blue;
    font-weight:bold;
    text-align:justify;
  }
</style>

@include('trip.form')

@endsection
