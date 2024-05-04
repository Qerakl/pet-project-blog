@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="my-4">Создание новой статьи</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Форма для создания новой статьи -->
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input type="text" class="form-control" value="{{old('title')}}" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="body">Текст статьи:</label>
                <textarea class="form-control" id="body" name="body" value="{{old('body')}}" rows="6" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Изображение:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Создать статью</button>
        </form>
    </div>
</div>
@endsection
