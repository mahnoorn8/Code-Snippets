<?php
    $conn = mysqli_connect("localhost","root","") or die ("could not connect");
    mysqli_select_db($conn, "sp500") or die ("could not find db");
    $output = "";

    if(isset($_POST['search'])){
        $searchq = $_POST['search'];

        $query = mysqli_query($conn, "SELECT * FROM test_sp WHERE name LIKE '%$searchq%' OR symbol LIKE '%$searchq%'") or die("could not search");
        $count = mysqli_num_rows($query);
        if($count == 0) {
            $output = "There was no search results";
        }else{
            while($row = mysqli_fetch_array($query)) {
                $name = $row['name'];
                $symbol = $row['symbol'];
                
                $output .= '<div>'.$name.' '.$symbol.'</div>';
            }
        }
    }

?>


<!DOCTYPE html>
<html>
<body>

<form action= "index.php" method="post">
        <input type="text" name="search" placeholder= "search"/>
        <input type = "submit" value=">>"/>
</form>

<?php print("$output");?>


</body>
</html>
