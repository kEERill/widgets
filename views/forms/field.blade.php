<div
    class="{{ $formField->groupClass }}">

    @include('widgets::forms.label', [
        'formField' => $formField
    ])

    @include('widgets::forms.comment', [
        'formField' => $formField
    ])

    @yield('formField')

    @include('widgets::forms.errors', [
        'formField' => $formField
    ])
</div>