@push ('styles')
    {!! $widget->styles() !!}
@endpush

<table class="table">
    <thead>
        @include('widgets::lists.head', ['widget' => $widget])
    </thead>
    <tbody>
        @include('widgets::lists.rows', ['widget' => $widget])
    </tbody>
</table>

<div>
    {!! $widget->getRecords()->render() !!}
    <span>
        Отображено записей: {{ $widget->getRecords()->firstItem() }} - {{ $widget->getRecords()->lastItem() }} из {{ $widget->getRecords()->total() }}
    </span>
</div>

@push ('scripts')
    {!! $widget->scripts() !!}
@endpush