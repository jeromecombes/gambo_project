@extends('layouts.myApp')
@section('content')

<h3>Documents</h3>
<p>
In this space you can upload required documents by clicking the edit button below.<br/>
Note that only pdf, jpg and word documents (with extensions .pdf, jpg our .jpeg and .doc or .docx) are permitted.<br/>
<br/>
</p>

<fieldset>

    @if($documents->count())
        <table class='datatable' data-sort='[]'>
            <thead>
                <tr>
                    @if(session('admin'))
                        <th>Student</th>
                    @endif
                    <th>Name</th>
                    <th>Documents</th>
                    @if(session('admin'))
                        <th>Visibility</th>
                    @endif
                    <th>Type</th>
                    <th>Size</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>

            @foreach($documents as $doc)
                <tr>
                    @if(session('admin'))
                        <td>{{ $doc->student }}</td>
                    @endif
                    <td><a href='/show/{{ $doc->id }}' target='_blank'> {{ $doc->name }}</a></td>
                    <td>{{ $doc->rel }}</td>
                    @if(session('admin'))
                        <td>{{ $doc->visibility }}</td>
                    @endif
                    <td>{{ $doc->type }}</td>
                    <td style='white-space:nowrap; text-align:right;'>{{ $doc->size }}</td>
                    <td style='white-space:nowrap;'>{{ $doc->time }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

    @else
        No document
    @endif

    <p class='align-right'>
        @if(session('admin'))
            @if(session('student'))
                <a class='myUI-button' href='/documents/edit'>Edit</a>
                <a class='myUI-button' href='/documents/add'>Add files</a>
            @endif
        @else
            <a class='myUI-button' href='/documents/add'>Add files</a>
        @endif
    </p>

</fieldset>


@endsection