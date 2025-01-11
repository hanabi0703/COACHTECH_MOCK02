@extends('general.layouts.default')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('js')
    <script src="{{ asset('/js/tab_change.js') }}"></script>
@endsection

@section('button')
@endsection

@section('content')
<div class="index__content">
    <div class="index__heading">
    </div>
    <form class="form"  action="/" method="post">
        @csrf
        <div class="attendance-detail">
            <div class="edit-form__content">
                <span>名前</span>
                <p>{{ $user['name'] }}</p>
            </div>
            <div class="edit-form__content">
                <span>日付</span>
                <input type="text" name="name" value="{{ $attendance['date']->format('Y年') }}"/>
                <input type="text" name="name" value="{{ $attendance['date']->format('m月d日') }}"/>
                <div class="form__error">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="edit-form__content">
                <span>出勤・退勤</span>
                <input type="text" name="name" value="{{ $attendance['clock_in_at'] }}"/>
                <input type="text" name="name" value="{{ $attendance['clock_out_at'] }}"/>
                <div class="form__error">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            @foreach ($breakTimes as $breakTime)
                <div class="edit-form__content">
                    <span>休憩{{ $loop->index + 1 }}</span>
                    <input type="text" name="name" value="{{ $breakTime['start_at'] }}"/>
                    <input type="text" name="name" value="{{ $breakTime['end_at'] }}"/>
                    <div class="form__error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            @endforeach
                    <div class="edit-form__content">
                <span>備考</span>
                <textarea name="remarks" class="textarea-content">{{ $attendance['remarks'] }}</textarea>
                    @error('remarks')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">修正</button>
        </div>
    </form>
</div>
@endsection