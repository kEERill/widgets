@foreach ($widget->getColumns() as $name => $column)
    <th>{{ $column->getTitle() }}</th>
@endforeach
<th><a href="#modal-example" uk-toggle><span uk-icon="grid"></span></a></th>