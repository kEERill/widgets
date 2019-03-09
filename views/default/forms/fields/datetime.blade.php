<input 
    type="datetime-local"
    id="<?= $formField->getId() ?>"
    name="<?= $formField->getNameToHtml() ?>" 
    class="form-control <?= $formField->getInputClass() ?>"
    value="<?= $formField->getValue() ?: old($formField->getName()) ?>"
    <?= $formField->getDisabled() ? 'disabled' : '' ?>
>