@extends('layouts.main')


@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{$post->title}}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">
                • {{$date->translatedFormat('F')}} {{$date->day}}, {{$date->year}} • {{$date->format('H:i')}} •
                Комментариев: {{$post->comments->count()}} </p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{asset('storage/' . $post->main_image)}}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        {!! $post->content !!}
                    </div>
                </div>

                <section class="py-3">
                            @auth()
                    <form action="{{route('post.like.store', $post->id)}}" method="post">
                        @csrf
                        <span>{{$post->liked_users_count}}</span>
                        <button type="submit" class="border-0 bg-transparent">
                                <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r' }} fa-heart"></i>
                        </button>
                    </form>
                            @endauth
                    @guest()
                                    <div>
                                        <span>{{$post->liked_users_count}}</span>
                                        <i class="far fa-heart"></i>
                                    </div>
                    @endguest
                </section>

            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    @if($relatedPosts->count() > 0)
                    <section class="related-posts">
                        <h2 class="section-title mb-4" data-aos="fade-up">Еще по теме</h2>
                        <div class="row">
                            @foreach($relatedPosts as $relatedpost)
                                <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                    <img src="{{asset('storage/' . $relatedpost->main_image)}}" alt="related post"
                                         class="post-thumbnail">
                                    <p class="post-category">{{$relatedpost->category->title}}</p>
                                    <a href="{{route('post.show', $relatedpost->id )}}">
                                        <h5 class="post-title">{{$relatedpost->title}}</h5>
                                    </a>

                                </div>
                            @endforeach
                        </div>
                    </section>
                    @endif



                    <section class="comment-list mb-5">
                        <h2 class="section-title mb-5" data-aos="fade-up">Комментарии ({{$post->comments->count()}})</h2>
                        @foreach($post->comments as $comment)
                        <div class="comment-text mb-3">
                    <div class="username">
                        {{$comment->user->name}}
                      <span class="text-muted float-right">{{$comment->dataAsCarbon->diffForHumans()}}</span>
                    </div><!-- /.username -->
                            {{$comment->message}}
                        </div>
                        @endforeach
                    </section>

                    @auth()
                    <section class="comment-section">
                        <h2 class="section-title mb-5" data-aos="fade-up">Оставить комментарий</h2>
                        <form action="{{route('post.comment.store', $post->id )}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12" data-aos="fade-up">
                                    <label for="comment" class="sr-only">Comment</label>
                                    <textarea name="message" id="comment" class="form-control" placeholder="Комментарий"
                                              rows="10"></textarea>
                                </div>
                            </div>
                            {{--                            <div class="row">--}}
                            {{--                                <div class="form-group col-md-4" data-aos="fade-right">--}}
                            {{--                                    <label for="name" class="sr-only">Name</label>--}}
                            {{--                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name*">--}}
                            {{--                                </div>--}}
                            {{--                                <div class="form-group col-md-4" data-aos="fade-up">--}}
                            {{--                                    <label for="email" class="sr-only">Email</label>--}}
                            {{--                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="row">
                                <div class="col-12" data-aos="fade-up">
                                    <input type="submit" value="Отправить" class="btn btn-warning">
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
