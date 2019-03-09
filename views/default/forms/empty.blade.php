<div 
    class="form-group <?= $formField->getState() == 'horizontal' ? 'row' : '' ?> <?= $formField->getGroupClass() ?>">
    <div class="<?= $formField->getState() == 'horizontal' ? 'col-sm-8 offset-sm-4' : '' ?>">
        @include($formField->getTemplate(), ['formField' => $formField])
    </div>
</div>