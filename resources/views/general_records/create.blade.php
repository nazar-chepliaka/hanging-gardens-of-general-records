@extends('layout')

@section('head')
    <title>Створити новий запис</title>
@endsection

@section('content')
    <br><a href="{{ route('general_records.index') }}">Перелік</a><br><br>

    @include('alerts')

    <form action="{{ route('general_records.store') }}" method="POST">
        {!! csrf_field() !!}

        <div>
            <label>
                Запис:<br>
                <textarea name="value">{!! old('value') !!}</textarea>
            </label>
        </div>
        <br>
        <div>
            Є дочірнім для:
            @forelse ($general_records as $general_record)
                <div>
                    <label><input type="checkbox" name="parent_general_records_ids[]" value="{{ $general_record->id }}" @if(in_array($general_record->id, old('parent_general_records_ids', []))) checked="true" @endif > {{ $general_record->value }} </label>
                </div>
            @empty
                <p>
                    Жодного запису.
                </p>
            @endforelse
        </div>
        <br>
        <div>
            <input type="submit" name="submit" value="Зберегти">
        </div>
    </form>
@endsection