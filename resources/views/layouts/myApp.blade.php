@include('includes.header')

@if($data['myCategory'] == 'student')
    @include('includes.student_menu')
@endif

@yield('content')
@include('includes.footer')
