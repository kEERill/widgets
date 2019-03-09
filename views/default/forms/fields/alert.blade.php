<div 
    class="alert alert-{{ $formField->getAlertType() }}">

    @if ($formField->getTitle())
        <h3>{{ $formField->getTitle() }}</h3>
    @endif

    <p>
        {{ $formField->getMessage() }}
    </p>
</div>
