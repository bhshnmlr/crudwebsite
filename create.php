<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD Website</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>
<body>
  <div class="container"><br>
    <h1 class="title">CRUD WEBSITE</h1><br>

    <div class="d-flex justify-content-between">
        <label class="mr-2 font-size-lg">ADD</label>
        <button class="btn btn-dark" data-toggle="modal" data-target="#createScaleModal"><a href="index.php">Cancel</a></button>
    </div><br>
    <div class="crud_list">
  <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "db_crud";
      $con = mysqli_connect($servername, $username, $password, $dbname);

      // Check connection
      if (mysqli_connect_errno()) {
          echo "Error: Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
      }

      // Check if sorting parameters are provided
      $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'ID';
      $sortOrder = isset($_GET['order']) ? $_GET['order'] : 'DESC';

      // Retrieve all values from the tbl_crud table with sorting
      $select_query = "SELECT * FROM tbl_crud ORDER BY $sortColumn $sortOrder";
      $result = mysqli_query($con, $select_query); 
    ?>
       <form action="index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
        </form>
    </div>
</body>
</html>

   