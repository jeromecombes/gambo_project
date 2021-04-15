@extends('layouts.myApp')
@section('content')
  <h3>Dates, Deadlines</h3>

  <fieldset id='dates_fieldset'>

    {{ Form::open(['url' => route('dates.update')]) }}

      <table>

        <thead>
          <tr>
            <th>Home form</th>
            <th>Date</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              {{ Form::label('date1', 'Personal details and contact information by') }}
            </td>
            <td>
              {{ Form::text('date1', $dates->date1, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date2', 'Housing preferences by') }}
            </td>
            <td>
              {{ Form::text('date2', $dates->date2, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date3', 'University preference by') }}
            </td>
            <td>
              {{ Form::text('date3', $dates->date3, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date4', 'Pre-registration for VWPP Courses by') }}
            </td>
            <td>
              {{ Form::text('date4', $dates->date4, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>
        </tbody>
      </table>

      <br/>
      <br/>

      <table>

        <thead>
          <tr>
            <th>Univ registration form</th>
            <th>Date</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              {{ Form::label('date5', 'Paris  3, end of course') }}
            </td>
            <td>
              {{ Form::text('date5', $dates->date5, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date6', 'Paris  4, end of course') }}
            </td>
            <td>
              {{ Form::text('date6', $dates->date6, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date7', 'Paris  7, end of course') }}
            </td>
            <td>
              {{ Form::text('date7', $dates->date7, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

          <tr>
            <td>
              {{ Form::label('date8', 'Paris 12, end of course') }}
            </td>
            <td>
              {{ Form::text('date8', $dates->date8, ['class' => 'myUI-datepicker-string']) }}
            </td>
          </tr>

        </tbody>

      </table>

      <div>
        {{ Form::submit('Valider', ['class' => 'btn btn-primary']) }}
      </div>

    {{ Form::close() }}

  </fieldset>

@endsection
