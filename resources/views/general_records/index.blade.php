@extends('layout')

@section('head')
    <title>Перелік</title>
@endsection

@section('content')
    <br><a href="{{ route('general_records.create') }}">Створити новий запис</a><br><br>

    <table border="1">
        <tr>
            <th>Ідентифікатор</th>
            <th>Вміст</th>
            <th>Опції</th>
        </tr>
        @forelse ($general_records as $general_record)
            <tr>
                <td>#{{$general_record->id}}</td>
                <td>{{$general_record->value}}</td>
                <td><a href="{{ route('general_records.edit', $general_record->id) }}">✍️</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Немає жодного запису</td>
            </tr>
        @endforelse
    </table>
@endsection