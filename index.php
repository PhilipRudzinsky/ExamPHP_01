<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<div id="banner"><h1>W naszej hurtowni kupisz najtaniej</h1></div>
<div id="main">
<div id="lewy">
    <h3>Ceny wybranych artykułów w hurtowni:</h3>
    <?php
    $db = mysqli_connect("localhost", "root", "", "3pir2_sklep");

    $query = "SELECT nazwa, cena FROM towary LIMIT 4;";

    $result = mysqli_query($db, $query);

    echo "<table>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["nazwa"] . "</td>";
        echo "<td>" . $row["cena"] ." zł"."</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($db);
    ?>


</div>

<div id="srodkowy">
    <h3>Ile będą kosztować Twoje zakupy?</h3>
    <form method="post">
        <label for="artykul">Wybierz artykuł:</label>
        <select id="artykul" name="artykul">
            <option value="zeszyt60">Zeszyt 60 kartek</option>
            <option value="zeszyt32">Zeszyt 32 kartki</option>
            <option value="cyrkiel">Cyrkiel</option>
            <option value="linijka30">Linijka 30 cm</option>
            <option value="ekierka">Ekierka</option>
            <option value="linijka50">Linijka 50 cm</option>
        </select>
        <br>
        <label for="liczba_sztuk">Liczba sztuk:</label>
        <input id="liczba_sztuk" type="number" name="liczba_sztuk" value="1">
        <br>
        <input type="submit" value="OBLICZ">
    </form>

    <?php
    $db = mysqli_connect("localhost", "root", "", "3pir2_sklep");
    $artykul=0;
    $liczba_sztuk=0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $artykul = $_POST["artykul"];
        $liczba_sztuk = $_POST["liczba_sztuk"];
    }
    $query = "SELECT nazwa, cena FROM towary LIMIT 4;";
    $query = str_replace("WARUNEK", "nazwa_towaru='$artykul'", $query);

    $result = mysqli_query($db, $query);

    $row = mysqli_fetch_assoc($result);
    $kwota = $row["cena"] * $liczba_sztuk;
    $kwota = round($kwota, 1);

    echo "Kwota zakupów: " . $kwota;

    mysqli_close($db);
    ?>
</div>


<div id="prawy">
    <img src="zakupy.png" alt="hurtownia">
    <h3>Kontkat</h3>
    <p>telefon:<br> 111222333<br> e-mail:<br><a href="hurt@wp.pl">hurt@wp.pl</a></p>

</div>
</div>
<div id="footer">
    <h4>Witrynę wykonał: Filip Rudziński</h4>
</div>

</body>
</html>




