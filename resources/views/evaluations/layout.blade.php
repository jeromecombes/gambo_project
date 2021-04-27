@extends('layouts.myApp')
@section('content')

@if (Auth::user()->admin)
  <h3>Evaluation Forms {{ session('semester') }} </h3>

  <div class='align-right'>
    <input type='button' value='All evaluations' class='btn' onclick='location.href="{{ route('evaluations.home') }}";'/>
    <input type='button' value='{{ $view->title }}' class='btn btn-primary' onclick='location.href="{{ route('evaluations.list', $view->form) }}";'/>
  </div>

@endif

<div style='text-align:right; margin-top:30px;'>
  @if (!Auth::user()->admin)
    <input type='button' value='Back to list' onclick='location.href="{{ route('evaluations.index') }}";' class='btn' />
  @endif
</div>

<div style='text-align:center; margin-bottom: 50px; font-weight: bold; font-size:1.5em;'>
  VASSAR-WESLEYAN PROGRAM IN PARIS<br/>
  {{ $view->title }}, {{ session('semester') }}<br/>
  @stack('subtitle')
</div>

<fieldset class='evaluations'>
  <form method='post' action='{{ route("evaluations.update") }}' name='form' onsubmit='return ctrl_form3();' >
    <input type='hidden' name='form' value='{{ $view->form }}' />
    <input type='hidden' name='course_id' value='{{ $view->course_id }}' />
    {{ csrf_field() }}

    <table>
      <tr>
        <td style='width:25%;'></td>
        <td style='width:25%;'></td>
        <td style='width:25%;'></td>
        <td style='width:25%;'></td>
      </tr>

      @yield('evaluation_form')

      <tr>
        <td colspan='4' style='text-align:center;padding:40px;'>
          @if ($edit)
            <input type='submit' value='Submit' class='btn btn-primary' />
          @endif
          @if (Auth::user()->admin)
            <input type='button' value='Back' class='btn btn-primary' onclick='location.href="{{ route('evaluations.list', $view->form) }}";' />
          @endif
        </td>
      </tr>

    </table>
  </form>
</fieldset>

@endsection
