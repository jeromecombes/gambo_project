@extends('emails.layouts.html')

@section('content')
  <p>
    {!! nl2br(e($data->message)) !!}
  </p>
@endsection
