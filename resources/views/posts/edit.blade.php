@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{__('Edit post')}}</h1>
                <form method="post" action="/posts/{{$post->id}}">

                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">{{__('Title')}}</label>
                        <input type="text" name="title" class="form-control" value="{{$post->title}}" id="title" />
                        @if($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="textcontent">{{__('Content')}}</label>
                        <textarea name="textcontent" class="form-control"  id="textcontent">{{$post->content}}</textarea>
                        @if($errors->has('textcontent'))
                            <span class="text-danger">{{ $errors->first('textcontent') }}</span>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-outline-success btn-lg">{{__('Update post')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
