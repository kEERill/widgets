<input 
    id="<?= $formField->getId() ?>"
    type="<?= $formField->getType() ?>"
    name="<?= $formField->getNameToHtml() ?>" 
    placeholder="<?= $formField->getPlaceholder() ?>"
    class="form-control <?= $formField->getInputClass() ?>"
    value="<?= old($formField->getName(), $formField->getValue()) ?>"
    <?= $formField->getDisabled() ? 'disabled' : '' ?>
>