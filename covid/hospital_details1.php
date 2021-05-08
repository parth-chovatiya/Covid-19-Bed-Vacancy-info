<?php 
  session_start();
  
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/footer1.css">

    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/hospital_details2.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <title>Hospital Details</title>
    <style>
      
    </style>
  </head>
  <body>
    <?php 
      include 'partials/_navbar.php'; 
      include 'partials/_dbconnect.php';
    ?>
    
      <div class="container my-5" style="max-width: 1350px;">
          <h2 class="my-4" id="white-color">COVID-19 Hospital</h2>

          <table id="myTable" class="row-border order-column table1" style="width:100%">
              <thead class="tableHead">
                  <tr>
                      <th>sno</th>
                      <th>Hospital Name</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Pincode</th>
                      <th>Contact</th>
                      <th>Total Bad</th>
                      <th>Available Bad</th>
                      <th>Last Updated</th>
                  </tr>
              </thead>
              <tbody class="tableBody">
                  <?php
                    $sql = "SELECT * FROM `hospital_info`";
                    $result = mysqli_query($conn, $sql);
                    $sn = 0;
                    while($row = mysqli_fetch_assoc($result)){
                      $sn = $sn + 1;
                      echo "<tr>
                        <td>" . $sn . "</td>
                        <td>" . $row['hospital_name'] . "</td>
                        <td>" . $row['address'] . "</td>
                        <td>" . $row['city'] . "</td>
                        <td>" . $row['state'] . "</td>
                        <td>" . $row['pincode'] . "</td>
                        <td><ul><li>" . $row['mobile_no1'] . "</li><li>" . $row['mobile_no2'] . "</li><li>" . $row['email_id'] . "</li><li>" . $row['website'] . "</li></ul></td>
                        <td>" . $row['total_bad'] . "</td>
                        <td>" . $row['available_bad'] . "</td>
                        <td>" . $row['last_updated'] . "</td>
                      </tr>";
                      }          
                  ?>
              </tbody>
          </table>
      </div>

      <?php include 'partials/_footer1.php';   ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
      $('#myTable').DataTable( {
        'iDisplayLength': 25,
        "aaSorting": [0, "asc"],
      });
      $('#myTable tbody')
        .on( 'mouseenter', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            $( table.cells().nodes() ).removeClass( 'highlight' );
            $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
        } );
      } );
       
    </script>
    <script src="./vendor/dark-light-mode.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>