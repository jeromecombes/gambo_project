@extends('layouts.myApp')
@section('content')

@if (session('admin'))
  <a href='/admin/eval_index.php' style='margin-left:30px;'>All evaluations</a> > <a href='/admin/eval_all.php'>{{ $view->title }}</a>
@endif

<div style='text-align:right; margin:30px 0 50px;'>
  @if (!session('admin'))
    <input type='button' value='Back to list' onclick='location.href="{{ route('evaluations.index') }}";' class='btn' />
  @endif

  <h3 style='text-align:center;'>VASSAR-WESLEYAN PROGRAM IN PARIS<br/>{{ $view->title }} Form, {{ session('semester') }}</h3>
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
          @if (session('admin'))
            <input type='button' value='Back' class='btn btn-primary' onclick='location.href="/admin/eval_all.php";' />
          @endif
        </td>
      </tr>

    </table>
  </form>
</fieldset>

@endsection
