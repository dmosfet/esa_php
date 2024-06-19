<?php
$kanbanviewmode = $_POST['kanbanview'] ?? "status";
?>
    <form action="index.php" method="post">
        <label>Trié:
            <select name="kanbanview" id="filter">
                <option value="status" <?php if ($_POST['kanbanview'] = "status") {
                    echo 'selected="selected"';
                } ?>>Par status
                </option>
                <option value="tags" <?php if ($_POST['kanbanview']= "tags") {
                    echo 'selected="selected"';
                } ?>>Par catégorie
                </option>
                <option value="date" <?php if ($_POST['kanbanview'] = "date") {
                    echo 'selected="selected"';
                } ?>>Par échéance
                </option>
            </select>
        </label>
        <input type="submit" name="submit">
    </form>
<?php

if ($kanbanviewmode == "status") {
    require('kanbanstatus.php');
} else if ($kanbanviewmode == "tags") {
    require('kanbantags.php');
} else if ($kanbanviewmode == "date") {
    require('kanbandate.php');
}