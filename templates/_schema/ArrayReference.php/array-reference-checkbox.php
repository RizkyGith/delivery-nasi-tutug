<ul class="flat uris">
    <?php foreach ($entries as $groupName => $children):  ?>
        <li>
            <h5><?php echo $groupName ?></h5>
            <?php foreach ($children as $entity):  ?>
                <div class="role-check">
                    <label class="placeholder">
                        <input
                            type="checkbox"
                            name="<?php echo $itself['name'] ?>[]"
                            value="<?php echo $entity['uri'] ?>"
                            <?php echo (in_array($entity['uri'], $value)  ? 'checked' : '')  ?>
                        />
                        <?php echo ucfirst($entity['name']) ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </li>
    <?php endforeach; ?>
</ul>