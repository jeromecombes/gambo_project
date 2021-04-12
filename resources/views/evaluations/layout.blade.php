@extends('layouts.myApp')
@section('content')

@if (Auth::user()->admin)
  <a href='/admin/eval_index.php' style='margin-left:30px;'>All evaluations</a> > <a href='/admin/eval_all.php'>{{ $view->title }}</a>
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
            <input type='button' value='Back' class='btn btn-primary' onclick='location.href="/admin/eval_all.php";' />
          @endif
        </td>
      </tr>

    </table>
  </form>
</fieldset>

@endsection
