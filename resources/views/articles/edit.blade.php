@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="my-4">Редактирование статьи</h2>

        <!-- Форма для редактирования статьи -->
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
            </div>
            <div class="form-group">
                <label for="body">Текст статьи:</label>
                <textarea class="form-control" id="body" name="body" rows="6" required>{{ $article->body }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Изображение:</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if($article->image)
                    <img src="{{ $article->image_url }}" class="img-thumbnail mt-2" alt="{{ $article->title }}">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
</div>
@endsection
