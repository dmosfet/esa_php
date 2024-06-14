<?php header('content-type: text/css'); ?>

body {
    min-height:800px;
}

header, footer {
    min-height: 100px;
}

h2 {
    padding-left: 30px;
    font-style: italic;
}

.recyclenumber {
    height: 15px;
    width: 15px;
    line-height: 15px;
    font-size: 10px;
    border-radius: 8px;
    text-align: center;
    border: 1px solid red;
    background-color: red;
    text: black;
}

.kanban {
    display: grid;
    width: 100%;
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 50px;
    height: 650px;
}

.nouveau, .encours, .annulé, .terminé, .card {
    border: 5px solid;
    border-radius: 20px;
    overflow-y: scroll;
    scrollbar-color:darkcyan lightseagreen;
    scrollbar-width: none;
}

.bin {
    float:right;
    width: 50px;
    height: 50px;
    margin-left:5px;
    background-position: center;
    background-image : url('../images/trash.png ');
    background-size: 90%;
}

.colors {
    margin-top:5px;
    background-image : url('../images/color.png ');
    background-size: 90%;
}

.chart {
    float:right;
    width: 50px;
    height: 50px;
    margin-left:5px;
    background-position: center;
    background-image : url('../images/chart.png ');
    background-size: 90%;
}

.gantt {
    float:right;
    width: 50px;
    height: 50px;
    margin-left:5px;
    background-position: center;
    background-image : url('../images/gantt.png ');
    background-size: 90%;
}

.main {
    float:right;
    width: 50px;
    height: 50px;
    margin-left:5px;
    background-position: center;
    background-image : url('../images/tasks.png ');
    background-size: 90%;
}

.search {
    float:right;
    width: 50px;
    height: 50px;
    margin-left:5px;
    background-position: center;
    background-image: url("../images/search_task.png");
    background-size: 90%;
}

.settings {
    float:right;
    width: 50px;
    height: 50px;
    margin-left:5px;
    background-position: center;
    background-image : url('../images/settings.png ');
    background-size: 90%;
}

.categories {
    margin-top:5px;
    background-image : url('../images/tag.png ');
    background-size: 90%;
}

.addtag {
    float:left;
    width: 50px;
    height: 50px;
    margin-left:5px;
    background-position: center;
    background-image : url('../images/add.png ');
    background-size: 90%;
}

.action {
    padding-top:7px;
    padding-right:7px;
    margin-left: 10px;
    float:right;
}

.cartouche {
    margin:auto;
    margin-bottom: 20px;
    border: 2px solid;
    border-radius: 10px;
    padding: 10px;
    width: 95%;
    height:50px;
}

.menu {
    width: 100px;
}

.button {
    float:right;
    width: 30px;
    height: 30px;
    margin-left:5px;
    background-position: center;
}

.create {
    background-image: url("../images/add_task.png");
    background-size: 90%;
    border-radius:10px;
}

.sort {
    background-image: url("../images/sort.png");
    background-size: 90%;
    border-radius:10px;
}

.start {
    background-image: url("../images/start_task.png");
    background-size: 90%;
    border-radius:10px;
}

.restart {
    background-image: url("../images/restore_task.png");
    background-size: 90%;
    border-radius:10px;
}


.edit {
    background-image: url("../images/edit_task.png");
    background-size: 90%;
    border-radius:10px;
}

.cancel {
    background-image: url("../images/giveup_task.png");
    background-size: 90%;
    border-radius:10px;
}

.close {
    background-image: url("../images/task_done.png");
    background-size: 90%;
    border-radius:10px;
}

.delete {
    background-image: url("../images/delete_task.png");
    background-size: 90%;
    border-radius:10px;
}

.titre {
    min-width: 50px;
    float:left;
}

.titrefind {
    min-width: 50px;
    float:left;
}

.titrefind p{
    max-width: 175px;
    white-space: nowrap;
}

.titrerecycle {
min-width: 50px;
float:left;
}

.titrerecycle p{
max-width: 175px;
white-space: nowrap;
}

