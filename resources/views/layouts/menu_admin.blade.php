<ul class='nav nav-tabs'>

  @if(Auth::user()->admin)
    <li class="@if (Request::is('project*')) active @endif">
      <a href='{{ route("project.index") }}'>Projets</a>
    </li>

    @if(!empty(array_intersect(array(9, 10, 11, 12), Auth::user()->access)))
      <li class="@if (Request::is('*user*')) active @endif">
        <a href='/users'>Users</a>
      </li>
    @endif
  @endif

  <li class="@if (Request::is('account')) active @endif">
    <a href='/account'>My Account</a>
  </li>
</ul>
