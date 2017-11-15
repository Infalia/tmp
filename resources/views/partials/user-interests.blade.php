<h4 class="h6">{{ $profileHeading1 }}</h4>

@if($user->interests->isNotEmpty())
<ul>
    @foreach ($user->interests->sortBy('interest_name')->all() as $interest)
    <li id="interest-list-{{ $interest->id }}">
        <span class="profile-section-interest">{{ $interest->interest_name }}</span>

        {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-interest-btn waves-effect waves-light btn-flat', 'data-item-id' => $interest->id)) !!}
        {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-interest-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeleteInterest('.$interest->id.')')) !!}
    </li>
    @endforeach
</ul>
@else
<p>{{ $profileMsg1 }}</p>
@endif

{!! Form::button($profileAddBtn1, array('id' => 'add-interest-btn', 'class' => 'waves-effect waves-light btn')) !!}