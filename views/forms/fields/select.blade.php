<div
<?= Html::attributes($formField->getGroupAttributes()) ?>>

    @include('widgets::forms.label', [
        'formField' => $formField
    ])

    @include('widgets::forms.comment', [
        'formField' => $formField
    ])

    <?= Form::select($formField->getNameToHtml() . '[]', $formField->getSelectOptions(), $formField->getValue(), $formField->getInputAttributes()) ?>

    @include('widgets::forms.errors', [
        'formField' => $formField
    ])
</div>