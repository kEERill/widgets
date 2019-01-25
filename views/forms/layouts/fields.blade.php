@push ('styles')
    {!! $widget->styles() !!}
@endpush

@include('widgets::forms.formErrors')

<div 
    <?= Html::attributes($widget->getWrapperAttributes()) ?>>

    @foreach ($widget->getFields() as $formField)
        {!! $formField->render() !!}
    @endforeach
</div>

@push ('scripts')
    {!! $widget->scripts() !!}
@endpush