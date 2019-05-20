@extends('layouts.myApp')
@section('content')

<h3>Documents</h3>
<p>
In this space you can upload required documents by clicking the edit button below.<br/>
Note that only pdf, jpg and word documents (with extensions .pdf, jpg our .jpeg and .doc or .docx) are permitted.<br/>
<br/>
</p>

<fieldset>
    <form method='post' enctype='multipart/form-data' action='/documents'>
    {{ csrf_field() }}
    
    <input type='hidden' name='student' value="{{session('student')}}" />

        <table class='datatable' data-sort='[]'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Document</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Date</th>
                    <th>Admin Only</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($documents as $doc)
                <tr>
                    <td><a href='/preview.php?id={{ $doc->id }}' target='_blank'> {{ $doc->name }}</a></td>
                    <td>{{ $doc->rel }}</td>
                    <td>{{ $doc->type }}</td>
                    <td style='white-space:nowrap; text-align:right;'>{{ $doc->size }}</td>
                    <td style='white-space:nowrap;'>{{ $doc->time }}</td>
                    <td>{{ $doc->visibility }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <p class='align-right'>
            <a class='myUI-button' href='/documents'>Cancel</a>
            <input type='submit' value='Save' class='myUI-button' />
        </p>
    
    </form>

</fieldset>

@endsection