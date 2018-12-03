@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" >
            <div class="card" >
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4 class="float-left">Total Posts : {{count($posts)}}</h4>
                    <a href="/posts/create" class="float-right btn btn-outline-info">Create a Post Now</a>
                    
                </div>
                <hr style="width:80%; margin-left:10%;">
                <center><h3>Your Posts</h3></center>
                <hr style="width:80%; margin-left:10%;">
                @if ( count($posts) == 0 )
                    <div>
                        <center>
                            <div class="alert alert-danger">
                                You have not uploaded any post yet
                            </div>
                        </center>
                    </div>
                @endif
                @foreach ($posts as $post)
                    <div class="col-md-12">
                        <div class="card" style="margin-bottom:10px;">
                            <div class="card-header">{{$post->title}}</div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%;">
                                        </div>
                                        <div class="col-md-8 col-sm-8">
                                            <blockquote class="blockquote mb-0">
                                                <p>{!!$post->body!!}</p>
                                            </blockquote>
                                            <hr>
                                            <a href="/posts/{{$post->id}}" class="btn btn-primary" style="margin-left:10px;">See Post</a>
                                            <div class="float-left ">
                                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-info" style="margin-right:10px;">Edit Post</a>
                
                                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}    
                                                    {{Form::submit('Delete Post', ['class' => 'btn btn-outline-danger'])}}
                                                    {!! Form::close()!!}
                                                </div>
                                                <div class="float-right">
                                                    Posted On <strong>{{$post->created_at}}</strong>
                                                </div>
                                        </div>
                                    </div>
                                            
                                </div>
                        </div>
                    </div>
                    <hr style="width:80%; margin-left:10%;">
                @endforeach
            </div>
        </div>
        
        
    </div>
</div>
@endsection
