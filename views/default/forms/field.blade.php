<div
    class="form-group <?= $formField->getGroupClass() ?>">

    @if ($formField->getLabel())
        <label 
            for="<?= $formField->getId() ?>"
            class="form-label <?= $formField->getLabelClass() ?>"><?= $formField->getLabel() ?>
        </label>
    @endif

    @include($formField->getTemplate(), ['formField' => $formField])

    @if ($formField->getComment())
        <small class="help-block <?= $formField->getCommentClass() ?>">{{ $formField->getComment() }}</small>
    @endif
    
    @if ($errors->has($formField->getName()))
        <small class="text-danger">{{ $errors->first($formField->getName()) }}</small>
    @endif
</div>