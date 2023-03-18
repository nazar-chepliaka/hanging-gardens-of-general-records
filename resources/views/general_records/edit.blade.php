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
            @forelse ($general_records as $parent)
                <div>
                    <label><input type="checkbox" name="parent_general_records_ids[]" value="{{ $parent->id }}" @if(in_array($parent->id, old('parent_general_records_ids', $general_record->parent_records->pluck('id')->toArray()))) checked="true" @endif > {{ $parent->value }} </label>
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
    <br>
    <div>
        Наразі є батьківським для:

        <table border="1">
            <tr>
                <th>Ідентифікатор</th>
                <th>Вміст</th>
                <th>Опції</th>
            </tr>
            @forelse ($general_record->children_records as $child)
                <tr>
                    <td>#{{$child->id}}</td>
                    <td>{{ $child->value }}</td>
                    <td>
                        <form action="{{ route('general_records.detach_child', ['id' => $general_record->id, 'child_id' => $child->id]) }}" method="POST">
                            {!! csrf_field() !!}
                            {{ method_field('DELETE') }}

                            
                            <input type="submit" name="submit" value="Вилучити">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Жодного запису.</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection