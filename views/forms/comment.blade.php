@if ($formField->getComment())
    <small <?= Html::attributes($formField->getCommentAttributes()) ?>>
        {{ $formField->getComment() }}
    </small>
@endif