@extends('layouts.myApp')
@section('content')

  <h3>Adding students for {{ session('semester') }}</h3>
  <fieldset id='students_add_fieldset'>

    {{ Form::open(['url' => route('student.store'), 'method' => 'PUT']) }}

      <table>
        <tr>
          <th>Lastname</th>
          <th>Firstname</th>
          <th>Email</th>
          <th>Other</th>
        </tr>

        @for ($i=0; $i<60; $i++)
          <tr @if ($i > 2 ) style='display:none;' @endif id='tr_{{ $i }}'>
            <td>
              {{ Form::text("students[$i][]", null, ['onkeydown' => "add_fields($i)"]) }}
            </td>
            <td>
              {{ Form::text("students[$i][]") }}
            </td>
            <td>
              {{ Form::email("students[$i][]") }}
            </td>
            <td>
              {{ Form::checkbox("students[$i][]") }}
            </td>
          </tr>
        @endfor
      </table>

      <div style='margin:30px 30px 0 0; text-align:right;'>
        {{ Form::button('Cancel', ['onclick' => 'history.back();', 'class' => 'btn']) }}
        {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
      </div>
    {{ Form::close() }}
  </fieldset>

@endsection
