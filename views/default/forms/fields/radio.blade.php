@foreach ($formField->getRadioOptions() as $id => $option)
    <div class="form-check">
        <input 
            type="radio" 
            value="<?= $id ?>" 
            id="<?= $formField->getId('-radio-' . $id) ?>" 
            name="<?= $formField->getNameToHtml() ?>" 
            class="form-check-input <?= $formField->getInputClass() ?>" 
            <?= $formField->getValue() == $id ? 'checked' : '' ?>>
        <label 
            class="form-check-label <?= $formField->getLabelClass() ?>" 
            for="<?= $formField->getId('-radio-' . $id) ?>">
            <?= $option ?>
        </label>
    </div>
@endforeach