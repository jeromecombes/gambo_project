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
                    @if($_SESSION['vwpp']['category'] == 'admin')
                        <th>Visibility</th>
                    @endif
                </tr>
            </thead>
            <tbody>

            @foreach($documents as $doc)
                <tr>
                    <td><a href='/preview/{{ $doc->id }}' target='_blank'> {{ $doc->name }}</a></td>
                    <td>{{ $doc->rel }}</td>
                    <td>{{ $doc->type }}</td>
                    <td style='text-align:right;'>{{ $doc->size }}</td>
                    <td>{{ $doc->time }}</td>
                    @if($_SESSION['vwpp']['category'] == 'admin')
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
        @if($_SESSION['vwpp']['category'] == 'admin')
            <a class='myUI-button' href='/documents/edit'>Edit</a>
        @else
            <a class='myUI-button' href='/documents/edit'>Add files</a>
        @endif
    </p>

</fieldset>


@endsection