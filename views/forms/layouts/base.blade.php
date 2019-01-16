@extends('widgets::forms.layouts.default')

@section('formContent')
    <?= Form::open([
        'method' => $widget->getMethod(), 'url' => $widget->getUrl()
    ]) ?>
        <div 
            class="{{ $widget->wrapperClass }}">

            @foreach ($widget->getFields() as $formField)
                {!! $formField->render() !!}
            @endforeach
            
        </div>

        @yield('formToolbar')

    <?= Form::close() ?>
@endsection