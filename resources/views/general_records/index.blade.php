<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <a href="{{ route('general_records.create') }}">Створити</a>

    <ul>
        @forelse ($general_records as $general_record)
            <li>{{$general_record->value}}</li>
        @empty
            <li>Немає жодного запису</li>
        @endforelse
    </ul>

</body>
</html>