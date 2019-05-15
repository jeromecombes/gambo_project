@extends('layouts.myApp')
@section('content')

<h3>Documents</h3>
<p>
In this space you can upload required documents by clicking the edit button below.<br/>
Note that only pdf, jpg and word documents (with extensions .pdf, jpg our .jpeg and .doc or .docx) are permitted.<br/>
<br/>
</p>

<fieldset>
    <form method='POST' enctype='multipart/form-data' action='/documents'>
    {{ csrf_field() }}
    
    <input type='hidden' name='student' value='{{$student}}' />

        <table class='datatable' data-sort='[]'>
            <thead>
                <tr>
                    @if($_SESSION['vwpp']['category'] == 'admin')
                        <th>Name</th>
                        <th>Document</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Date</th>
                        <th>Visibility</th>
                    @else
                        <th>File</th>
                        <th>Type of document</th>
                    @endif
                </tr>
            </thead>

            <tbody>
            @if($_SESSION['vwpp']['category'] == 'admin')
                @foreach ($documents as $doc)
                    <tr>
                        <td><a href='/preview.php?id={{ $doc->id }}' target='_blank'> {{ $doc->name }}</a></td>
                        <td>{{ $doc->rel }}</td>
                        <td>{{ $doc->type }}</td>
                        <td style='text-align:right;'>{{ $doc->size }}</td>
                        <td>{{ $doc->time }}</td>
                        @if($_SESSION['vwpp']['category'] == 'admin')
                            <td>{{ $doc->visibility }}</td>
                        @endif
                    </tr>
                @endforeach
            @endif

            @for ($i = 0; $i < 3; $i++)
                <tr>
                    <td>
                        <input type='file' name='file{{$i}}' />
                    </td>
                    <td>
                        <select name='rel{{$i}}'>
                        @foreach($document_types as $elem)
                            <option value='{{ $elem }}'>{{ $elem }}</option>
                        @endforeach
                        </select>
                    </td>
                    @if($_SESSION['vwpp']['category'] == 'admin')
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type='checkbox' name='admin{{$i}}' value='1' /></td>
                    @endif
                </tr>
            @endfor

            </tbody>
        </table>

        <p class='align-right'>
            <a class='myUI-button' href='/documents'>Cancel</a>
            <input type='submit' value='Save' class='myUI-button' />
        </p>
    
    </form>

</fieldset>

@endsection