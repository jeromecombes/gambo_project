@php
use App\Models\EvaluationEnabled;

$evaluations = EvaluationEnabled::where('semester', session('semester'))->get();
$displayEvaluation = count($evaluations);
@endphp

<ul class='nav nav-tabs'>

  <li id='li0' class='@if (Request::is("*semester*") or Request::is("/")) active @endif''>
    <a href='/'>Home</a>
  </li>

  <li id='li7' class='@if (Request::is("*student*")) active @endif'>
    <a href='/student'>General Info.</a>
  </li>

  <li id='li2' class='@if (Request::is("*housing*")) active @endif'>
    <a href='/housing'>Housing</a>
  </li>

  <li id='li1' class='@if (Request::is("*univ_reg*")) active @endif'>
    <a href='/univ_reg'>Univ. Reg.</a>
  </li>

  <li id='li3' class='@if (Request::is("*courses*")) active @endif'>
    <a href='/courses'>Courses</a>
  </li>

  @if ($displayEvaluation)
    <li id='li4' class='@if (Request::is("*eval*")) active @endif'>
      <a href='/evaluations'>Evaluations</a>
    </li>
  @endif

  <li id='li8' class='@if (Request::is("*documents*")) active @endif'>
    <a href='/documents'>Documents</a>
  </li>

  <li id='li9' class='@if (Request::is("*schedule*")) active @endif'>
    <a href='/schedule'>Schedule</a>
  </li>

  <li id='li10' class='@if (Request::is("*trip*")) active @endif'>
    <a href='/trip'>Trip</a>
  </li>

  <li id='li6' class='@if (Request::is("*account*")) active @endif'>
    <a href='{{ route('account.index') }}'>My Account</a>
  </li>
</ul>
