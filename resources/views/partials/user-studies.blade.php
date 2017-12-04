<h2 class="h6">{{ $profileHeading2 }}</h2>

@if($user->studies->isNotEmpty())
<ul>
    @foreach ($user->studies->sortByDesc('id')->all() as $studies)
    <li id="studies-list-{{ $studies->id }}">
        <span class="profile-section-heading">{{ $studies->institute_name }}</span>
        <span class="profile-section-city">{{ $profileLbl1 }}: {{ $studies->city_name }}</span>
        <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl3 }}: {{ $studies->studies_name }}</span>

        {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-studies-btn waves-effect waves-light btn-flat', 'data-item-id' => $studies->id)) !!}
        {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-studies-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeleteStudies('.$studies->id.')')) !!}
    </li>
    @endforeach
</ul>
@else
<p>{{ $profileMsg2 }}</p>
@endif

{!! Form::button($profileAddBtn2, array('id' => 'add-studies-btn', 'class' => 'waves-effect waves-light btn')) !!}