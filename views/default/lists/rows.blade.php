@forelse ($widget->getRecords() as $record)
    <tr @if ($classes = $widget->extendRowClass($record)) class="{{ $classes }}" @endif>
        @foreach ($widget->getColumns() as $columnName => $column)
            <td class="{{ $column->getCssClass() }}" @if ($column->getWidth()) style="width: {{ $column->getWidth() }}" @endif>
                {!! $column->getFormatColumnValue($record) !!}
            </td>
        @endforeach
    </tr>
@empty
    <tr>
        <td colspan="{{ $widget->getColumns()->count() }}">
            По Вашему запросу ничего не найдено
        </td>
    </tr>
@endforelse
