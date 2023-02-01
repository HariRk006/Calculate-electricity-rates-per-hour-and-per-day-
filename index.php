<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Calculate electricity rates per Hour and per Day</title>
</head>
<body>
  <div class="container mt-5">
    <h1 style="font-family:Helvetica; font-weight:800;" class="text-center">Calculate electricity rates per hour and per day</h1>
    <br>
    <br>
    <form action="" method="post">
      <div class="form-group">
        <label for="current">Current (A):</label>
        <input type="text" class="form-control" id="current" name="current" required>
      </div>
      <div class="form-group">
        <label for="voltage">Voltage (V):</label>
        <input type="text" class="form-control" id="voltage" name="voltage" required>
      </div>
      <div class="form-group">
        <label for="rate">Rate (sen/kWh):</label>
        <input type="text" class="form-control" id="rate" name="rate" required>
      </div>
      <center><button type="submit" class="btn btn-primary">Calculate</button></center>
      <br>
      
    </form>


    <?php
	
      // form submission
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
		
        // calculate power function
        function calculatePower($current, $voltage) {
          return $current * $voltage;
        }


        // calculate energy function
        function calculateEnergy($power, $time) {

			
          return ($power * $time) / 1000;
        }

        // calculate total charge function
        function calculateTotalCharge($energy, $rate) {
          return $energy * ($rate/100);
        }

        $current = floatval($_POST["current"]);
        $voltage = floatval($_POST["voltage"]);
        $rate = floatval($_POST["rate"]);

		   // Calculate power
		  $power = calculatePower($current, $voltage);
      

      
      //output of one hour
      echo "<font color='blue';>"."POWER :". $power/1000 ." kW"."<br>". "RATE  :" . $rate / 100 . " sen"."</font>";

        
        echo '<table class="table mt-5">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Hours</th>';
        echo '<th>Energy (kWh)</th>';
        echo '<th>Total Charge (RM)</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        for ($time = 1; $time <= 24; $time++) {
          $energy = calculateEnergy($power, $time);
          $charge = calculateTotalCharge($energy, $rate);
          echo '<tr>';
          echo '<td>' . $time . '</td>';
          echo '<td>' . $energy . '</td>';
          echo '<td>' . number_format((float) $charge,2,'.','') . '</td>';
          echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
      }

	?>
  </div>
</body>
</html>