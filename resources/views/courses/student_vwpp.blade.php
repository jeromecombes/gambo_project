<h3>VWPP Courses</h3>

{{-- Student Choices --}}

<fieldset>
  <form name='form' action='/courses/reidhall/choices' method='post'>
    {{ csrf_field() }}
    <input type='hidden' name='univ' value='Reid hall' />

    <h4>My Choices</h4>
    <table>

      @include('courses.student_form_vwpp')

    </table>
  </form>
</fieldset>


{{-- Final Reg --}}

@if ($show_final_reg)
  <fieldset>
  <h4>Final Registration</h4>
    <ul>
      @if ($assignment_text->writing1) <li>{{ $assignment_text->writing1 }}</li> @endif
      @if ($assignment_text->writing2) <li>{{ $assignment_text->writing2 }}</li> @endif
      @if ($assignment_text->seminar1) <li>{{ $assignment_text->seminar1 }}</li> @endif
      @if ($assignment_text->seminar2) <li>{{ $assignment_text->seminar2 }}</li> @endif
      @if ($assignment_text->seminar3) <li>{{ $assignment_text->seminar3 }}</li> @endif
    </ul>
  </fieldset>
@endif

