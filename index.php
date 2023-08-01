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
        <label class="mr-2 font-size-lg">INFORMATION</label>
        <button class="btn btn-dark" data-toggle="modal" data-target="#createScaleModal"><a href="create.php">ADD</a></button>
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

      if (mysqli_num_rows($result) > 0) {
        // Display table
        echo "<table class='table table-striped mx-auto'>";
        echo "<thead class='thead-dark'>
                <tr>
                    <th class='text-center'>Action</th>
                    <th class='text-center'> ID <a href='?sort=ID&order=" . ($sortColumn == 'ID' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "'><i class='fa fa-sort'></i></a></th>
                    <th class='text-center'> Name <a href='?sort=Name&order=" . ($sortColumn == 'Name' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "'><i class='fa fa-sort'></i></a></th>
                    <th class='text-center'> Date of Birth <a href='?sort=Date_of_Birth&order=" . ($sortColumn == 'Date_of_Birth' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "'><i class='fa fa-sort'></i></a></th>
                    <th class='text-center'> Address <a href='?sort=Address&order=" . ($sortColumn == 'Address' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "'><i class='fa fa-sort'></i></a></th>
                    <th class='text-center'> Contact Number <a href='?sort=Contact_Number&order=" . ($sortColumn == 'Contact_Number' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "'><i class='fa fa-sort'></i></a></th>
                </tr>
            </thead>";
        echo "<tbody>";

          // Display table rows
          while ($row = mysqli_fetch_assoc($result)) {
              $ID = $row['ID'];
              $Name = $row['Name'];
              $Date_of_Birth = $row['Date_of_Birth'];
              $Address = $row['Address'];
              $Contact_Number = $row['Contact_Number'];

              // Display each row with edit button
              echo "<tr>";
              echo "<td class='text-center'>
              <button id='edit-$ID' class='edit-button-scale btn btn-dark btn-sm' data-toggle='modal' data-target='#editScaleModal'><i class='fa fa-edit'></i></button>
          </td>";
          
              echo "<td class='text-center'>$ID</td>";
              echo "<td class='text-center'>$Name</td>";
              echo "<td class='text-center'>$Date_of_Birth</td>";
              echo "<td class='text-center'>$Address</td>";
              echo "<td class='text-center'>$Contact_Number</td>";

              echo "</tr>";
          }

          echo "</tbody></table>";
      } else {
          // No rows found
          echo "No records found.";
      }

      mysqli_close($con);
  ?>

    </div>
</body>
</html>
