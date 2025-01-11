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
    <div class="category-table">
        <table class="category-table__inner">
        <tr class="category-table__row">
            <th class="category-table__header">日付</th>
            <th class="category-table__header">出勤</th>
            <th class="category-table__header">退勤</th>
            <th class="category-table__header">休憩</th>
            <th class="category-table__header">合計</th>
            <th class="category-table__header">詳細</th>
        </tr>
        @foreach ($attendances as $attendance)
        <tr class="category-table__row">
            <td class="category-table__item tr-first">{{ $attendance->date }}</td>
            <td class="category-table__item">{{ $attendance->clock_in_at }}</td>
            <td class="category-table__item">{{ $attendance->clock_out_at }}</td>
            <td class="category-table__item">{{ $attendance->total_break_time }}</td>
            <td class="category-table__item">{{ $attendance->total_time }}</td>
            <td class="category-table__item tr-last"><a class="" href="{{ route('attendance.detail', ['id'=>$attendance->id]) }}">詳細</a></td>
        </tr>
        @endforeach
        </table>
    </div>
</div>
@endsection