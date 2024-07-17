<html>

<head>
    <style type="text/css">

        body{
            margin: 0px;
           
        }
        .h1{
            color: #000000;
            font-family: "sans-serif";
            font-size: 190%;
            }
    .p  {
        color: #000000;
        font-family: "sans-serif";
        }
    
    .p2 {
        color: #000;
        font-family: "sans-serif";
        font-size: 150%;
        }

        .p3 {
        color: #000;
        font-family: "sans-serif";
        font-size: 220%;
        }
    
    .button {
            background-color: #ffd64f;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 50px;
            font-size: 25px;
            text-align: center;
            }
    
    .lc {
            color: #fff;
            background-color: transparent;
            text-decoration: none;
            font-size: 120%;
        }
    
        .navbar {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #867f7f;
            padding: 1.5%;
            color: #323232;
            list-style-type: none;
            margin: 0;
            margin-left: auto;
            width: 100%;
        }
        

    </style>
        <div class="navbar">
            <table style width="100%" border="0">
                <tr> <!-- row 1 --> 
                    <th><h1 class="p" align="center">Welcome, Admin.</p> </h1>
                </tr>
            </table>
        </div>
        
        
</head>

<body>

    <p>&nbsp;</p>
    <h3 class="h1" align="left">Response from customer :</h3>
  
<?php
// Step 1: Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corporate";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 4: Handle Delete Request
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    // Perform deletion
    $delete_sql = "DELETE FROM contact WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Step 2: Query the database
$sql = "SELECT name, phonenum, email, message FROM contact";
$result = $conn->query($sql);

// Step 3: Display data in an HTML table with delete button
if ($result->num_rows > 0) {
    echo "<table border='2'>";
    echo "<tr><th>Name</th><th>Phone Number</th><th>Email</th><th>Message</th><th>Action</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["phonenum"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["message"] . "</td>";
        echo "<td>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='delete_id' value='" . $row["name"] . "'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Step 5: Close the connection
$conn->close();
?>

&nbsp;&nbsp;    
<div align="center">
        <br>
        <br>
        <br>
        <button id="button" type="submit" value="send" class="send_btn"><a href="index.php">Log Out</a></button>
    </div>


</body>

<footer>
</footer>