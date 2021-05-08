<?php 
  session_start();
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/footer1.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/corona_india2.css">
    <title>Corona Cases</title>
    <style>
    
    </style>
</head>
<body>
    
    <?php include 'partials/_navbar.php'; ?>

    <?php
        $data = file_get_contents('https://api.covid19india.org/data.json');
        $coronalive = json_decode($data, true);

        $statescount = count($coronalive['statewise']);
    ?>
    <div class="container my-5" style="max-width: 1100px;">
        <h2 class="my-4" id="white-color">COVID-19 LIVE UPDATES INDIA</h2>
    
        <table id="myTable" class="row-border order-column"  style="width:100%">
            <thead>
                <tr class="table-row">
                    <th>sno</th>
                    <th>Last Updated</th>
                    <th>State</th>
                    <th>Total Confirmed</th>
                    <th>Total Active</th>
                    <th>Total Recovered</th>
                    <th>Total Deaths</th>
                </tr>
            </thead>
            <tbody>
                <?php      
                    $i = 1;
                    while($i < $statescount){
                        echo "<tr>
                            <td>" . $i . "</td>
                            <td>" . $coronalive['statewise'][$i]['lastupdatedtime'] . "</td>
                            <td>" . $coronalive['statewise'][$i]['state'] . "</td>
                            <td>
                            " . $coronalive['statewise'][$i]['confirmed'] . "
                            <sub class='text-orange font-weight-bold' style='font-size: 17px;'>
                            <b>&#8593;</b> ".
                                $coronalive['statewise'][$i]['deltaconfirmed'] 
                            ."</sub>
                            </td>

                            <td>" . $coronalive['statewise'][$i]['active'] . "</td>
                            
                            <td>
                            " . $coronalive['statewise'][$i]['recovered'] . "
                            <sub class='text-success font-weight-bold' style='font-size: 17px;'>
                            &#8593 ".
                                $coronalive['statewise'][$i]['deltarecovered'] 
                            ."</sub>
                            </td>
                            
                            <td>
                            " . $coronalive['statewise'][$i]['deaths'] . "
                            <sub class='text-redorange font-weight-bold' style='font-size: 17px;'>
                            &#8593 ".
                                $coronalive['statewise'][$i]['deltadeaths'] 
                            ."</sub>
                            </td>
                            </tr>";
                        $i++;
                    }            
                    ?>
            </tbody>
        </table>
    </div>

    <?php include 'partials/_footer1.php';   ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="./vendor/dark-light-mode.js">
</script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable({
            'iDisplayLength': 25,
            "aaSorting": [0, "asc"]
        });
      } );
    </script>
</body>
</html>