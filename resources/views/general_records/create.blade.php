<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <br><a href="{{ route('general_records.index') }}">Перелік</a><br><br>

    <form action="{{ route('general_records.store') }}" method="POST">
        {!! csrf_field() !!}

        <div>
            <label>
                Запис:<br>
                <textarea name="value">{!! old('value') !!}</textarea>
            </label>
        </div>
        <div>
            <input type="submit" name="submit" value="Зберегти">
        </div>
    </form>


</body>
</html>