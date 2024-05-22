<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<input type="hidden" name="number" placeholder="Numéro de la tâche" value="<?php echo $number;?>"/>
<input type="text" name="name" placeholder="Nom de la tâche" value="<?php echo $name;?>" pattern="[A-Za-zà-üÀ-Ü\s]+" required/>
<input type="hidden" name="status" placeholder="Status actuel" value="<?php echo $status;?>"/>
<input type="hidden" name="old_status" placeholder="Ancien status" value="<?php echo $old_status;?>"/>
<input type="text" name="creation" placeholder="Date de création" onblur="(this.type='text')" onfocus="(this.type='date')" value="<?php echo $creation;?>"/>
<input type="text" name="start" placeholder="Date de début" onblur="(this.type='text')" onfocus="(this.type='date')" value="<?php echo $start;?>"/>
<input type="text" name="due" placeholder="Echéance" onblur="(this.type='text')" onfocus="(this.type='date')" value="<?php echo $due;?>"/>
<input type="text" name="closed" placeholder="Date de clôture" onblur="(this.type='text')" onfocus="(this.type='date')" value="<?php echo $closed;?>"/>
<input type="text" name="canceled" placeholder="Date d'annulation" onblur="(this.type='text')" onfocus="(this.type='date')" value="<?php echo $cancelled;?>"/>
<?php foreach ($tags as $tag) {
    ?><input type="checkbox" id="<?php echo $tag['name'];?>" name="tags[]"  value="<?php echo $tag['name']?>"/>
    <label htmlFor="<?php echo $tag['name'];?>"><?php echo $tag['name'];?></label>
<?php
}
?>
</body>
</html>