<h4 class="h6">{{ $profileHeading3 }}</h4>

@if($user->skills->isNotEmpty())
<ul>
    @foreach ($user->skills->sortBy('skill_name')->all() as $skill)
    <li id="skill-list-{{ $skill->id }}">
        <span class="profile-section-skill">{{ $skill->skill_name }}</span>

        {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-skill-btn waves-effect waves-light btn-flat', 'data-item-id' => $skill->id)) !!}
        {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-skill-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeleteSkill('.$skill->id.')')) !!}
    </li>
    @endforeach
</ul>
@else
<p>{{ $profileMsg3 }}</p>
@endif

{!! Form::button($profileAddBtn3, array('id' => 'add-skill-btn', 'class' => 'waves-effect waves-light btn')) !!}