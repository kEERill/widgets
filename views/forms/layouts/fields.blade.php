@extends('widgets::forms.layouts.default')

@section('formContent')
    <div 
        class="{{ $widget->wrapperClass }}">

        @foreach ($widgets->getFields() as $formField)
            {!! $formField->render() !!}
        @endforeach
    </div>
@endsection