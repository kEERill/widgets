@push ('styles')
    {!! $widget->styles() !!}
@endpush

<table class="table <?= $widget->getTableClass() ?>">
    <thead>
        @include('widgets::default.lists.head', ['widget' => $widget])
    </thead>
    <tbody>
        @include('widgets::default.lists.rows', ['widget' => $widget])
    </tbody>
</table>

@include('widgets::default.lists.pagination', ['widget' => $widget])

@push ('scripts')
    {!! $widget->scripts() !!}
@endpush