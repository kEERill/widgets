<input 
    type="datetime-local"
    id="<?= $formField->getId() ?>"
    name="<?= $formField->getNameToHtml() ?>" 
    class="form-control <?= $formField->getInputClass() ?>"
    value="<?= old($formField->getName(), $formField->getValue()) ?>"
    <?= $formField->getDisabled() ? 'disabled' : '' ?>
>