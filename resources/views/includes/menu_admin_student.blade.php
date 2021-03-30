<nav>
  <ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all' id='student-menu' >
    <li id='li5' class='ui-state-default ui-corner-top @if (Request::is("*student*")) ui-state-active @endif'><a href='/student'>General info</a></li>

    @if(in_array(2, session('access')))
      <li id='li7' class='ui-state-default ui-corner-top @if (Request::is("*housing*")) ui-state-active @endif'><a href='/housing'>Housing</a></li>
    @endif

    @if(in_array(17, session('access')))
      <li id='li10' class='ui-state-default ui-corner-top @if (Request::is("*univ_reg*")) ui-state-active @endif'><a href='/univ_reg'>Univ. reg.</a></li>
    @endif

    @if(in_array(23, session('access')))
      <li id='li1' class='ui-state-default ui-corner-top @if (Request::is("*courses*")) ui-state-active @endif'><a href='/courses'>Courses</a></li>
    @endif

    @if(!empty(array_intersect(array(18,19,20), session('access'))))
      <li id='li9' class='ui-state-default ui-corner-top'><a href='/admin/students-view2.php?menu_id=7'>Grades</a></li>
    @endif

    @if(in_array(3, session('access')))
      <li id='li8' class='ui-state-default ui-corner-top @if (Request::is("*documents*")) ui-state-active @endif'><a href='/documents'>Documents</a></li>
    @endif

      <li id='li4' class='ui-state-default ui-corner-top'><a href='/admin/students-view2.php?menu_id=8'>Schedule</a></li>

    @if(session('student_previous'))
      <li class='ui-state-default ui-corner-top li-previous'><a href="/{{ Request::segment(1) }}/{{session('student_previous')}}">Previous</a></li>
    @endif

    @if(session('student_next'))
      <li class='ui-state-default ui-corner-top li-next'><a href="/{{ Request::segment(1) }}/{{session('student_next')}}">Next</a></li>
    @endif

      <li  class='ui-state-default ui-corner-top back-to-list'><a href='/students'>Back to list</a></li>
  </ul>
</nav>
