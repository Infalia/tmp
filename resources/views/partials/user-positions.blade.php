<h2 class="h6">{{ $profileHeading1 }}</h2>

@if($user->positions->isNotEmpty())
<ul>
    @foreach ($user->positions->sortByDesc('start_date')->all() as $position)
    <li id="position-list-{{ $position->id }}" @if(empty($position->end_date)) class="current" @endif>
        <span class="profile-section-heading">{{ $position->company_name }}</span>
        <span class="profile-section-city">{{ $profileLbl1 }}: {{ $position->city_name }}</span>
        <span class="profile-section-city">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $position->start_date)->format('M Y') }} - @if(!empty($position->end_date)) {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $position->end_date)->format('M Y') }} @else {{ $profileText2 }} @endif</span>
        <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl2 }}: {{ $position->position_name }}</span>
        @if(empty($position->end_date))
        <span class="current-lbl">{{ $profileText1 }}</span>
        @endif

        {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-position-btn waves-effect waves-light btn-flat', 'data-item-id' => $position->id)) !!}
        {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-position-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeletePosition('.$position->id.')')) !!}
    </li>
    @endforeach
</ul>
@else
<p>{{ $profileMsg1 }}</p>
@endif

{!! Form::button($profileAddBtn1, array('id' => 'add-position-btn', 'class' => 'waves-effect waves-light btn')) !!}