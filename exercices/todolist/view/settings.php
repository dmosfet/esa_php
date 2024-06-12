<?php
if (isset($_GET['msg'])) {
$message = $_GET['msg'];
?>
<dialog open>
    <form method="dialog">
        <div class="dialog">
            <label><?php echo $message ?></label>
            <button>OK</button>
        </div>
    </form>
</dialog>
<?php } ?>
<div class="settingsgrid">
    <div class ="settingsitem"><?php include('./view/colors.php'); ?></div>
    <div class ="settingsitem"><?php include('./view/categories.php'); ?></div>
    <div class ="settingsitem"><?php include('./view/sort.php'); ?></div>
</div>