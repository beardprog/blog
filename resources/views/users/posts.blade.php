@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>{{ __('Posts') }}</h1>
                    <a href="/posts/create" class="btn btn-outline-success">{{ __('Create post') }}</a>
                </div>



            @if(count($posts))
                @foreach($posts as $post)

                            <div class="card card-body mb-3 shadow-lg">
                                <a href="/posts/{{$post->id}}">
                                <h3>{{$post->title}}</h3>
                                </a>
                                <p>{{$post->preview}}</p>

                                <p><strong>{{__('Created ')}}</strong>: {{$post->created_at->diffForHumans()}}</p>
                                <p><a href="/posts/{{$post->id}}/edit" class="btn btn-sm btn-outline-primary">{{__('Edit post')}}</a></p>
                                <p>
                                <form method="post" action="/posts/{{$post->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm d-inline">{{__('Delete post')}}</button>
                                </form>
                                </p>
                            </div>


                    @endforeach
                    <div class="pagination">
                        {{$posts->links()}}
                    </div>
            @else
                <div class="alert alert-danger mt-5 mb-5">
                    {{__('Nothing here for now. Sorry...')}}
                </div>
            @endif
            </div>
        </div>
    </div>
    @endsection
