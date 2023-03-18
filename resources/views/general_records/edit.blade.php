<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <br><a href="{{ route('general_records.index') }}">Перелік</a><br><br>

    <form action="{{ route('general_records.update', $general_record->id) }}" method="POST">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}

        <div>
            <label>
                Запис:<br>
                <textarea name="value">{!! old('value',$general_record->value) !!}</textarea>
            </label>
        </div>
        <div>
            <input type="submit" name="submit" value="Зберегти">
        </div>
    </form>

</body>
</html>