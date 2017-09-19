<?php

require_once 'database.php';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Title</title>
</head>
<body>
  <div class="container">
    <div class="row">
    <h1>Table Info</h1>
    </div>
    <div class="row">
      <p>
        <a href="create.php">Create</a>
      </p>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Mobile</th>
            <th>Action</th>
          </tr>
        </thead>
          <tbody>
            <?php
            $pdo = Database::connect();
            $sql = "SELECT * FROM customers ORDER BY id ASC";

            foreach ($pdo->query($sql) as $row) {
              echo "<tr>";
              echo "<td>";
              echo $row['name'];
              echo "</td>";
              echo "<td>";
              echo $row['email'];
              echo "</td>";
              echo "<td>";
              echo $row['mobile'];
              echo "</td>";
              echo "<td>";
              echo "<a href=\"read.php?id=" . $row['id'] . "\">Read</a> ";
              echo "<a href=\"update.php?id=" . $row['id'] . "\">Update</a> ";
              echo "<a href=\"delete.php?id=" . $row['id'] . "\">Delete</a> ";
              echo "</td>";
              echo "</tr>";
            }
                Database::disconnect();
            ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
