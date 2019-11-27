@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $post->title }}</h1>
                <ul class="list-unstyled list-inline">
                    @foreach($post->categories as $category)
                        <li class="list-inline-item">
                            <a href="/category/{{ $category->slug }}">
                                <span class="badge badge-primary">{{ $category->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <p>{{ $post->content }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>{{ __('Author') }}: {{ $post->author->name }}</div>
                    <div>{{ __('Created') }}: {{ $post->created_at->diffForHumans() }}({{ $post->created_at->format('H:i:s d M Y') }})</div>
                </div>
            </div>
            <hr />
            <div class="col-12">
                <h2 class="mt-5">{{__('Comments')}}</h2>
                @foreach($post->parent_comments as $comment)
                    <div class="card card-body mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <sapn> {{ $comment->id }} {{ $comment->text }} {{ $comment->parent }} </sapn>
                            <sapn>
                                <ul class="list-inline m-0">
                                    @if($comment->commentWasLiked)
                                        <li class="list-inline-item">{{ $comment->likes->count() }} <a href="/comments/{{ $comment->id }}/unlike" class="text-danger"><i class="fas fa-heart"></i></a></li>
                                    @else
                                        <li class="list-inline-item">{{ $comment->likes->count() }} <a href="/comments/{{ $comment->id }}/like" class="text-danger"><i class="far fa-heart"></i></a></li>
                                    @endif

                                    <li class="list-inline-item"><a href="/comments/{{ $post->id }}/parent/{{ $comment->id }}">{{__('Comment')}}</a></li>

                                </ul>
                            </sapn>
                        </div>
                    </div>
                    @if($comment->children->count())
                        @foreach($comment->children as $child)
                            <div class="card card-body mb-3 ml-5">
                              <div class="d-flex justify-content-between align-items-center">
                                  <span>{{ $child->text }} {{ $child->parent }}</span>
                                  <sapn>
                                      <ul class="list-inline m-0">
                                          @if($child->commentWasLiked)
                                              <li class="list-inline-item">{{ $child->likes->count() }} <a href="/comments/{{ $child->id }}/unlike" class="text-danger"><i class="fas fa-heart"></i></a></li>
                                          @else
                                              <li class="list-inline-item">{{ $child->likes->count() }} <a href="/comments/{{ $child->id }}/like" class="text-danger"><i class="far fa-heart"></i></a></li>
                                          @endif


                                      </ul>
                                  </sapn>
                              </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
                @auth
                    <div class="card card-body shadow-lg">
                        <form method="post" action="/comments/{{$post->id}}">
                            @csrf
                            <div class="form-group">
                                <textarea name="comment" id="comment" class="form-control" placeholder="{{__('Enter your comment here...')}}"></textarea>
                                @if($errors->has('comment'))
                                    <span class="table-danger">{{ $errors->first('comment') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">{{__('Save comment')}}</button>
                            </div>
                        </form>
                    </div>
                @endauth
            </div>

        </div>
    </div>
@endsection
