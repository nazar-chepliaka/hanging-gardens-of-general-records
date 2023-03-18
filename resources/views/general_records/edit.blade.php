@extends('layout')

@section('head')
    <title>Редагувати запис</title>
@endsection

@section('content')
    <br><a href="{{ route('general_records.index') }}">Перелік</a><br><br>

    @include('alerts')

    <form action="{{ route('general_records.update', $general_record->id) }}" method="POST">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}

        <div>
            <label>
                Запис:<br>
                <textarea name="value">{!! old('value',$general_record->value) !!}</textarea>
            </label>
        </div>
        <br>
        <div>
            Є дочірнім для:
            @forelse ($general_records as $general_record)
                <div>
                    <label><input type="checkbox" name="parent_general_records_ids[]" value="{{ $general_record->id }}" @if(in_array($general_record->id, old('parent_general_records_ids', $general_record->parent_records->pluck('id')->toArray()))) checked="true" @endif > {{ $general_record->value }} </label>
                </div>
            @empty
                <p>
                    Жодного запису.
                </p>
            @endforelse
        </div>
        <br>
        <div>
            Є батьківським для:
            @forelse ($general_record->children_records as $general_record)
                <div>
                    <label>{{ $general_record->value }}</label>
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