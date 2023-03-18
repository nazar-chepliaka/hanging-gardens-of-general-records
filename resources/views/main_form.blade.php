<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <a href="{{ route('general_records.create') }}">Створити</a>

    @foreach($general_records as $general_record)
        {{$general_record->value}}
    @endforeach


</body>
</html>