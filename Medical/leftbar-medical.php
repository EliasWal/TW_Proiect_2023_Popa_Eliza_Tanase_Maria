<?php
    $user_id = $_SESSION["id"];

    $sql2= mysqli_query($mysql, "SELECT * FROM child where id_parent='$user_id'");
?>

<div class="leftbar">
    <h2>Children</h2>
    <ul class="choose-child">
        <?php
            while ($row = mysqli_fetch_assoc($sql2)) {
                $child_name = $row['firstname']; 
                $child_id = $row['id'];
        ?>
            <li> <a href="Medical-child.php?id=<?php echo $child_id; ?>" class="child"> <?php echo $child_name; ?> </a> </li>
        <?php
            }
        ?>
    </ul>
 </div>