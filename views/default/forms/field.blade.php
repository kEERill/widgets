<div
    class="form-group <?= $formField->getState() == 'horizontal' ? 'row' : '' ?> <?= $formField->getGroupClass() ?>">

    @if ($formField->getLabel())
        <label 
            for="<?= $formField->getId() ?>"
            class="<?= $formField->getState() == 'horizontal' ? 'col-sm-4 col-form-label text-md-right' : 'form-label' ?> <?= $formField->getLabelClass() ?>"><?= $formField->getLabel() ?>
        </label>
    @endif

    <div class="<?= $formField->getState() == 'horizontal' ? 'col-sm-8' : '' ?>">
        @include($formField->getTemplate(), ['formField' => $formField])

        @if ($formField->getComment())
            <small class="help-block <?= $formField->getCommentClass() ?>">{{ $formField->getComment() }}</small>
        @endif
        
        @if ($errors->has($formField->getName()))
            <small class="text-danger">{{ $errors->first($formField->getName()) }}</small>
        @endif
    </div>
</div>