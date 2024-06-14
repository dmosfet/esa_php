<div class="viewcard">
    <?php
    if (isset($_GET['msg'])) {
        $message = $_GET['msg'];
        ?>
        <dialog open>
            <form method="dialog">
                <div class="dialog">
                    <label><?php echo urldecode($message) ?></label>
                    <button>OK</button>
                </div>
            </form>
        </dialog>
        <?php
    }
    $number = $_GET['task'];
    $_SESSION['task'] = $number;
    $alltasks = arrayfromcsv("./model/tasks.csv");
    $alltags = arrayfromcsv("./model/tags.csv");

    $task = findtask($alltasks, $number);

    foreach ($task as $key => $value) {
        $label = match ($key) {
            'number' => 'Numéro',
            'name' => 'Nom',
            'description' => 'Description',
            'status' => 'Statut actuel',
            'old_status' => 'Ancien statut',
            'creation' => 'Date de creation',
            'start' => 'Date de début',
            'due' => 'Echéance',
            'closed' => 'Date de clôture',
            'cancelled' => 'Date d\'annulation',
            'tags' => 'Catégories',
        };
    }

    $statut = match ($task['status']) {
        '0' => "Nouvelle tâche",
        '1' => "En cours",
        '2' => "Terminée",
        '3' => "Annulée",
        '-1' => "Supprimée",
    };

    $statusicon = match ($task['status']) {
        '0' => "s_new",
        '1' => "s_started",
        '2' => "s_closed",
        '3' => "s_cancelled",
        '-1' => "s_deleted",
    };

    $oldstatut = match ($task['old_status']) {
        '0' => "Nouvelle tâche",
        '1' => "En cours",
        '2' => "Terminée",
        '3' => "Annulée",
        '-1' => "Supprimée",
    };

    ?>
    <fieldset class="card">
        <div class="cardview">
            <div class="cardtitle">
                <h2>
                    <span><?php echo '#' . $task['number'] . " - " . $task['name']; ?></span>
                    <div class="button <?php echo $statusicon; ?>"></div>
                </h2>
                <p><?php echo "Date de création: " . date('d-m-Y', $task['creation']); ?></p>
            </div>
            <hr>
            <div class="cardheader">
                <table>
                    <tr>
                        <td><?php if (!empty($task['due'])) {
                                echo "Echéance: " . date('d-m-Y', $task['due']);
                            } else {
                                echo "Echéance: Non déterminée";
                            }
                            ?>
                        </td>
                        <td><?php if (!empty($task['start'])) {
                                echo "Début: " . date('d-m-Y', $task['start']);
                            } else {
                                echo "Début: Non déterminé";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php if (!empty($task['closed'])) {
                                echo "Date de clôture: " . date('d-m-Y', $task['closed']);
                            } else {
                                echo "Date de clôture: Non terminée";
                            }
                            ?></td>
                        <td><?php if (!empty($task['cancelled'])) {
                                echo "Date d'annulation: " . date('d-m-Y', $task['cancelled']);
                            } else {
                                echo "Date d'annulation: Non annulée";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="cardtags">
                <p>Catégories: </p>
                <div class="taglist">
                    <?php
                    if (!(empty($task['tags']))) {
                        $tags = explode(",", $task['tags']);
                        foreach ($tags as $tag) {
                            ?>
                            <span class="tag <?php echo $tag; ?>"><?php echo $tag; ?></span>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <hr>
            <div>
                <p>Description:</p>
                <div class="carddescription">
                    <p><?php echo $task['description']; ?></p>
                </div>
            </div>
            <hr>
            <div>
                <span>Liste: </span>
                <a href="index.php?mode=cardviewer&task=<?php echo $number; ?>&list=<?php echo "true"; ?>">
                    <div class="button addlist" title="Ajouter un liste"></div>
                </a>
                <p></p>
            </div>
            <?php
            $entrylist = findentrylistfromtasknumber('./model/minitasklist.csv', $number);
            $lastidentry = nextnumber(readcsv('./model/minitasklist.csv'));
            if ($entrylist) {
                $taskchecked = 0;
                $totaltask = 0;
                foreach ($entrylist

                         as $entry) {
                    $totaltask++;
                    ?>
                    <ol>
                        <li class="entrylist">
                            <a href="./controller/checkentrylist.php?entry=<?php echo $entry[0]; ?>">
                                <div class="<?php if ($entry[3] == 1) {
                                    echo "checkedentrylistbutton";
                                } else {
                                    echo "uncheckedentrylistbutton";
                                } ?>" title="Valider/Invalider"></div>
                            </a>
                            <input type="checkbox" class="hidden"
                                   pattern="[A-Za-zà-üÀ-Ü\-\!\'\s]+" <?php if ($entry[3] == 1) {
                                echo "checked";
                                $taskchecked++;
                            } ?>>
                            <label><?php echo $entry[2]; ?></label>
                            <a href="./controller/deleteentrylist.php?entry=<?php echo $entry[0]; ?>">
                                <div class="deleteentrylistbutton" title="Effacer cette entrée"></div>
                            </a>
                        </li>
                    </ol>
                <?php }
                echo "Etat d'avancement de la tâche: " . round(($taskchecked / $totaltask) * 100, 2) . "%";
            } ?>
            <?php
            if (isset($_GET['list']) && $_GET['list'] == "true") {
                require('./view/form/cardform/card_addlist_form.php');
            }
            ?>
            <hr>
            <div class="cardfiles">
                <span>Pièces jointes: </span>
                <?php
                if (isset($_GET['join']) && $_GET['join'] == "true") {
                    include('./view/form/cardform/card_joinfile_form.php');
                } ?>
                <a href="index.php?mode=cardviewer&task=<?php echo $number; ?>&join=<?php echo "true"; ?>">
                    <div class="button joinfile" title="Ajouter une pièce-jointe"></div>
                </a>
                <p></p>
                <?php
                $piecesjointes = findfilefromtasknumber('./model/files.csv', $number);
                if ($piecesjointes) {
                foreach ($piecesjointes

                as $fichier) {
                ?>
                <div>
                    <span>
                        <a href="./upload/<?php echo $fichier[1]; ?>"><?php echo $fichier[1]; ?></a>
                    </span>
                    <span>
                            <?php $file = urlencode($fichier[1]); ?>
                        <a href="./controller/deletefile.php?task=<?php echo $number; ?>&file=<?php echo $file; ?>">
                            <div class="button deletefile" title="""Supprimer la pièce-jointe"></div></a>
                    </span>
            </div>
        <?php
                    }
                }
        ?>
        </div>
        <hr>
        <div>
            <span>Commentaires: </span>
            <?php
            $allcomments = arrayfromcsv('./model/comments.csv');
            $comments = tasknumberfilteredcomments($allcomments, $number);
            $lastidcomment = nextnumber(readcsv('./model/comments.csv'));
            ?>
            <a href="index.php?mode=cardviewer&task=<?php echo $number; ?>&comment=<?php echo "true"; ?>">
                <div class="button addcomment" title="Ajouter un commentaire"></div>
            </a>
        </div>
        <br>
        <?php
        if ($comments) {
            foreach ($comments as $comment) { ?>
                <div class="commentlign">
                    <div class="cardcomments">
                        <p><?php echo $comment['comment']; ?></p>
                    </div>
                    <div class="commentdate">
                        <p><?php echo $comment['date']; ?></p>
                    </div>
                    <div class="commentaction">
                        <a href="./controller/deletecomment.php?id=<?php echo $comment['id']; ?>','local', 'width=400 , height=700')">
                            <div class="button deletecommentbutton" title="Effacer le commentaire"></div>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <?php
        } else { ?>
            <div class="commentlign">
                <div class="cardcomments">
                    <p>Aucun commentaire</p>
                </div>
            </div>
            <?php
        }
        if (isset($_GET['comment']) && $_GET['comment'] == "true") {
            require('./view/form/cardform/card_addcomment_form.php');
        }
        ?>
        <p></p>
        <form action="index.php" method="get">
            <input type="hidden" name="mode" value="cardmodifyer">
            <input type="submit" name="modify" value="Modifier">
        </form>
        <form action="index.php" method="post">
            <input type="submit" name="mode" value="Fermer">
        </form>
    </fieldset>
</div>