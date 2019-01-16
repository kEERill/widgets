@if (count($errors->all()) > 0)
    <div>
        При выполнении запроса произошла ошибка
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif