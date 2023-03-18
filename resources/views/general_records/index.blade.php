@extends('layout')

@section('head')
    <title>Перелік</title>

    <style>
        form {
            margin-right: 10px;
            display: inline;
        }
    </style>
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
                <td>
                    <form action="{{ route('general_records.destroy', $general_record->id) }}" method="POST">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}

                        <input type="submit" name="submit" value="❌">
                    </form>

                    <a href="{{ route('general_records.edit', $general_record->id) }}"><button>✍️</button></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Немає жодного запису</td>
            </tr>
        @endforelse
    </table>
@endsection