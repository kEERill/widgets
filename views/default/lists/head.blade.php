@foreach ($widget->getColumns() as $name => $column)
    <th @if ($column->getWidth()) style="width: {{ $column->getWidth() }}" @endif>{{ $column->getTitle() }}</th>
@endforeach