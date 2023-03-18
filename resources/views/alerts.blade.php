@if(session('success'))
    <div class="alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('alert'))
    <div>
        {{session('alert')}}
    </div>
@endif

@if(session('error'))
    <div>
        {{session('error')}}
    </div>
@endif

@if ($errors->any())
    <div class="alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
