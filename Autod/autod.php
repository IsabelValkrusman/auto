<?php
require_once ('connect.php');
global $yhendus;
//andmete lisamine tabelisse
if(isset($_REQUEST['lisamisvorm']) && !empty($_REQUEST["omanik"])) {
    $algus = $yhendus->prepare(
        "INSERT INTO auto(omanik, mark, vabastamise_aeg) VALUES (?,?,?)"
    );
    $algus->bind_param("sss", $_REQUEST["omanik"], $_REQUEST["mark"], $_REQUEST["vabastamise_aeg"]);
//("s"-string, $_REQUEST["nimi"]- tekstkasti nimega nimi pöördumine)
//sdi, s-string, d-double, i-integer
    $algus->execute();
}
if(isset($_REQUEST['kustuta'])){
    $algus=$yhendus->prepare("DELETE FROM auto WHERE id=?");
    $algus->bind_param('i', $_REQUEST["kustuta"]);
    $algus->execute();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Autod</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<h1>Autod</h1>
<div id="meny">
    <ul>
        <?php
        //näitab looamde loetelu tabelist loomad
        $algus=$yhendus->prepare("SELECT autoId, mark, omanik,vabastamise_aeg FROM auto");
        $algus->bind_result($autoId,$mark,$omanik, $vabastamise_aeg);
        $algus->execute();

        while($algus->fetch()){

            echo "<li><a href='?autoId=$autoId'>$omanik</li>";
        }
        echo" </ul>";
        echo"<a href='?lisaloom=jah'>Lisa auto</a>";
        ?>

</div>
<div id="sisu">


    <?php
    if(isset($_REQUEST["autoId"])){
        $algus=$yhendus->prepare("SELECT mark ,vabastamise_aeg , omanik FROM auto WHERE autoId=?");
        $algus->bind_param('i', $_REQUEST["autoId"]);
        //? küsimärki asemel aadressiribal tuleb id
        $algus->bind_result($omanik, $mark,$vabastamise_aeg);
        $algus->execute();
        if($algus->fetch()){
            echo "<div><strong>".htmlspecialchars($omanik)."</strong>, Auto mark ";
            echo "<br>";
            echo htmlspecialchars($mark). " vabastamise aeg";
            echo "<br>Omaniku nimi ".htmlspecialchars($vabastamise_aeg);
           // echo "<br><td><a href='?kustuta=$autoId'>Kustuta</a></td>";
            echo"</div>";
        }
    }

    if(isset($_REQUEST["lisaloom"])){
        ?>
        <h2>Uue auto lisamine</h2>
        <form name="uusloom" method="post" action="?">
            <input type="hidden" name="lisamisvorm" value="jah">
            <input type="text" name="omanik" placeholder="Omaniku nimi">
            <br>
            <input type="text" name="mark" max="30" placeholder="Auto mark">
            <br>
            <input type="text" name="vabastamise_aeg" placeholder="Vabastamise aeg">

            <input type="submit" value="OK">
        </form>
        <?php
    }
    else{
        echo"<h3>Siia tuleb autode info...</h3>";
    }
    ?>

</div>

</body>
</html>