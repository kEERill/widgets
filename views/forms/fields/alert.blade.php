<div
    <?= Html::attributes($formField->getGroupAttributes()) ?>>
    <div 
        class="alert-{{ $formField->getAlertType() }}">

        @if ($formField->label)
            <h3>{{ $formField->getTitle() }}</h3>
        @endif

        <p>
            {{ $formField->getMessage() }}
        </p>
    </div>
</div>
