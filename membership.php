<?php
session_start();
if($_SESSION["username"]!="admin"){
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php if(file_exists ( "../assets/js/jquery-1.10.1.min.js" )){ ?>
    <script src="../assets/js/jquery-1.10.1.min.js"></script>
    <?php }else{ ?>
        <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
        <?php
    } ?>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <title>Admin Page : GSB Seva Mandal Virar</title>
    <style>
        body{
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="membership.php">GSB Seva Mandal</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="membership.php">Membership</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="" style="padding-left: 20px; padding-right: 20px">
    <div class="row">
        <div class="col-xs-8">
            <h4>Complete Family & Member Details</h4>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <!-- Trigger the modal with a button -->
                <a class="btn btn-info" href="family.php">Add Family</a>
            </div>
        </div>
    </div>
    <hr>
    <?php
    include("db.php");
    $sql = "SELECT * FROM `family` WHERE is_delete is NULL ORDER BY Id DESC";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { ?>
        <table class="table table-striped" id="myTable">
            <thead>
            <tr>
                <th>Member Id</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Profession</th>
                <th>Study</th>
                <th>Blood Group</th>
                <th>Family Page</th>
            </tr>
            </thead>
            <tbody class="searchable">
            <?php
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $sql2 = "SELECT * FROM `member` WHERE family_id='".$row["id"]."' AND is_delete is NULL";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row2 = $result2->fetch_assoc()) { ?>
                        <tr>
                            <td><?=$row2["member_id"]?></td>
                            <td><?=$row2["Name"]?></td>
                            <td><?=$row2["gender"]?></td>
                            <td><?=$row2["Profession"]?></td>
                            <td><?=$row2["Studying"]?></td>
                            <td><?=$row2["bloodgroup"]?></td>
                            <td><button onclick="location.href='family.php?family_id=<?=$row2["family_id"]?>'" class="btn btn-default">Open</button></td>
                        </tr>
                        <?php
                    }
                }
            } ?>
            </tbody>
        </table>
        <?php
    }
    ?>
</div>
<?php if(file_exists ( "../ads.php" )){ ?>
<hr>
<div width="100%">
    <?php include("../ads.php"); ?>
</div>
<?php } ?>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
</body>
</html>