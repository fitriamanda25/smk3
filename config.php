<? 
    session_start();
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "kintispanel";
    $conn = mysql_connect($db_host, $db_username, $db_password) or die(mysql_error());
    $db = mysql_select_db($db_name, $conn) or die(mysql_error());
    
    //Connect and select the database
    $db1 = new mysqli($db_host, $db_username, $db_password, $db_name);
    
    if ($db1->connect_error) {
        die("Connection failed: " . $db1->connect_error);
    }
?>
