@push ('styles')
    {!! $widget->styles() !!}
@endpush

@include('widgets::forms.formErrors')

<?= Form::open(array_merge($widget->getFormAttributes(), [
    'method' => $widget->getMethod(), 'url' => $widget->getUrl(), 'files' => $widget->getUseFiles()
])) ?>
    <div 
        <?= Html::attributes($widget->getWrapperAttributes()) ?>>

        @foreach ($widget->getFields() as $formField)
            {!! $formField->render() !!}
        @endforeach
        
    </div>
<?= Form::close() ?>

@push ('scripts')
    {!! $widget->scripts() !!}
@endpush