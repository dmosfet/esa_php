<?php

$start = 9;
$due = 6;
$closed = 4;
$cancelled = 5;
$checked = true;
$msg = "Tout s'est bien passé";

echo "vide: " . (!empty($due)) . "<br>";
echo $due . "<br>";;
echo $start . "<br>";;

if ($due < $start) {
    echo "true";
} else {
    echo "false";
}

function checksondate($start, $due, $closed, $cancelled)
{
    $result = [];
    do {
        // La date d'échéance est antérieur à la date de début de la tâche
        if (!empty($due) && ($due < $start)) {
            echo "condition 1 OK";
            $checked = false;
            $msg = "Echéance antérieur au début de la tâche";
            $error[] = $checked;
            $error[] = $msg;
            $result[] = $error;
            unset($error);
        }
        // Une date de fin et d'annulation ont été encodées
        if (!empty($closed) && !empty($cancelled)) {
            $checked = false;
            $msg = "Une tâche terminée ne peut pas être annulée";
            $error[] = $checked;
            $error[] = $msg;
            $result[] = $error;
        }
    } while (0);

    return $result;
}

var_dump(checksondate($start, $due, $closed, $cancelled,));
?>

<table>
    <tr>
        <td><?php echo "Date d'échéance: "; ?></td>
        <td><?php if (!empty($task['start'])) {
                echo "Date de démarrage: ";
            } else {
                echo "Date de démarrage: Non démarrée";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td><?php if (!empty($task['closed'])) {
                echo "Date de clôture: ";
            } else {
                echo "Date de clôture: Non terminée";
            }
            ?></td>
        <td><?php if (!empty($task['cancelled'])) {
                echo "Date d'annulation': ";
            } else {
                echo "Date d'annulation: Non annumée";
            }
            ?>
        </td>
    </tr>
</table>