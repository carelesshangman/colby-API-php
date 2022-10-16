<!DOCTYPE html>
<html>
<head>
    <title>Read</title>
</head>
<body>
</body>
<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    vertical-align: text-top;
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
</style>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "colby");
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    echo '<table class="styled-table">';
    echo '<thead>';
    echo '<th>ean</th>';
    echo '<th>langTitle</th>';
    echo '<th>vendor</th>';
    echo '<th>productType</th>';
    echo '<th>productID</th>';
    echo '<th>releaseDate</th>';
    echo '<th>announced</th>';
    echo '<th>datumIzida</th>';
    echo '<th>packShot</th>';
    echo '<th>description</th>';
    echo '<th>keyFeatures</th>';
    echo '<th>legals</th>';
    echo '<th>spokenLanguages</th>';
    echo '<th>subtitleLanguages</th>';
    echo '<th>menuLanguages</th>';
    echo '<th>minRequirements</th>';
    echo '<th>recRequirements</th>';
    echo '<th>pegiValue</th>';
    echo '<th>pegiNumber</th>';
    echo '<th>videoURL</th>';
    echo '<th>genre</th>';
    echo '<th>assets</th>';
    echo '<th>srp</th>';
    echo '<th>promotion</th>';
    echo '<th>wholesale</th>';
    echo '</thead>';
    while($row = $result->fetch_assoc()) {
        echo '<td>'.$row["ean"].'</td>';
        echo '<td>'.$row["langTitle"].'</td>';
        echo '<td>'.$row["vendor"].'</td>';
        echo '<td>'.$row["productType"].'</td>';
        echo '<td>'.$row["productID"].'</td>';
        echo '<td>'.$row["releaseDate"].'</td>';
        echo '<td>'.$row["announced"].'</td>';
        echo '<td>'.$row["datumIzida"].'</td>';
        echo '<td>'.$row["packShot"].'<img src="'.$row["packShot"].'" alt="packShot" width="100px"></td>';
        echo '<td>'.$row["description"].'</td>';
        echo '<td>'.$row["keyFeatures"].'</td>';
        echo '<td>'.$row["legals"].'</td>';
        echo '<td>'.$row["spokenLanguages"].'</td>';
        echo '<td>'.$row["subtitleLanguages"].'</td>';
        echo '<td>'.$row["menuLanguages"].'</td>';
        echo '<td>'.$row["minRequirements"].'</td>';
        echo '<td>'.$row["recRequirements"].'</td>';
        echo '<td>'.$row["pegiValue"].'</td>';
        echo '<td>'.$row["pegiNumber"].'</td>';
        echo '<td>'.$row["videoURL"].'</td>';
        echo '<td>'.$row["genre"].'</td>';
        echo '<td>'.$row["assets"].'</td>';
        echo '<td>'.$row["srp"].'</td>';
        echo '<td>'.$row["promotion"].'</td>';
        echo '<td>'.$row["wholesale"].'</td>';
        echo '</tr>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>

