@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        @foreach($articles as $article)
        <div class="card">
            <img class="card-img-top" src="../public/storage/{{ $article->image }}" alt="{{ $article->title }}">
            <div class="card-body">
                <h2 class="card-title">{{ $article->title }}</h2>
                <p class="card-text">{{ $article->body }}</p>
            </div>
        </div>
        @endforeach
        <hr>

        <h3>Комментарии</h3>
        @foreach($comments as $comment)
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->user_name }}</h5>
                <p class="card-text">{{ $comment->body }}</p>
                <small class="text-muted">{{ $comment->created_at }}</small>
            </div>
        </div>
        @endforeach
        
        <!-- Форма для добавления нового комментария -->
        <form action="{{ route('comments/store', $article->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="body">Добавить комментарий:</label>
                <textarea class="form-control" id="body" name="body" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>
@endsection
