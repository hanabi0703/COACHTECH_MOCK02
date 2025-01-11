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
        <?php
        if($attendance == null) {
            echo '<p>勤務外</p>';
        }
        else if($attendance['status'] == 'AttendanceAtWork') {
            echo '<p>出勤中</p>';

        }
        else if ($attendance['status'] == 'DuringBreak') {
            echo '<p>休憩中</p>';
        }
        else if ($attendance['status'] == 'LeavingWork') {
            echo '<p>退勤済</p>';
        }
        ?>
        <?php
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $dt = now();
        echo $dt->isoFormat('YYYY年MM月DD(ddd)');
        ?>
        <?php
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $dt = now();
        echo $dt->isoFormat('HH:mm');
        ?>
        <?php
        if($attendance == null) {
            echo '<form class="attendance__register-form" action="/attendance/clock_in" method="post">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <button class="form__button-submit" type="submit">出勤</button>
            </form>';
        }
        else if($attendance['status'] == 'AttendanceAtWork') {
            echo '<form class="attendance__register-form" action="/attendance/clock_out" method="post">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="id" value="' . $attendance['id'] . '"/>
                <button class="form__button-submit" type="submit">退勤</button>
            </form>
            <form class="attendance__register-form" action="/attendance/break_time_start" method="post">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="id" value="' . $attendance['id'] . '"/>
                <button class="form__button-submit" type="submit">休憩入</button>
            </form>';
        }
        else if ($attendance['status'] == 'DuringBreak') {
            echo '<form class="attendance__register-form" action="/attendance/break_time_end" method="post">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="id" value="' . $attendance['id'] . '"/>
                <button class="form__button-submit" type="submit">休憩戻</button>
            </form>';
        }
        ?>
</div>
@endsection