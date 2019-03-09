@push ('styles')
    {!! $widget->styles() !!}
@endpush

@include('widgets::default.forms.errors')

<?= Form::open(array_merge($widget->getFormAttributes(), [
    'method' => $widget->getMethod(), 'url' => $widget->getUrl(), 'files' => $widget->getUseFiles()
])) ?>
    <div 
        class="<?= $widget->getWrapperClass() ?>">

        @foreach ($widget->getFields() as $formField)
            <?= $formField->render() ?>
        @endforeach
        
    </div>
<?= Form::close() ?>

@push ('scripts')
    {!! $widget->scripts() !!}
@endpush