<?php
  require_once "database.php";

  $id = null;

  if ( !empty($_GET['id']) ) {
    $id = $_GET['id'];
  }

  if ( null == $id ) {
    header("Location: a.php");
  }

  if ( !empty($_POST) ) {
    $nameError = $emailError = $mobileError = null;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    //all inputs are valid
    $valid = true;

    /* test all inputs */
    if ( empty($name) ) {
      $nameError = "Please enter name.";
      $valid = false;
    } 

    if ( empty($email) ) {
      $emailError = "Please enter email address.";
      $valid = false;
    } else if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
      $emailError = "Please enter a valid email address.";
      $valid = false;
    }

    if ( empty($mobile) ) {
      $mobileError = "Please enter a mobile number.";
      $valid = false;
    }

    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE customers SET name=?, email=?, mobile=? WHERE id=?";
      $query = $pdo->prepare($sql);
      $query->execute( array($name, $email, $mobile, $id) );
      Database::disconnect();
      header("Location: /crud/");
    }
  } else {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM customers WHERE id=?";
      $query = $pdo->prepare($sql);
      $query->execute( array($id) );
      $data = $query->fetch( PDO::FETCH_ASSOC );
      $name = $data['name'];
      $email = $data['email'];
      $mobile = $data['mobile'];
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
      <h1>Update Customer</h1>
    </div>
    <div class="row">
      <form action="update.php?id=<?php echo $id; ?>" method="post">
        <div class="<?php echo !empty($nameError) ? 'error' : ''; ?>">
          <label>Name</label>
          <input type="text" name="name" value="<?php echo !empty($name) ? $name : ''; ?>"/>
          <?php if ( !empty($nameError) ): ?>
            <span><?php echo $nameError; ?></span>
          <?php endif; ?>
        </div>
        <div class="<?php echo !empty($emailError) ? 'error' : ''; ?>">
          <label>Email</label>
          <input type="text" name="email" value="<?php echo !empty($email) ? $email : ''; ?>"/>
          <?php if ( !empty($emailError) ): ?>
            <span><?php echo $emailError; ?></span>
          <?php endif; ?>
        </div>
        <div class="<?php echo !empty($mobileError) ? 'error' : ''; ?>">
          <label>Mobile</label>
          <input type="text" name="mobile" value="<?php echo !empty($mobile) ? $mobile : ''; ?>"/>
          <?php if ( !empty($mobileError) ): ?>
            <span><?php echo $mobileError; ?></span>
          <?php endif; ?>
        </div>
        <div>
          <button type="submit">Update</button>
          <a href="index.php">Back</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
