<?php

require_once 'database.php';

$id = 0;

if ( !empty($_GET['id']) ) {
  $id = $_GET['id'];
} else {
  header("Location: index.php");
}

if ( !empty($_POST) ) {
  $id = $_POST['id'];

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $sql = "DELETE FROM customers WHERE id=?";
  $query = $pdo->prepare($sql);
  $msg = $query->execute( array($id) );
  Database::disconnect();
  header("Location: index.php");
}

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
      <form action="delete.php" method="post">
        <input type="hidden" name="id" value=<?php echo $id; ?> >
        <p>Are you sure to delete the record?</p>
        <div>
          <button type="submit">Yes</button>
          <a href="index.php">No</a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
