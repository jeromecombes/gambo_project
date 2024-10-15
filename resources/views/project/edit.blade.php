@extends('layouts.myApp')
@section('content')

  @if ($project->order)
    <h3>{{ $project->order }} - {{ $project->product }} - {{ $project->customer }}</h3>
  @else
    <h3>Nouveau projet</h3>
  @endif

  <ul class="nav nav-tabs" id="project-menu" >
    <li id="li0" class="active">
      <a href="javaScript:showDiv(0);">Info générales</a>
    </li>
    <li id="li1">
      <a href="javaScript:showDiv(1);">Options</a>
    </li>
    <li id="li2">
      <a href="javaScript:showDiv(2);">Support</a>
    </li>
  </ul>

  <div id="tabDiv0" class="tabDiv">
    <p><strong><u>Information générales</u></strong></p>
    <div class="bg-secondary-subtle border border-secondary-subtle rounded-3">
      <div class="container px-4 text-left">
        <div class="row gx-5 align-items-start">
          {!! Form::open(['route' => 'project.update', 'name' => 'form', 'onsubmit' => 'return true;']) !!}
            {!! Form::hidden('id', $project->id) !!}

            <table id="myTab2" border="0" style="width:100%; margin:25px 0;">

              <tr>
                <td style='width:30%;'>
                  <label for='order'>Commande</label>
                </td>
                <td style='width:40%;'>
                  {!! Form::text('order', old('order', $project->order), ['id' => 'order', 'required']) !!}
                </td>
                <td class='bold red'>
                  @if ($errors->has('order'))
                    {{ $errors->first('order') }}
                  @endif
                </td>
              </tr>

              <tr>
                <td>
                  <label for='customer'>Client</label>
                </td>
                <td>
                  {!! Form::text('customer', old('customer', $project->customer), ['id' => 'customer', 'required']) !!}
                </td>
                <td class='bold red'>
                  @if ($errors->has('customer'))
                    {{ $errors->first('customer') }}
                  @endif
                </td>
              </tr>

              <tr>
                <td>
                  <label for='email'>Email</label>
                </td>
                <td>
                  {!! Form::email('email', old('email', $project->email), ['id' => 'email', 'required']) !!}
                </td>
                <td class='bold red'>
                  @if ($errors->has('email'))
                    {{ $errors->first('email') }}
                  @endif
                </td>
              </tr>

              <tr>
                <td>
                  <label for='product'>Produit</label>
                </td>
                <td>
                  {!! Form::select('product', $products , old('product', $project->product_id), ['required']) !!}
                </td>
                <td class='bold red'>
                  @if ($errors->has('product'))
                    {{ $errors->first('product') }}
                  @endif
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
  </div>

  <div id="tabDiv1" class="tabDiv" style="display:none;">
    <p><strong><u>Options</u></strong></p>
    <div class="bg-secondary-subtle border border-secondary-subtle rounded-3">
      <div class="container px-4 text-left">
        <div class="row gx-5 align-items-start">
          <div class="col">
            <div class="p-3">
              <ul>
                @foreach ($options as $option)
                  @php
                    $checked = $projectOptions->where('option_id', $option->id)->count() ? true : false;
                  @endphp
                  <li class="option_li_{{ $option->product_id }}">
                  {!! Form::checkbox('options[]', $option->id, $checked, ['id' => 'option_' . $option->id]) !!}
                  <label for="option_{{ $option->id }}">{{ $option->value }}</label>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="tabDiv2" class="tabDiv" style="display:none;">
    <p><strong><u>Support</u></strong></p>
    <div class="bg-secondary-subtle border border-secondary-subtle rounded-3">
      <div class="container px-4 text-left">
        <div class="row gx-5 align-items-start">
          @for ($i = 0; $i < 4; $i++)
            <div class="col">
              <div class="p-3">
                <div>
                  <label for="support_lastname[{{ $i }}]">Nom</label>
                  {!! Form::text("support_lastname[$i]", old("support_lastname[$i]", $supports[$i]['lastname'])) !!}
                </div>
                <div class='bold red'>
                  @if ($errors->has("support_lastname[$i]"))
                    {{ $errors->first("support_lastname[$i]") }}
                  @endif
                </div>
  
                <div>
                  <label for="support_firstname[{{ $i }}]">Prénom</label>
                  {!! Form::text("support_firstname[$i]", old("support_firstname[$i]", $supports[$i]['firstname'])) !!}
                </div>
                <div class='bold red'>
                  @if ($errors->has("support_firstname[$i]"))
                    {{ $errors->first("support_firstname[$i]") }}
                  @endif
                </div>
  
                <div>
                  <label for="support_email[{{ $i }}]">E-Mail</label>
                  {!! Form::text("support_email[$i]", old("support_email[$i]", $supports[$i]['email'])) !!}
                </div>
                <div class='bold red'>
                  @if ($errors->has("support_email[$i]"))
                    {{ $errors->first("support_email[$i]") }}
                  @endif
                </div>

              </div>
            </div>
          @endfor
        </div>
      </div>
    </div>
  </div>
        <div style='margin:20px; text-align:right;'>
  
          {!! Form::button('Cancel', ['onclick' => 'location.href="' . route('project.index') . '";', 'class' => 'btn btn-secondary']) !!}
  
          @if (in_array(12, Auth::user()->access) and $project->id)
            {!! Form::button('Delete', ['onclick' => "projectDelete()", 'class' => 'btn btn-danger']) !!}
          @endif
  
          {!! Form::submit($project->id ? 'Update' : 'Add', ['class' => 'btn btn-primary']) !!}
  
        </div>
  
      {!! Form::close() !!}

  @if (in_array(12, Auth::user()->access) and $project->id)
    {!! Form::open(['route' => 'project.delete', 'id' => 'delete-form']) !!}
    {!! Form::hidden('_method', 'DELETE') !!}
    {!! Form::hidden('id', $project->id) !!}
    {!! Form::close() !!}
  @endif

@endsection
