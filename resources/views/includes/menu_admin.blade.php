<nav>
    <ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all'>
        <li id='li0' class='ui-state-default ui-corner-top'><a href='index.php'>Home</a></li>

        @if(session('semester'))
            @if(in_array(24, session('access')))
                <li id='li11' class='ui-state-default ui-corner-top'><a href='/admin/dates.php'>Dates</a></li>
            @endif

            <li id='li5' class='ui-state-default ui-corner-top'><a href='/admin/students-list.php'>Students</a></li>

            @if(in_array(2, session('access')))
                <li id='li7' class='ui-state-default ui-corner-top'><a href='/admin/housing.php'>Housing</a></li>
            @endif

            <li id='li10' class='ui-state-default ui-corner-top'><a href='/admin/univ_reg.php'>Univ. reg.</a></li>

            @if(in_array(23, session('access')))
                <li id='li1' class='ui-state-default ui-corner-top'><a href='/admin/courses4.php'>Courses</a></li>
            @endif

            @if(!empty(array_intersect(array(18,19,20), session('access'))))
                <li id='li9' class='ui-state-default ui-corner-top'><a href='/admin/grades3-1.php'>Grades</a></li>
            @endif

            <li id='li4' class='ui-state-default ui-corner-top'><a href='/admin/eval_index.php'>Evaluations</a></li>

            @if(in_array(3, session('access')))
                <li id='li8' class='ui-state-default ui-corner-top ui-state-active'><a href='/documents'>Documents</a></li>
            @endif
        @endif

        @if(in_array(9, session('access')))
            <li id='li2' class='ui-state-default ui-corner-top'><a href='/admin/users.php'>Users</a></li>
        @endif

        <li id='li6' class='ui-state-default ui-corner-top'><a href='/admin/myAccount.php'>My Account</a></li>
    </ul>
</nav>