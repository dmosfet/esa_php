<?php header('content-type: text/css'); ?>

// Attributs statiques

body {
min-height:800px;
}

h2 {
padding-left: 30px;
font-style: italic;
}

.kanban {
display: grid;
width: 100%;
grid-template-columns: repeat(4, 1fr);
grid-column-gap: 50px;
width: 100%;
height: 575px;
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
float:right;
width: 50px;
height: 50px;
margin-left:5px;
background-position: center;
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

.search {
float:right;
width: 50px;
height: 50px;
margin-left:5px;
background-position: center;
background-image: url("../images/search_task.png");
background-size: 90%;
}

.categories {
float:right;
width: 50px;
height: 50px;
margin-left:5px;
background-position: center;
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

.filter {
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

.titre p {
max-width: 175px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
}

legend {
margin-left:30px;
}

.dialog {
padding:30px;
border: 2px solid;
}

.dialog button {
margin-left: 25%;
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

.addform, .modifyfilter, .filterform, .searchcard, .searchform, .modifycolor, .colorform {
    padding: 20px;
}

.s_new {
    height: 45px;
    width: 45px;
    border: 1px solid lightgrey;
    background-image: linear-gradient(white,lightgrey);
    border-radius:10px;
}

.s_started {
    border: 1px solid lightgrey;
    background-image: linear-gradient(steelblue,skyblue);
    border-radius:20px;
}

.s_closed {
border: 1px solid lightgrey;
background-image: linear-gradient(lime,green);
border-radius:20px;
}

.s_cancelled {
border: 1px solid lightgrey;
background-image: linear-gradient(coral,orange);
border-radius:20px;
}

.s_deleted {
background-color: red;
border-radius:20px;
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

.commentlign {
    display: flex;
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

.commentmenu{
    height: 100px;
    line-height: 100px;
    font-size: 10pt;
    width: 150px;
    margin-left: 30px;
}
.commentmenu p{
    float:right;
}

.deletecommentbutton{
    margin-top: 35px;
    background-image: url('../images/trash.png');
    background-size: cover;
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

input:valid {
border: 2px solid lime;
}


<?php
include ('../function.php');
// Background-color gérée par le fichier colortheme.csv
$colortheme = arrayfromcsv('../colortheme.csv');
$alltags = arrayfromcsv('../tags.csv');

foreach ($colortheme as $color) {
    echo $color['balise'] ."{" . $color['attribut'] . " : " . $color['color'] . ";}";
}

foreach ($alltags as $tag) {
    echo ".". $tag['name'] ."{ background-color : " . $tag['color'] . ";}";
}

?>
