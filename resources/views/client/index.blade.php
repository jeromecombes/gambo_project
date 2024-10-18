@extends('layouts.myApp')
@section('content')

<h1>Votre projet {{ $project->product }}</h1>

<div>
Commande {{ $project->order }}<br/>
Client {{ $project->customer }}
</div>

<h2>Questions</h2>

<div class="accordion" id="accordionQuestions">

  @foreach ($options as $option)
    @php
      $collapsed = $loop->first ? null : 'collapsed';
      $expanded = $loop->first ? true : false;
    @endphp

    <div class="accordion-item">
      <h3 class="accordion-header">
        <button class="accordion-button {{ $collapsed }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $option->id }}" aria-expanded="{{ $expanded }}" aria-controls="collapse_{{ $option->id }}">
          {{ $option->option_value }}
        </button>
      </h3>
      <div id="collapse_{{ $option->id }}" class="accordion-collapse collapse @if ($loop->first) show @endif" data-bs-parent="#accordionQuestions">
        <div class="accordion-body">
          <ul>
          @foreach ($questions->where('option_id', $option->id) as $question)
              <li>{{ $question->question }}</li>
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endforeach
</div>

@endsection

