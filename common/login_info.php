<?php
require_once "functions.php";
session_start();
$db = open_db();
$result = mysqli_query($db, "SELECT * FROM users WHERE id = ".$_SESSION['id']);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($result != false) {
    $row = mysqli_fetch_array($result);
} else {
    echo "Something went wrong :(";
}

?>
    <?= t_header("Account")?>
    <body>
        <?= t_head()?>
        <div id = 'box'>
            <div id = 'inner_box'>
                <div id = 'row'>
                    <h3>Username:   </h3><p id = 'con'> <?php echo $row['name']; ?> </p>
                </div>
                <div id = 'row'>
                    <h3>Date Created:   </h3><p id = 'con'> <?php echo $row['date_created']; ?> </p>
                </div>
                <?php if ($row['role'] == 1): ?>
                    <div id = 'row'>
                        <h3>History:   </h3>
                        <?php 
                            $result = mysqli_query($db, "SELECT * FROM history WHERE id_user = ". $_SESSION["id"]);
                            if ($result){
                                ?>
                                <table>
                                    <tr>
                                        <th>ID History</th>
                                        <th>ID User</th>
                                        <th>Number of Elements</th>
                                        <th>Titles</th>
                                        <th>Date</th>
                                    </tr><?php
                                    while($r = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $r['id_history'] . "</td>";
                                        echo "<td>" . $r['id_user'] . "</td>";
                                        echo "<td>" . $r['num_elem'] . "</td>";
                                        echo "<td>" . $r['titles'] . "</td>";
                                        echo "<td>" . $r['date'] . "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                                </table>
                                <?php
                            }?>
                    </div>
                <?php else: ?>
                    <div id = 'row'>
                        <h3>User History:   </h3>
                    </div><?php 
                    $result = mysqli_query($db, "SELECT * FROM history");
                    if ($result){
                        ?>
                        <table>
                            <tr>
                                <th>ID History</th>
                                <th>ID User</th>
                                <th>Number of Elements</th>
                                <th>Titles</th>
                                <th>Date</th>
                            </tr><?php
                            while($r = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $r['id_history'] . "</td>";
                                echo "<td>" . $r['id_user'] . "</td>";
                                echo "<td>" . $r['num_elem'] . "</td>";
                                echo "<td>" . $r['titles'] . "</td>";
                                echo "<td>" . $r['date'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                        </table>
                        <?php
                    }
                endif; ?>
            </div>    
        </div>
    </body>
</html>