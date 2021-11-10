<ul class='nav nav-tabs' id='student-menu' >
  @if(in_array(1, Auth::user()->access))
    <li id='li5' class='@if (Request::is("*student*")) active @endif'>
      <a href='/student'>General info</a>
    </li>
  @endif

  @if(!empty(array_intersect(array(2,7), Auth::user()->access)))
    <li id='li7' class='@if (Request::is("*housing*")) active @endif'>
      <a href='/housing'>Housing</a>
    </li>
  @endif

  @if(in_array(17, Auth::user()->access))
    <li id='li10' class='@if (Request::is("*univ_reg*")) active @endif'>
      <a href='/univ_reg'>Univ. reg.</a>
    </li>
  @endif

  @if(!empty(array_intersect(array(16,21,23), Auth::user()->access)))
    <li id='li1' class='@if (Request::is("*courses*")) active @endif'>
      <a href='/courses'>Courses</a>
    </li>
  @endif

  @if(!empty(array_intersect(array(18,19,20), Auth::user()->access)))
    <li id='li9' class='@if (Request::is("*grades*")) active @endif'>
      <a href='/grades'>Grades</a>
    </li>
  @endif

  @if(!empty(array_intersect(array(3,8), Auth::user()->access)))
    <li id='li8' class='@if (Request::is("*documents*")) active @endif'>
      <a href='/documents'>Documents</a>
    </li>
  @endif

  @if(in_array(1, Auth::user()->access))
    <li id='li4' class='@if (Request::is("*schedule*")) active @endif'>
      <a href='/schedule'>Schedule</a>
    </li>
  @endif

  @if(session('student_previous'))
    <li class='li-previous'>
      <a href="/{{ Request::segment(1) }}/{{session('student_previous')}}">Previous</a>
    </li>
  @endif

  @if(session('student_next'))
    <li class='li-next'>
      <a href="/{{ Request::segment(1) }}/{{session('student_next')}}">Next</a>
    </li>
  @endif

    <li  class='back-to-list'>
      <a href='/students'>Back to list</a>
    </li>
</ul>
