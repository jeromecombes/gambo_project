<h3>University</h3>

<div id='course'>

  {{-- SELECTED COURSES --}}

  @foreach ($courses as $course)
    @include('courses.student_form_university_elements')
  @endforeach


  {{-- ADD A COURSE BUTTON --}}

  @if (!$admin or $admin2)
    <div style='text-align:right; margin:20px;'>
      <input type='button' value="Ajouter un cours à l'université" onclick='document.location.href="{{ asset('/course/univ/add') }}";' id='AddCourseButton' class='btn btn-primary'/>
    </div>
  @endif

</div>
