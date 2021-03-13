<nav>
    <ul class='ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all'>
        <li id='li0' class='ui-state-default ui-corner-top'><a href='index.php'>Home</a></li>
        <li id='li7' class='ui-state-default ui-corner-top @if (Request::is("*student*")) ui-state-active @endif'><a href='/student'>General Info.</a></li>
        <li id='li2' class='ui-state-default ui-corner-top @if (Request::is("*housing*")) ui-state-active @endif'><a href='/housing'>Housing</a></li>
        <li id='li1' class='ui-state-default ui-corner-top'><a href='univ_registration.php'>Univ. Reg.</a></li>
        <li id='li3' class='ui-state-default ui-corner-top'><a href='courses.php'>Course Reg.</a></li>
        <li id='li4' class='ui-state-default ui-corner-top' style='display:none;' ><a href='eval_index.php'>Evaluations</a></li>
        <li id='li8' class='ui-state-default ui-corner-top @if (Request::is("*documents*")) ui-state-active @endif'><a href='/documents'>Documents</a></li>
        <li id='li9' class='ui-state-default ui-corner-top'><a href='schedule.php'>Schedule</a></li>
        <li id='li10' class='ui-state-default ui-corner-top'><a href='trip_index.php'>Trip</a></li>
        <li id='li6' class='ui-state-default ui-corner-top'><a href='myAccount.php'>My Account</a></li>
    </ul>
</nav>