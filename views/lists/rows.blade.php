@forelse ($widget->getRecords() as $record)
    <tr @if ($classes = $widget->extendRowClass($record)) class="{{ $classes }}" @endif>
        @foreach ($widget->getColumns() as $columnName => $column)
            <td class="{{ $column->cssClass }}" @if ($column->width) style="width: {{ $column->width }}" @endif>
                {{ $column->getColumnValue($record) }}
            </td>
        @endforeach

        <td>
            @if ($widget->hasRedirectUrl())
                <a href="{{ $widget->getRedirectUrl($record) }}">
                    {{ $widget->getRedirectMessage($record) }}
                </a>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="{{ $widget->getColumns()->count() + 1 }}" class="uk-text-muted uk-text-center">
            По Вашему запросу ничего не найдено
        </td>
    </tr>
@endforelse