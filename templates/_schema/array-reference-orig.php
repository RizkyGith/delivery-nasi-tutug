<?php foreach($entries as $entry): ?>
<?php

if (is_callable($self->get('foreignLabel'))) {
    $getLabel = $self->get('foreignLabel');
    $label = $getLabel($entry);
} else {
    $label = $entry[$self->get('foreignLabel')];
}

?>
<div class="role-check">
    <label class="placeholder">
        <input
            type="checkbox"
            name="<?php echo $self['name'] ?>[]"
            value="<?php echo $entry['$id'] ?>"
            <?php echo (in_array($entry['$id'], $value) ? 'checked' : '') ?>
        />
        <?php echo $label ?>
    </label>
</div>
<?php endforeach; ?>