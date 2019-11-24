@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>{{__('Create comment')}}</h1>
            <small>{{__('Parent')}}: {{ $comment->text }}</small>
            <hr />
            <form method="post" action="/comments/{{ $post->id }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                <div class="form-group">
                    <lable for="comment">{{__('Comment')}}</lable>
                    <textarea name="comment" id="comment" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary">{{__('Save comment')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
