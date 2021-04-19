<h3>{{ __('University') }}</h3>

<div id='course'>

  {{-- SELECTED COURSES --}}

  @foreach ($courses as $course)
    @if (!$course->linkedTo)
      @include('courses.student_form_university_elements')
      @foreach ($course->links as $course)
        @include('courses.student_form_university_elements')
      @endforeach
    @endif
  @endforeach


  {{-- ADD A COURSE BUTTON --}}

  @if (!Auth::user()->admin or $admin2)
    <div style='text-align:right; margin:20px;'>
      <input type='button' value="Ajouter un cours à l'université" onclick='document.location.href="{{ asset('/course/univ') }}";' id='AddCourseButton' class='btn btn-primary'/>
    </div>

    {!! Form::open(['route' => 'courses.univ.delete', 'id' => 'delete-univ']) !!}
    {!! Form::hidden('_method', 'DELETE') !!}
    {!! Form::hidden('id', '', ['id' => 'delete-univ-id']) !!}
    {!! Form::close() !!}
  @endif

</div>
