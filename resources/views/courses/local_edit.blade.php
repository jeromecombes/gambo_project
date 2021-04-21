@extends('layouts.myApp')
@section('content')

  <h3>VWPP Courses for {{ session('semester') }}</h3>

  <fieldset id='local_course_fieldset'>
    {{ Form::open(['route' => 'course.update']) }}
    {{ Form::hidden('id', $course->id) }}

      <table>
        <tr>
          <td>{{ Form::label('code', 'Code') }}</td>
          <td>{{ Form::text('code', old('code', $course->code), ['id' => 'code']) }}</td>
        </tr>

        <tr>
          <td>{{ Form::label('nom', 'Nom du cours') }}</td>
          <td>{{ Form::text('nom', old('nom', $course->nom), ['id' => 'nom']) }}</td>
        </tr>

        <tr>
          <td>{{ Form::label('course_title', 'Course title') }}</td>
          <td>{{ Form::text('title', old('title', $course->title), ['id' => 'course_title']) }}</td>
        </tr>

        <tr>
          <td>{{ Form::label('professor', 'Professor (Lastname, Firstname)') }}</td>
          <td>{{ Form::text('professor', old('professor', $course->professor), ['id' => 'professor']) }}</td>
        </tr>

        <tr>
          <td>{{ Form::label('type', 'Type') }}</td>
          <td>{{ Form::select('type', ['' => '', 'Writing' => 'Writing-Intensive Course', 'Seminar' => 'Seminar'], $course->type, ['id' => 'type']) }}</td>
        </tr>

        <tr>
          <td style='padding-top:5px;'><b>Schedule</b></td>
          <td style='padding-top:5px;'>
            {{ Form::label('day', 'On') }}
            {{ Form::select('day', $days, $course->day, ['id' => 'day']) }}

            {{ Form::label('start', 'from') }}
            {{ Form::select('start', $hours, $course->start, ['id' => 'start']) }}

            {{ Form::label('end', 'to') }}
            {{ Form::select('end', $hours, $course->end, ['id' => 'end']) }}
          </td>
        </tr>

        <tr>
          <td colspan='2' style='text-align:right; padding-top:30px;'>
            {{ Form::button('Cancel', ['onclick' => 'location.href="/courses/home"', 'class' => 'btn']) }}

            @if (in_array(16, Auth::user()->access))
              @if ($delete_authorized)
                {{ Form::button('Delete', ['onclick' => "delete_local_course('$delete_warning')", 'class' => 'btn']) }}
              @endif

              {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            @endif
          </td>
        </tr>
      </table>
    {{ Form::close() }}
  </fieldset>

  @if ($delete_authorized)
    {!! Form::open(['route' => 'course.delete', 'id' => 'delete-form']) !!}
    {!! Form::hidden('_method', 'DELETE') !!}
    {!! Form::hidden('id', $course->id) !!}
    {!! Form::close() !!}
  @endif

@endsection
