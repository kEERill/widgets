@push ('styles')
    {!! $widget->styles() !!}
@endpush

<table <?= Html::attributes($widget->getTableAttributes()) ?>>
    <thead>
        @include('widgets::lists.head', ['widget' => $widget])
    </thead>
    <tbody>
        @include('widgets::lists.rows', ['widget' => $widget])
    </tbody>
</table>

@include('widgets::lists.pagination', ['widget' => $widget])

@push ('scripts')
    {!! $widget->scripts() !!}
@endpush