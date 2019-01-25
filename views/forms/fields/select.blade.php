<div
<?= Html::attributes($formField->getGroupAttributes()) ?>>

    @include('widgets::forms.label', [
        'formField' => $formField
    ])

    <?= Form::select($formField->getNameToHtml(), $formField->getSelectOptions(), $formField->getValue(), $formField->getInputAttributes()) ?>

    @include('widgets::forms.comment', [
        'formField' => $formField
    ])
    
    @include('widgets::forms.errors', [
        'formField' => $formField
    ])
</div>