@extends('layouts.myApp')
@section('content')

<h3>Housing - Students requests - {{ session('semester') }}</h3>


<ul>
    <li><a href="{{ route('housing.index') }}">Housing Home</a></li>
    <li><a href="{{ asset('admin/housing_excel.php') }}">Excel</a></li>
</ul>


<table class='datatable'>
    <thead>
        <tr>
        <th class='dataTableNoSort'>&nbsp;</th>
        <th>Lastname</th>
        <th>Firstname</th>
        @foreach($questions as $question)
            <th>{{ $question }}</th>
        @endforeach
        </tr>
    </thead>

    <tbody>
    @foreach($answers as $answer)   
        <tr>
            <td>
            @if($edit_access)
                <a href="{{ asset('admin/housing-affect.php') }}?student={{ $answer['student'] }}">Loger</a>
            @endif
            </td>
            <td>{{ $answer['lastname'] }}</td>
            <td>{{ $answer['firstname'] }}</td>
            @foreach($questions_ids as $id)
                <td>
                    <div style='height:50px;max-height:50px;overflow:hidden;' title='{{ $answer[$id] }}'>{{ $answer[$id] }}</div>
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

@endsection