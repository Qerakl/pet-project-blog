@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="my-4">Список статей</h2>
        @foreach($articles as $article)
        <div class="card mb-4">
            <img class="card-img-top" src="public/storage/{{ $article->image }}" alt="{{ $article->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <p class="card-text">{{ $article->excerpt }}</p>
                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Читать далее</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
