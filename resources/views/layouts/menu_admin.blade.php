<nav>
    <ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all'>
        <li class='ui-state-default ui-corner-top'><a href='/admin2'>Home</a></li>
        @if(session('semester'))
            @if(in_array(24, Auth::user()->access))
                <li class="ui-state-default ui-corner-top {{ (request()->is('dates')) ? 'ui-state-active' : '' }}"><a href='{{ asset('dates') }}'>Dates</a></li>
            @endif

            <li class="ui-state-default ui-corner-top {{ (request()->is('students')) ? 'ui-state-active' : '' }}"><a href="{{ asset('students') }}">Students</a></li>

            @if(!empty(array_intersect(array(2, 7), Auth::user()->access)))
                <li class="ui-state-default ui-corner-top {{ (request()->is('housing/home')) ? 'ui-state-active' : '' }}"><a href="{{ asset('housing/home') }}">Housing</a></li>
            @endif

            @if(in_array(17, Auth::user()->access))
                <li class="ui-state-default ui-corner-top {{ (request()->is('univ_reg/list')) ? 'ui-state-active' : '' }}"><a href='{{ asset('univ_reg/list') }}'>Univ. reg.</a></li>
            @endif

            @if(in_array(23, Auth::user()->access))
                <li class="ui-state-default ui-corner-top {{ (request()->is('courses/home')) ? 'ui-state-active' : '' }}"><a href='/courses/home'>Courses</a></li>
            @endif

            @if(!empty(array_intersect(array(18, 19, 20), Auth::user()->access)))
                <li class="ui-state-default ui-corner-top {{ (request()->is('admin/grades')) ? 'ui-state-active' : '' }}"><a href='/admin/grades3-1.php'>Grades</a></li>
            @endif

            @if(!empty(array_intersect(array(15, 22), Auth::user()->access)))
                <li class="ui-state-default ui-corner-top {{ (request()->is('*evaluations*')) ? 'ui-state-active' : '' }}"><a href='/evaluations/home'>Evaluations</a></li>
            @endif

            @if(in_array(3, Auth::user()->access))
                <li class="ui-state-default ui-corner-top {{ (request()->is('documents')) ? 'ui-state-active' : '' }}"><a href="{{ asset('documents') }}">Documents</a></li>
            @endif
        @endif

        @if(!empty(array_intersect(array(9, 10, 11, 12), Auth::user()->access)))
            <li class="ui-state-default ui-corner-top {{ (request()->is('*user*')) ? 'ui-state-active' : '' }}"><a href='/users'>Users</a></li>
        @endif

        <li class="ui-state-default ui-corner-top {{ (request()->is('account')) ? 'ui-state-active' : '' }}"><a href='/account'>My Account</a></li>
    </ul>
</nav>
