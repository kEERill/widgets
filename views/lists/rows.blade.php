@forelse ($widget->getRecords() as $record)
    <tr @if ($classes = $widget->extendRowClass($record)) class="{{ $classes }}" @endif>
        @foreach ($widget->getColumns() as $columnName => $column)
            <td class="{{ $column->cssClass }}" @if ($column->width) style="width: {{ $column->width }}" @endif>
                {{ $column->getColumnValue($record) }}
            </td>
        @endforeach
    </tr>
@empty
    <tr>
        <td colspan="{{ $widget->getColumns()->count() + 1 }}">
            По Вашему запросу ничего не найдено
        </td>
    </tr>
@endforelse