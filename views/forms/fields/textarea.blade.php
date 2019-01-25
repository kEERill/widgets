<div
    <?= Html::attributes($formField->getGroupAttributes()) ?>>

    @include('widgets::forms.label', [
        'formField' => $formField
    ])

    <?= Form::textarea($formField->getNameToHtml(), $formField->getValue(), $formField->getInputAttributes()) ?>
    
    @include('widgets::forms.comment', [
        'formField' => $formField
    ])

    @include('widgets::forms.errors', [
        'formField' => $formField
    ])
</div>