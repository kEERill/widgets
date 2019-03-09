<button
    type="submit" 
    id="<?= $formField->getId() ?>"
    name="<?= $formField->getNameToHtml() ?>"
    class="btn <?= $formField->getButtonClass() ?: 'btn-default' ?>"
    <?= $formField->getDisabled() ?>
>
    <?= $formField->getText() ?>
</button>
