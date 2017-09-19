<?php

require_once 'database.php';

$id = null;

if ( !empty($_GET['id']) ) {
  $id = $_REQUEST['id'];
}

if (null == $id) {
  header("Location: /crud/");
} else {
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM customers WHERE id=?";
  $query = $pdo->prepare($sql);
  $query->execute( array($id) );
  $data = $query->fetch(PDO::FETCH_ASSOC);
  Database::disconnect();
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
      <h1>customer details</h1>
    </div>
    <div class="row">
      <div>
        <label>Name:</label>
        <label><?php echo $data['name']; ?></label>
      </div>
      <div>
        <label>Email:</label>
        <label><?php echo $data['email']; ?></label>
      </div>
      <div>
        <label>Mobile:</label>
        <label><?php echo $data['mobile']; ?></label>
      </div>
      <div>
        <a href="index.php">Back</a>
      </div>
    </div>
  </div>
</body>
</html>
