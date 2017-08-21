@extends('layouts.app')

@section('csslibs')
    {!! HTML::style('owl/assets/owl.carousel.min.css') !!}
    {!! HTML::style('owl/assets/owl.theme.green.min.css') !!}
    {!! HTML::style('baguettebox/baguetteBox.min.css') !!}
    {!! HTML::style('jquery-comments/jquery-comments.css') !!}
@endsection

@section('content')
    <div class="content">
        @if(Auth::check())
            @include('partials.sidebar')
        @endif

        <div class="profile-container {{ Auth::check() ? '' : 'no-margin' }}">
            <div class="initiative">

                <div class="row">
                    @if(!empty($initiative))

                    <div class="col s12 right-align">
                        @if(Auth::check() && Auth::id() == $initiative->user->id)
                        <a class="waves-effect waves-light btn" href="{{ url('offer/edit/'.$initiative->id.'/'.str_slug($initiative->title)) }}">{{ $editBtn }}</a>
                        {!! Form::button($deleteBtn, array('id' => 'delete-btn', 'class' => 'btn waves-effect waves-light red darken-1', 'onclick' => 'return confirm("Are you sure?");')) !!}
                        @endif
                    </div>

                    <div class="col s12">
                        @if(!empty($initiative->images))
                        <div class="owl-carousel owl-theme">
                            @foreach ($initiative->images as $image)
                            <div class="item carousel-item">
                                <a href="{{ env('APP_URL') }}/storage/initiatives/{{ $image->name }}" data-caption="{{ $initiative->title }}">
                                    {!! HTML::image('storage/initiatives/'.$image->name, $initiative->title, array('class' => '')) !!}
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @endif


                        <h1 class="h5 initiative-title">{{ $initiative->title }}</h1>

                        <div class="initiative-info">
                            <span class="initiative-type">{{ $initiative->initiativeType->name }}</span>
                            <span class="initiative-created grey-text text-darken-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->created_at)->diffForHumans() }}</span>
                            <span>- by {{ $initiative->user->name }}</span>
                        </div>

                        <div class="initiative-info">
                            <span class="initiative-start-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->start_date)->format('l, j M Y H:i') }}</span>
                            <span class="initiative-address">Not available</span>
                        </div>

                        <div class="initiative-descr">{{ $initiative->description }}</div>

                        <div class="initiative-engagements">
                            <span class="initiative-engagement"><i class="material-icons inline-icon grey-text text-darken-3">comment</i> <b id="init-comments">{{ $comments = $initiative->comments->count() }}</b> {{ str_plural($commentLbl, $comments) }}</span>
                            <span class="initiative-engagement"><i class="material-icons inline-icon grey-text text-darken-3">people</i> <b id="init-supporters">{{ $supporters = $initiative->users->count() }}</b> {{ str_plural($supportLbl, $supporters) }}</span>
                        </div>

                        <div class="divider"></div>

                        <div class="initiative-engagement-buttons">
                            {!! Form::button($supportBtn, array('id' => 'support-btn', 'class' => 'waves-effect waves-teal btn-flat initiative-engagement')) !!}
                        </div>

                        <div class="comments-container"></div>
                    </div>
                    @else
                        <p>{{ $noRecordsMsg }}</p>
                    @endif

                </div>
            </div>
        </div>


        <div class="loader-overlay">
            <div class="loader">
                <div class="loader-inner line-scale-pulse-out-rapid">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    {!! HTML::script('owl/owl.carousel.min.js') !!}
    {!! HTML::script('baguettebox/baguetteBox.min.js') !!}
    {!! HTML::script('jquery-comments/jquery-comments.min.js') !!}
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                margin: 5,
                
                autoWidth:true,
                responsive: {
                    // breakpoint from 0 up
                    0 : {
                        items: 1
                    },
                    // breakpoint from 480 up
                    480 : {
                        items: 2
                    },
                    // breakpoint from 768 up
                    768 : {
                        items: 3
                    },
                    // breakpoint from 1024 up
                    1024 : {
                        items: 4
                    },
                    // breakpoint from 1200 up
                    1200 : {
                        items: 5
                    },
                    // breakpoint from 1400 up
                    1400 : {
                        items: 6
                    }
                }
            });
        });


        baguetteBox.run('.owl-carousel', {

        });


        $('.comments-container').comments({
            //profilePictureURL: "{{ url('/') }}/images/commenting-user.png",
            spinnerIconURL: "{{ url('/') }}/images/loader.gif",
            textareaPlaceholderText: '{{ $commentAddPldr }}',
            sendText: '{{ $commentAddBtn }}',
            replyText: '{{ $commentReplyBtn }}',
            viewAllRepliesText: '{{ $commentViewRepliesBtn }}',
            hideRepliesText: '{{ $commentHideRepliesBtn }}',
            noCommentsText: '{{ $noCommentsMsg }}',
            enableEditing: false,
            enableUpvoting: false,
            enableDeleting: false,
            enableDeletingCommentWithReplies: false,
            enableNavigation: false,
            postCommentOnEnter: true,
            maxRepliesVisible: 10,
            fieldMappings: {
                id: 'id',
                parent: 'parent_id',
                created: 'created_at',
                modified: 'updated_at',
                content: 'body',
                fullname: 'user_fullname'
            },
            getComments: function(success, error) {
                $.ajax({
                    type: "get",
                    url: "{{ url('offer/comments') }}?init_id={{ $initiativeId }}",
                    success: function(commentsArray) {
                        success(commentsArray)
                    },
                    error: error
                });
            },
            postComment: function(commentJSON, success, error) {
                console.log(commentJSON);
                $.ajax({
                    type: "post",
                    url: "{{ url('offer/save/comment') }}?init_id={{ $initiativeId }}",
                    data: commentJSON,
                    success: function(comment) {
                        success(commentJSON)
                        $('#init-comments').html(comment.total_comments);
                        console.log(comment);
                    },
                    error: error
                });
            }
            <?php if(!Auth::check()) { ?>
            ,
            refresh: function() {
                $('div.commenting-field').remove();
            },
            enableReplying: false
            <?php } ?>
        });


        $(document).on("click", "#support-btn", function(e) {
            data = new Object();

            data['initiative_id'] = {{ $initiativeId }};
            

            var url = "{{ url('offer/save/supporter') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('#init-supporters').html(data.totalSupporters);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });


        $(document).on("click", "#delete-btn", function(e) {
            data = new Object();

            data['initiative_id'] = {{ $initiativeId }};
            

            var url = "{{ url('offer/delete/'.$initiative->id) }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    console.log('Done');
                    $('.loader-overlay').fadeIn(0);

                    setTimeout(function() {
                        window.location.href = "{{ url('offers') }}";
                    }, 2500);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });
    </script>
@endsection
