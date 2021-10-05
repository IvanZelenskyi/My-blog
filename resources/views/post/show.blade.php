@extends('layouts.main')
@section('content')

    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" >{{$post->title}}</h1>
            <p class="edica-blog-post-meta" >{{$date->translatedFormat('F')}} {{$date->day}},{{$date->year}} • {{$date->format('H:i')}}• Featured • {{$post->comments->count()}} Комментария</p>
            <section class="blog-post-featured-img" >
                <img src="{{asset('storage/'.$post->main_image)}}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
{!! $post->content !!}
                        </div>
            </section>
            <section class="py-3">
                        @auth()
                <form action="{{route('post.like.store',$post->id)}}" method="post">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent">
                            @if(auth()->user()->likedPosts->contains($post->id))
                                <i class="far fa-heart">
                                    @else
                                        <i class="fas fa-heart"></i>
                                    @endif

                                </i></button>
                </form>
                                    @endauth
                            @guest()
                                <div>
                                    <span>{{$post->liked_users_count}}</span>
                                    <i class="far fa-heart"></i>
                                </div>
                            @endguest
            </section>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="related-posts">
                        <h2 class="section-title mb-4" ></h2>
                        <div class="row">

                        @foreach($relatedPosts as $relatedPost)
                            <div class="col-md-4" >
                                <img src="{{asset('storage/'.$relatedPost->main_image)}}" alt="related post" class="post-thumbnail">
                                <p class="post-category">{{$relatedPost->category->title}}</p>
                              <a href="{{route('post.show',$relatedPost->id)}}" ><h5 class="post-title">{{$relatedPost->title}}</h5> </a>
                        </div>
                @endforeach
                        </div>

                <section class="comment-list mb-5">
                    @foreach($post->comments as $comment)
                    <div class="comment-text mb-3 ">
                    <span class="username">
                        <div class="mb-1 rounded">
                             {{$comment->user->name}} :
                        </div>

                      <span class="text-muted float-right">{{$comment->dateAsCarbon->diffForHumans()}}</span>
                    </span><!-- /.username -->
                        {{$comment->message}}
                    </div>
                    @endforeach
                </section>
                    @auth()
                    <section class="comment-section">

                        <h2 class="section-title mb-5" >Kомментарий</h2>
                        <form action="{{route('post.comment.store',$post->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12" >
                                    <label for="comment" class="sr-only">Comment</label>
                                    <textarea name="message" id="comment" class="form-control" placeholder="Комментировать" rows="10"></textarea>
                            </div>
<input type="hidden" name="post_id" value="{{$post->id}}">

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" class="btn btn-primary" value="Отправить комментарий">
                                </div>
                            </div>
                        </form>
                    </section>
                        @endauth
                </div>
            </div>
        </div>
    </main>
@endsection


