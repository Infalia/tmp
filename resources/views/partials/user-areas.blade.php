<h4 class="h6">{{ $profileHeading2 }}</h4>

@if($user->areas->isNotEmpty())
<ul>
    @foreach ($user->areas->sortBy('id')->all() as $area)
    <li>
        <span class="profile-section-interest"><i class="tiny material-icons">room</i> {{ $area->address }}</span>

        {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-area-btn waves-effect waves-light btn-flat', 'data-item-id' => $area->id)) !!}
        {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-area-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeleteArea('.$area->id.')')) !!}
    </li>
    @endforeach
</ul>
@else
<p>{{ $profileMsg2 }}</p>
@endif

{!! Form::button($profileAddBtn2, array('id' => 'add-area-btn', 'class' => 'waves-effect waves-light btn')) !!}