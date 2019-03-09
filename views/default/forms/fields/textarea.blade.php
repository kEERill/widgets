<textarea 
    cols="30" 
    rows="10"
    id="<?= $formField->getId() ?>"
    name="<?= $formField->getNameToHtml() ?>" 
    class="form-control <?= $formField->getInputClass() ?>"
    placeholder="<?= $formField->getPlaceholder() ?>"
    <?= $formField->getDisabled() ? 'disabled' : '' ?>
><?= old($formField->getName(), $formField->getValue()) ?></textarea>