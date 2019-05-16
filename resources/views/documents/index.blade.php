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
                    <th>Name</th>
                    <th>Documents</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Date</th>
                    @if(session('admin'))
                        <th>Visibility</th>
                    @endif
                </tr>
            </thead>
            <tbody>

            @foreach($documents as $doc)
                <tr>
                    <td><a href='/show/{{ $doc->id }}' target='_blank'> {{ $doc->name }}</a></td>
                    <td>{{ $doc->rel }}</td>
                    <td>{{ $doc->type }}</td>
                    <td style='white-space:nowrap; text-align:right;'>{{ $doc->size }}</td>
                    <td style='white-space:nowrap;'>{{ $doc->time }}</td>
                    @if(session('admin'))
                        <td>{{ $doc->visibility }}</td>
                    @endif
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