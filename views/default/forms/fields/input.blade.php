<input 
    id="<?= $formField->getId() ?>"
    type="<?= $formField->getType() ?>"
    name="<?= $formField->getNameToHtml() ?>" 
    class="form-control <?= $formField->getInputClass() ?>"
    value="<?= $formField->getValue() ?: old($formField->getName()) ?>"
    placeholder="<?= $formField->getPlaceholder() ?>"
    <?= $formField->getDisabled() ? 'disabled' : '' ?>
>