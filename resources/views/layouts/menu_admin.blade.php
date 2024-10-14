<ul class='nav nav-tabs'>

  <li class="@if (Request::is('project*')) active @endif">
    <a href='{{ route("project.index") }}'>Projets</a>
  </li>

  @if(session('semester'))
    @if(in_array(24, Auth::user()->access))
      <li class="@if (Request::is('dates')) active @endif">
        <a href='{{ asset('dates') }}'>Dates</a>
      </li>
    @endif

    <li class="@if (Request::is('students*')) active @endif">
      <a href="{{ asset('students') }}">Students</a>
    </li>

    @if(!empty(array_intersect(array(2, 7), Auth::user()->access)))
      <li class="@if (Request::is('ho*')) active @endif">
        <a href="{{ asset('housing/home') }}">Housing</a>
      </li>
    @endif

    @if(in_array(17, Auth::user()->access))
      <li class="@if (Request::is('univ_reg/list')) active @endif">
        <a href='{{ asset('univ_reg/list') }}'>Univ. reg.</a>
      </li>
    @endif

    @if(in_array(23, Auth::user()->access))
      <li class="@if (Request::is('courses/home')) active @endif">
        <a href='/courses/home'>Courses</a>
      </li>
    @endif

    @if(!empty(array_intersect(array(18, 19, 20), Auth::user()->access)))
      <li class="@if (Request::is('*grades*')) active @endif">
        <a href='{{ asset('grades/home') }}'>Grades</a>
      </li>
    @endif

    @if(in_array(15, Auth::user()->access))
      <li class="@if (Request::is('*evaluations*')) active @endif">
        <a href='/evaluations/home'>Evaluations</a>
      </li>
    @endif

    @if(in_array(22, Auth::user()->access))
      <li class="@if (Request::is('*evaluations*')) active @endif">
        <a href='/evaluations/who'>Evaluations</a>
      </li>
    @endif

    @if(in_array(3, Auth::user()->access))
      <li class="@if (Request::is('documents')) active @endif">
        <a href="{{ asset('documents') }}">Documents</a>
      </li>
    @endif
  @endif

  @if(!empty(array_intersect(array(9, 10, 11, 12), Auth::user()->access)))
    <li class="@if (Request::is('*user*')) active @endif">
      <a href='/users'>Users</a>
    </li>
  @endif

  <li class="@if (Request::is('account')) active @endif">
    <a href='/account'>My Account</a>
  </li>
</ul>
