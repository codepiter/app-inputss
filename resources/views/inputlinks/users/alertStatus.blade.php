@if ($errors->any())
    <div class="mx-3 mt-3 alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="mx-3 mt-3 alert alert-success">
        {{ session('status') }}
    </div>
@endif