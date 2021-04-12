@php
use App\Models\EvaluationEnabled;

$evaluations = EvaluationEnabled::where('semester', session('semester'))->get();
$displayEvaluation = count($evaluations);
@endphp

<nav>
  <ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all'>
    <li id='li0' class='ui-state-default ui-corner-top @if (Request::is("*semester*") or Request::is("/")) ui-state-active @endif''><a href='/'>Home</a></li>
    <li id='li7' class='ui-state-default ui-corner-top @if (Request::is("*student*")) ui-state-active @endif'><a href='/student'>General Info.</a></li>
    <li id='li2' class='ui-state-default ui-corner-top @if (Request::is("*housing*")) ui-state-active @endif'><a href='/housing'>Housing</a></li>
    <li id='li1' class='ui-state-default ui-corner-top @if (Request::is("*univ_reg*")) ui-state-active @endif'><a href='/univ_reg'>Univ. Reg.</a></li>
    <li id='li3' class='ui-state-default ui-corner-top @if (Request::is("*courses*")) ui-state-active @endif'><a href='/courses'>Courses</a></li>
    @if ($displayEvaluation)
      <li id='li4' class='ui-state-default ui-corner-top @if (Request::is("*eval*")) ui-state-active @endif'><a href='/evaluations'>Evaluations</a></li>
    @endif
    <li id='li8' class='ui-state-default ui-corner-top @if (Request::is("*documents*")) ui-state-active @endif'><a href='/documents'>Documents</a></li>
    <li id='li9' class='ui-state-default ui-corner-top @if (Request::is("*schedule*")) ui-state-active @endif'><a href='/schedule'>Schedule</a></li>
    <li id='li10' class='ui-state-default ui-corner-top @if (Request::is("*trip*")) ui-state-active @endif'><a href='/trip'>Trip</a></li>
    <li id='li6' class='ui-state-default ui-corner-top @if (Request::is("*account*")) ui-state-active @endif'><a href='{{ route('account.index') }}'>My Account</a></li>
  </ul>
</nav>
