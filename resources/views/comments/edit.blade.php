@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2 class="my-4">Редактирование статьи</h2>

        <!-- Форма для редактирования статьи -->
        @foreach($comments as $comment)
        <form action="{{route('comments/edit', $comment->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="body">Текст комментармия:</label>
                <textarea class="form-control" id="body" name="body" rows="6" required>{{ $comment->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
        @endforeach
    </div>
</div>
@endsection
