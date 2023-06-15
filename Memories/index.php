<?php
    require "../config.php";

    session_start();

    $user_id = $_SESSION["id"];

    $sql= mysqli_query($mysql, "SELECT * FROM memory where id_user='$user_id'");

    header("Content-Type: text/xml;charset=iso-8859-1");

    $base_url = "http://localhost/TW_Proiect_2023_Popa_Eliza_Tanase_Maria/Memories/";

    echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL;
    echo "<rss version='2.0'>" . PHP_EOL;
    echo "<channel>" . PHP_EOL;
    echo "<title>Memories</title>" . PHP_EOL;
    echo "<link>".$base_url."index.php</link>" . PHP_EOL;
    echo "<description>User's memories for all children</description>" . PHP_EOL;
    echo "<language>en-us</language>" . PHP_EOL;

    while ($row = mysqli_fetch_assoc($sql)) {
        $date = date("d.m.y", strtotime($row['date']));

        $base64image = base64_encode($row['picture']);

        echo "<item xmlns:dc='ns:1'>" . PHP_EOL;
        echo "<title>".$row['title']."</title>" . PHP_EOL;
        echo "<link>".$base_url."Memories-child.php?id=".$row['id_child']."</link>" . PHP_EOL;
        echo "<guid>".md5($row['id'])."</guid>" . PHP_EOL;
        echo "<pubDate>".$date."</pubDate>" . PHP_EOL;
        echo "<description>".$row['description']."</description>" . PHP_EOL;
        echo "<enclosure url='date:image/jpeg;base64,".$base64image."'>" . PHP_EOL;
        echo "<length>".strlen($base64image)."</length>" . PHP_EOL;
        echo "<type>image/jpeg</type>" . PHP_EOL;
        echo "</enclosure>" . PHP_EOL;
        echo "</item>" .PHP_EOL;

    }

    echo "</channel>" . PHP_EOL;
    echo "</rss>" . PHP_EOL;
?>