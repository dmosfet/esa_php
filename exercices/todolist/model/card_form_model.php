<input type="hidden" name="number" placeholder="Numéro de la tâche" value="<?php echo $number; ?>"/>
<input type="text" name="name" placeholder="Nom de la tâche" value="<?php echo $name; ?>" required
       pattern="[A-Za-zà-üÀ-Ü\s]+"/>
<input type="text" name="description" placeholder="Description de la tâche" value="<?php echo $description; ?>"
       required/>
<input type="hidden" name="status" placeholder="Status actuel" value="<?php echo $status; ?>"/>
<input type="hidden" name="old_status" placeholder="Ancien status" value="<?php echo $old_status; ?>"/>
<input type="text" name="creation" placeholder="Date de création" onblur="(this.type='text')"
       onfocus="(this.type='date')" value="<?php echo $creation; ?>"/>
<input type="text" name="start" placeholder="Date de début" onblur="(this.type='text')" onfocus="(this.type='date')"
       value="<?php echo $start; ?>"/>
<input type="text" name="due" placeholder="Echéance" onblur="(this.type='text')" onfocus="(this.type='date')"
       value="<?php echo $due; ?>"/>
<input type="text" name="closed" placeholder="Date de clôture" onblur="(this.type='text')" onfocus="(this.type='date')"
       value="<?php echo $closed; ?>"/>
<input type="text" name="cancelled" placeholder="Date d'annulation" onblur="(this.type='text')"
       onfocus="(this.type='date')" value="<?php echo $cancelled; ?>"/>
<?php foreach ($alltags as $tag) {
    ?><input type="checkbox" id="<?php echo $tag['name']; ?>" name="tags[]"
             value="<?php echo $tag['name']; ?>" <?php if (str_contains($tags, $tag['name'])) {
        echo "checked";
    } ?>/>
    <label htmlFor="<?php echo $tag['name']; ?>"><?php echo $tag['name']; ?></label>
    <?php
}
?>
<p></p>