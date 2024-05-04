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
            @if(session('user.id') == $article->user_id)
            <div class="card-footer d-flex justify-content-end">
                <a href="{{route('articles.edit', $article->id)}}" class="btn btn-info mr-2">Редактировать</a>
                <form id="destroy" action="{{ route('articles.destroy', $article->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

@endsection
