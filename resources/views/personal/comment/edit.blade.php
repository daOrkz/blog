@extends('personal.layouts.main')

@section('content')
    <div class="statistic-wrap">
        <h3 class="title-content">Редактирование комментария</h3>

        <div class="form-edit">

            <form action="{{ route('personal.comment.update', $comment->id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="form-edit-wrap">
                    <div class="form-textarea">
                        <textarea class="textarea-text" name="text" id="" cols="80" rows="10">{{ $comment->text }}</textarea>
                    </div>

                    @error('text')
                    <div class="alert">{{ $message }}</div>
                    @enderror

                    <div class="form-btn">
                        <button class="btn btn-submit" type="submit">Редактировать</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
