@foreach ($widget->getColumns() as $name => $column)
    <th>{{ $column->getTitle() }}</th>
@endforeach