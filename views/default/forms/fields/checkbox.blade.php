<div class="form-check">
    <input 
        class="form-check-input" 
        type="checkbox" 
        id="<?= $formField->getId() ?>"
        name="<?= $formField->getNameToHtml() ?>"
        value="1"
        <?= old($formField->getName(), $formField->getValue()) ? 'checked' : '' ?>
        <?= $formField->getDisabled() ? 'disabled' : '' ?>>

    <label 
        class="form-check-label <?= $formField->getLabelClass() ?>"
        for="<?= $formField->getId() ?>">
        <?= $formField->getLabel() ?>
    </label>

    <small>
        <?= $formField->getComment() ?>
    </small>
</div>
