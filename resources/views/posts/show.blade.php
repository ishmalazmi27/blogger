@extends('layouts/app')

@section('content')
    <a href="/posts" class="btn btn-primary"><< Back</a>
    <div class="card" style="margin-bottom:10px; margin-top:20px;">
            <div class="card-header">
                <strong>{{$post->title}}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                    <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%;">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <blockquote class="blockquote mb-0">
                            <p>{!!$post->body!!}</p>
                            <footer class="blockquote-footer">Written at <cite title="Created At">{{$post->created_at}} by {{$post->user->name}}</cite></footer>
                        </blockquote>
                        <hr>
                        <a href="/posts/{{$post->id}}" class="btn btn-primary">See Post</a>
                    </div>
                </div>
                
            </div>
        </div>
    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-info">Edit Post</a>

        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
        {{Form::hidden('_method', 'DELETE')}}    
        {{Form::submit('Delete Post', ['class' => 'btn btn-outline-danger'])}}
        {!! Form::close()!!}
        @endif
    @endif
@endsection