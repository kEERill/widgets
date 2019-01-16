<div
    <?= Html::attributes($formField->getGroupAttributes()) ?>>
    <div 
        class="alert-{{ $formField->alertType }}">

        @if ($formField->label)
            <h3 <?= Html::attributes($formField->getLabelAttributes()) ?>>{{ $formField->label }}</h3>
        @endif

        <p <?= Html::attributes($formField->getCommentAttributes()) ?>>
            {{ $formField->comment }}
        </p>
    </div>
</div>
