@push ('styles')
    {!! $widget->styles() !!}
@endpush

<div 
    class="<?= $widget->getWrapperClass() ?>">

    @foreach ($widget->getFields() as $formField)
        {!! $formField->render() !!}
    @endforeach
</div>

@push ('scripts')
    {!! $widget->scripts() !!}
@endpush