.titre p {
    max-width: 175px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

legend {
    margin-left:30px;
}


.message {
    display: grid;
    grid-template-rows: 50px 50px;
    margin: auto;
}

dialog form button {
    width: 100%;
}

.tag {
    text-align:center;
    margin-right: 12px;
    border:1px solid;
    border-radius:10px;
    padding-left:10px;
    padding-right:10px;
}

.legendkanban {
    height:50px;
    font-size:24px;
    border: inherit;
    background-color: inherit;
    padding-left:10px;
    border-radius: 10px;
}

.cardview, .formview {
    padding: 20px;
}

.cardtitle {
    text-align: right;
}

.viewcard {
    padding: 20px;
}

.addform, .modifyfilter, .filterform, .searchcard, .searchform, .modifycolor, .colorform, .planning, .viewplanning,.legendplanning, .stattable, .viewstat, .viewtag, .tagtable, .tagform, .colortable, .colorview, .sorttable {
    padding: 20px;
}


.s_new {
    height: 45px;
    width: 45px;
    border: 1px solid lightgrey;
    background-image: linear-gradient(white,lightgrey);
    border-radius:25px;
}

.s_started {
    height: 45px;
    width: 45px;
    border: 1px solid lightgrey;
    background-image: linear-gradient(steelblue,skyblue);
    border-radius:25px;
}

.s_closed {
    height: 45px;
    width: 45px;
    border: 1px solid lightgrey;
    background-image: linear-gradient(lime,green);
    border-radius:25px;
}

.s_cancelled {
    height: 45px;
    width: 45px;
    border: 1px solid lightgrey;
    background-image: linear-gradient(coral,orange);
    border-radius:25px;
}

.s_deleted {
    height: 45px;
    width: 45px;
    background-color: red;
    border-radius:25px;
}

.cardheader table tr td {
    border: transparent;
    background-color: transparent;
}

.carddescription, .cardcomments {
    height: 100px;
    background-color: lightgrey;
    border: 2px solid black;
    border-radius: 10px;
}

.carddescription p, .cardcomments p {
    padding:10px;
}

.taglist {
    display: inline;
}

.joinfile {
    background-image: url('../images/paperclip.png');
    background-size: cover;
}

.deletefile{
    background-image: url('../images/trash.png');
    background-size: cover;
}

.addcomment{
    background-image: url('../images/add.png');
    background-size: cover;
}

.addlist{
    background-image: url('../images/add.png');
    background-size: cover;
}

.commentlign {
    display: grid;
    grid-template-columns: 1250px 100px 50px;
}

.cardcomments {
    max-height: 100px;
    width: 100%;
    overflow-y: scroll;
    background-color: lightgrey;
    border: 2px solid black;
    border-radius: 10px;
    margin-bottom:10px;
}

.commentdate{
    height: 100px;
    line-height: 25x;
    font-size: 10pt;
    padding-top: 50px;
    padding-left: 20px;
}

.deletecommentbutton{
    margin-top: 35px;
    background-image: url('../images/trash.png');
    background-size: cover;
}

.deleteentrylistbutton{
    background-position: center;
    height:30px;
    width:30px;
    background-image: url('../images/trash.png');
    background-size: cover;
}
.uncheckedentrylistbutton{
    background-position: center;
    height:30px;
    width:30px;
    background-image: url('../images/check.png');
    background-size: cover;
}

.checkedentrylistbutton{
    background-position: center;
    height:30px;
    width:30px;
    background-image: url('../images/uncheck.png');
    background-size: cover;
}

.entrylist {
    list-style-decoration: none;
    display: grid;
    grid-template-columns: 35px 1000px 50px 50px;
    grid-template-rows: 50px;
}

.entrylist p {
    line-height: 20px;
}

.entrylist input[type=checkbox]:checked + label{
    text-decoration: line-through;
}

.entrylist input[type=checkbox].hidden{
display:none;
}

.cardtitle h2 {
    text-align: left;
}

hr {
    border: 5px solid darkcyan;
}

input:invalid {
    border: 2px solid red;
}


.T {
    background-color: limegreen;
}

.B {
    background-color: gold;
}

.P {
    background-color: deepskyblue;
}

.M {
    background-color: crimson;
}

.W {
    background-color: lightslategray
}

.L {
    background-color: wheat
;
}

.planning {
    padding:10px;
    margin:auto;
    table-layout: fixed;
}

.taskcolumn {
    width: 300px;
}

.datecolumn {
    width:45px;
}

.weekafter {
    background-image: url("../images/after.png");
    background-repeat: no-repeat;
    background-size: 90%;
    border-radius:10px;
}

.weekbefore {
    background-image: url("../images/before.png");
    background-repeat: no-repeat;
    background-size: 90%;
    border-radius:10px;
}

.settingsgrid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
}

.settingsitem:first-child {
    grid-row: 1 / 3;    /* same concept, but for rows */
}

<?php
include ('../function.php');
// Background-color gérée par le fichier colortheme.csv
$colortheme = arrayfromcsv('../model/colortheme.csv');
$alltags = arrayfromcsv('../model/tags.csv');

foreach ($colortheme as $color) {
    echo $color['balise'] ."{" . $color['attribut'] . " : " . $color['color'] . ";}";
}

foreach ($alltags as $tag) {
    echo ".". $tag['name'] ."{ background-color : " . $tag['color'] . ";}";
}

?>
