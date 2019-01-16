<div
    <?= Html::attributes($formField->getGroupAttributes()) ?>>

    <?= Form::checkbox($formField->getNameToHtml(), 1, $formField->getValue(), $formField->getInputAttributes()) ?>
    <?= Form::label($formField->getNameToHtml(), $formField->getLabel(), $formField->getLabelAttributes()) ?>

    @include('widgets::forms.errors', [
        'formField' => $formField
    ])
</div>

