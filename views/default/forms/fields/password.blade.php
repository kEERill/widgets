<input 
    id="<?= $formField->getId() ?>"
    type="<?= $formField->getType() ?>"
    name="<?= $formField->getNameToHtml() ?>" 
    class="form-control <?= $formField->getInputClass() ?>"
    placeholder="<?= $formField->getPlaceholder() ?>"
    <?= $formField->getDisabled() ? 'disabled' : '' ?>
>