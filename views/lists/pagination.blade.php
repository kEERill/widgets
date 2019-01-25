<div>
    {!! $widget->getRecords()->render() !!}
    <span>
        Отображено записей: {{ $widget->getRecords()->firstItem() }} - {{ $widget->getRecords()->lastItem() }} из {{ $widget->getRecords()->total() }}
    </span>
</div>