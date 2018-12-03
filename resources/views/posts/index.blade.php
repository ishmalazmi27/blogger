@extends('layouts/app')

@section('content')
    <h1>Posts By Our Bloggers</h1>
    @if( count($posts) > 0 )
        @foreach ($posts as $post)
            <div class="card" style="margin-bottom:10px;">
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
            
        @endforeach
        {{$posts->links()}}
    @else
        <div class="well">
            <div class="alert alert-danger" role="alert">
                No Posts Found
            </div>
        </div>  
    @endif
@endsection