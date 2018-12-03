@extends('layouts/app')

@section('content')

    <h1 style="margin-top:15px;">Edit Your Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Post Title')}}
            {{Form::text('title',$post->title, ['class' => 'form-control', 'placeholder' => 'Your Post Title goes here...'])}}
            <hr>
            {{Form::label('body', 'Post Content')}}
            {{Form::textarea('body',$post->body, ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Your Post Content goes here...'])}}
            <hr>
            <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Upload Post', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection