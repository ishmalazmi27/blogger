@extends('layouts/app')

@section('content')
    
    <h1 style="margin-top:15px;">Create Your Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Post Title')}}
            {{Form::text('title','', ['class' => 'form-control', 'placeholder' => 'Your Post Title goes here...'])}}
            <hr>
            {{Form::label('body', 'Post Content')}}
            {{Form::textarea('body','', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Your Post Content goes here...'])}}
            <hr>
            <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
            {{Form::submit('Upload Post', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection