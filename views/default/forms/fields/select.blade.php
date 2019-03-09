<select 
    name="<?= $formField->getNameToHtml() ?>" 
    id="<?= $formField->getNameToHtml() ?>" 
    class="form-control <?= $formField->getInputClass() ?>"
    <?= $formField->getDisabled() ? 'disabled' : '' ?>
>
    @foreach ($formField->getSelectOptions() as $key => $value)
        <option value="<?= $key ?>" <?= $key == old($formField->getName(), $formField->getValue()) ? 'selected' : '' ?>><?= $value ?></option>
    @endforeach
</select>