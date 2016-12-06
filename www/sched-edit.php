<!DOCTYPE HTML>  
<html>
<head>
<style>
.fixedsmall {font-family: courier; color: black; font-size: xx-small;}
label {
  display: block;
  padding-left: 15px;
  text-indent: -15px;
}
input {
  width: 13px;
  height: 13px;
  padding: 0;
  margin:0;
  vertical-align: bottom;
  position: relative;
  top: -1px;
  *overflow: hidden;
}
</style>
</head>
<body class='fixedsmall'>  

<?php
$servername = "localhost";
$username = "pi";
$password = "password";
$dbname = "pi_heating_db";
$SCHED_ID = '1';
    
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
$sql = "SELECT * FROM schedules WHERE id=".$SCHED_ID;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo var_dump($row)."<br>";
    }
    } else {
        echo "0 results"; 
    }

echo '<br><br>';
    
echo '<form action="checkbox-form.php" method="post">';
 
echo 'Repeat every :<br />';
echo '<label><input type="checkbox" name="formDoor[]" value="1" checked="checked" />Mon</label>';
echo '<label><input type="checkbox" name="formDoor[]" value="2" />Tue</label>';
echo '<label><input type="checkbox" name="formDoor[]" value="3" />Wed</label>';
echo '<label><input type="checkbox" name="formDoor[]" value="4" />Thu</label>';
echo '<label><input type="checkbox" name="formDoor[]" value="5" />Fri</label>';
echo '<label><input type="checkbox" name="formDoor[]" value="6" />Sat</label>';
echo '<label><input type="checkbox" name="formDoor[]" value="7" />Sun</label>';

echo '<br><br>';

echo '<input type="submit" name="formSubmit" value="Submit" />';
 
echo '</form>';

echo '<br><br>';
    
$sql = "SELECT * FROM devices LEFT JOIN sched_device ON devices.id=sched_device.device_id AND sched_device.sched_id=".$SCHED_ID.";";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo var_dump($row)."<br>";
    }
    } else {
        echo "devices 0 results"; 
    }
echo '<br><br>';
      
$sql = "SELECT * FROM sensors;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo var_dump($row)."<br>";
    }
    } else {
        echo "sensors 0 results"; 
    }
echo '<br><br>';
      
$sql = "SELECT * FROM sensors LEFT JOIN sched_sensor ON sensors.id=sched_sensor.sensor_id AND sched_sensor.sched_id=".$SCHED_ID.";";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo var_dump($row)."<br>";
    }
    } else {
        echo "sensors LEFT JOIN sched_sensor 0 results"; 
    }
echo '<br><br>';

$sql = "SELECT * FROM modes LEFT JOIN sched_mode ON modes.id=sched_mode.mode_id AND sched_mode.sched_id=".$SCHED_ID.";";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo var_dump($row)."<br>";
    }
    } else {
        echo "modes LEFT JOIN sched_mode 0 results"; 
    }
echo '<br><br>';
      
$sql = "SELECT * FROM timers LEFT JOIN sched_timer ON timers.id=sched_timer.timer_id AND sched_timer.sched_id=".$SCHED_ID.";";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo var_dump($row)."<br>";
    }
    } else {
        echo "timers LEFT JOIN sched_timer 0 results"; 
    }
echo '<br><br>';
      
     
    
    
mysqli_close($conn);
?>


</body>
</html>
