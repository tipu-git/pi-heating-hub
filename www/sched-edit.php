<!DOCTYPE HTML>  
<html>
<head>
<style>
.fixedsmall {font-family: courier; color: black; font-size: xx-small;}
</style>
</head>
<body class='fixedsmall'>  

<?php
$servername = "localhost";
$username = "pi";
$password = "password";
$dbname = "pi_heating_db";
$SCHED_ID = $_GET['id'];
    
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
$sql = "SELECT * FROM schedules WHERE id=".$SCHED_ID;

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
        echo "0 results"; 
    }
    
$row = mysqli_fetch_assoc($result);

echo 'Title: <input type="text" name="name" value="'.$SCHED_NAME.'"><br><br>';
echo 'Start time: <input type="text" name="start" value="'.$SCHED_START.'"><br>';
echo 'End time: <input type="text" name="end" value="'.$SCHED_END.'"><br>';

$SCHED_DOW1 = $row["dow1"]; if ( $SCHED_DOW1 == '1' ) { $SCHED_DOW1_CHK = 'checked="checked"'; }
$SCHED_DOW2 = $row["dow2"]; if ( $SCHED_DOW2 == '1' ) { $SCHED_DOW2_CHK = 'checked="checked"'; }
$SCHED_DOW3 = $row["dow3"]; if ( $SCHED_DOW3 == '1' ) { $SCHED_DOW3_CHK = 'checked="checked"'; }
$SCHED_DOW4 = $row["dow4"]; if ( $SCHED_DOW4 == '1' ) { $SCHED_DOW4_CHK = 'checked="checked"'; }
$SCHED_DOW5 = $row["dow5"]; if ( $SCHED_DOW5 == '1' ) { $SCHED_DOW5_CHK = 'checked="checked"'; }
$SCHED_DOW6 = $row["dow6"]; if ( $SCHED_DOW6 == '1' ) { $SCHED_DOW6_CHK = 'checked="checked"'; }
$SCHED_DOW7 = $row["dow7"]; if ( $SCHED_DOW7 == '1' ) { $SCHED_DOW7_CHK = 'checked="checked"'; }
    
echo '<br><br>';
echo '<form action="checkbox-form.php" method="post">';
echo 'Repeat every :<br />';
echo "<table><tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>";
echo '<tr>';
echo '<td><input type="checkbox" name="formDoor[]" value="dow1" '.$SCHED_DOW1_CHK.' /></td>';
echo '<td><input type="checkbox" name="formDoor[]" value="dow2" '.$SCHED_DOW2_CHK.' /></td>';
echo '<td><input type="checkbox" name="formDoor[]" value="dow3" '.$SCHED_DOW3_CHK.' /></td>';
echo '<td><input type="checkbox" name="formDoor[]" value="dow4" '.$SCHED_DOW4_CHK.' /></td>';
echo '<td><input type="checkbox" name="formDoor[]" value="dow5" '.$SCHED_DOW5_CHK.' /></td>';
echo '<td><input type="checkbox" name="formDoor[]" value="dow6" '.$SCHED_DOW6_CHK.' /></td>';
echo '<td><input type="checkbox" name="formDoor[]" value="dow7" '.$SCHED_DOW7_CHK.' /></td>';
echo '</tr></table>';
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
