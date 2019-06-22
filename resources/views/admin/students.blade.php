@extends('layouts.myApp')
@section('content')

<h3>Student list for {{ session('semester') }}</h3>

<br/>

<table style='margin-bottom: 30px;'>
    <tr>
        <td>Number of students : {{ $students->count() }}</td>
        <td>Vassar : {{ $vassar }}</td>
        <td>Wesleyan : {{ $wesleyan }}</td>
        <td>Other : {{ $other }}</td>
        <td><a href='#' class ='btn btn-primary'>Add students</a></td>
    </tr>
</table>

@if($students->count())
    <table class='datatable' data-sort='[]'>
        <thead>
            <tr>
                <th class='dataTableNoSort'>
                    <input type='checkbox' id='check_all' />
                </th>
                <th>Lastanme</th>
                <th>Firstname</th>
                <th>Gender</th>
                <th>French Univ.</th>
                <th>Email</th>
                <th>Home Institution</th>
            </tr>
        </thead>
        
        @foreach($students as $student)
            <tr>
                <td>
                    <input type='checkbox' name='students[]' class='check_item studentsCheckbox' value='{{ $student->id }}' onclick='setTimeout("select_action(\"form\")",5);'/>
                    <input type='hidden' id='mail_{{ $student->id }}' value='{{ $student->mail }}' />
                    <a href='students-view2.php?id={{ $student->id }}' class='studentsEdit' >
                        <img src='../img/edit.png' alt='view' border='0'/>
                    </a>
                </td>
                <td>{{ $student->lastname }}</td>
                <td>{{ $student->firstname }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->univreg }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->university}}</td>
            </tr>
        @endforeach
    
    </table>
@endif

@endsection