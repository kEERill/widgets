<div 
    class="form-group row <?= $formField->getGroupClass() ?>">
    <div class="col-sm-8 offset-sm-4">
        @include($formField->getTemplate(), ['formField' => $formField])
    </div>
</div>