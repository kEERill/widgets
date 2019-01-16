<div>

    @include('widgets::forms.label', [
        'formField' => $formField
    ])

    @include('widgets::forms.comment', [
        'formField' => $formField
    ])
</div>

@foreach ($formField->options as $id => $options)
    <div
        <?= Html::attributes($formField->getGroupAttributes()) ?>>

        {!! Form::radio($formField->getNameToHtml(), $id, $id == $formField->getValue(), $formField->getInputAttributes()) !!}

        @if (is_array($options))
            <?= Form::label($formField->getNameToHtml(), $options[0], $formField->getLabelAttributes()) ?>
            <p>{{ $options[1] }}</p>
        @else
            <?= Form::label($formField->getNameToHtml(), $options, $formField->getLabelAttributes()) ?>
        @endif
    </div>
@endforeach

@include('widgets::forms.errors', [
    'formField' => $formField
])