<input 
    id="<?= $formField->getId() ?>"
    type="datetime-local"
    name="<?= $formField->getNameToHtml() ?>" 
    class="form-control <?= $formField->getInputClass() ?>"
    value="<?= $formField->getValue() ?: old($formField->getName()) ?>"
    <?= $formField->getDisabled() ? 'disabled' : '' ?>
>