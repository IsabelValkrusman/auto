<?php
$kasutaja='valkrusman'; //d105627_isabel //valkrusman
$server='localhost'; // d105627.mysql.zonevs.eu //localhost
$andmebaas='valkrusman_auto';//d105627_isabel //valkrusman
$salasyna='12345'; //12345
//teeme käsk mis ühendab andmebaasiga
$yhendus=new mysqli($server, $kasutaja, $salasyna,$andmebaas);
$yhendus->set_charset('UTF8');

/*CREATE TABLE loomad(
    id int PRIMARY key AUTO_INCREMENT,
    loomanimi varchar(15) UNIQUE,
    vanus int,
    pilt text)*/

?>
