<?php
session_start();
include("db.php");
if($_SESSION["username"]!="admin"){
    header("location:index.php");
}
include("db.php");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) FROM family";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $family_id = $row["COUNT(*)"]+1;
    }
} else {
    echo "Something went wrong, please refresh";
}
$conn->close();

if(isset($_REQUEST["family_id"])){
    $family_id = $_REQUEST["family_id"];
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
                <a class="navbar-brand" href="#">GSB Seva Mandal</a>
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
        <h3>
            <div class="row">
                <div class="col-xs-10">
                    Family Id : <?=$family_id?>
                </div>
                <?php
                if(isset($_REQUEST["family_id"])){ ?>
                    <div class="col-xs-2">
                        <div class="pull-right">
                            <button class="btn btn-danger" onclick="location.href ='input_member.php?deletefamilyid=<?=$family_id?>'">Delete Family</button>
                        </div>
                    </div>
                <?php
                }
                else{ ?>
                    <div class="col-xs-2">
                        <div class="pull-right">
                            <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Main Member</button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </h3>
        <?php
        if(isset($_REQUEST["family_id"])) {
            ?>
            <div class="">
                <?php
                $sql1 = "SELECT * FROM family, member WHERE family.id=member.family_id AND family.id = ".$_REQUEST['family_id'];
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $result1 = $conn->query($sql1);
                if ($result->num_rows > 0) { ?>
                    <b> Address :</b >
                    <?php
                    while ($row1 = $result1->fetch_assoc()) {
                        $sql = "SELECT * FROM address WHERE address.member_id = " . $row1['member_id'];
                        $result = $conn->query($sql); ?>
                        <?php
                        while ($row = $result->fetch_assoc()) { ?>
                            <?= $row['room_no'] ?> <?= $row['wing'] ?> <?= $row['building_name'] ?> <?= $row['area_name'] ?> <?= $row['street_name'] ?> <?= $row['city_name'] ?> <?= $row['west_east'] ?><br>
                            <?php
                        }
                    }
                }


                $sql = "SELECT DISTINCT  kuldev FROM `member` WHERE family_id='".$_REQUEST["family_id"]."' AND is_delete is NULL";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) { ?>
                    <b>Kuldevta :</b>
                    <?php
                    while($row = $result->fetch_assoc()) { ?>
                        <?=$row['kuldev']?>
                        <?php
                    }
                    echo "<br>";
                }
                $sql = "SELECT DISTINCT  Math FROM `member` WHERE family_id='".$_REQUEST["family_id"]."' AND is_delete is NULL";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0)  { ?>
                    <b>Math :</b>
                    <?php
                    while($row = $result->fetch_assoc()) { ?>
                        <?=$row['Math']?> Math
                        <?php
                    }
                    echo "<br>";
                }
                $sql = "SELECT DISTINCT  Gotra FROM `member` WHERE family_id='".$_REQUEST["family_id"]."' AND is_delete is NULL";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0)  { ?>
                    <b>Gotra :</b>
                    <?php
                    while($row = $result->fetch_assoc()) { ?>
                        <?=$row['Gotra']?>
                        <?php
                    }
                    echo "<br>";
                }
                $sql = "SELECT DISTINCT  nativeplace FROM `member` WHERE family_id='".$_REQUEST["family_id"]."' AND is_delete is NULL";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) { ?>
                    <b>Native Place :</b>
                    <?php
                    while($row = $result->fetch_assoc()) { ?>
                        <?=$row['nativeplace']?>
                        <?php
                    }
                    echo "<br>";
                }
                echo "<hr>";
                $sql = "SELECT * FROM `member` WHERE family_id='".$_REQUEST["family_id"]."' AND is_delete is NULL";
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
                        <th>Id</th>
                        <th>Name</th>
                        <th>Fathers Name</th>
                        <th>Mothers Name</th>
                        <th>Sex</th>
                        <th>Profession</th>
                        <th>Study</th>
                        <th>School/College Name</th>
                        <th>Nakshatra</th>
                        <th>Blood Group</th>
                        <th>Phone</th>
                        <th>Other Details</th>
                        <th>Add Phone</th>
                        <th>Add Address</th>
                        <th>Add Related Member</th>
                    </tr>
                    </thead>
                    <tbody class="searchable">
                    <?php
                    // output data of each row
                    while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?=$row["member_id"]?></td>
                                <td><?=$row["Name"]?></td>
                                <td><?=$row["fathers_name"]?></td>
                                <td><?=$row["mothers_name"]?></td>
                                <td><?=$row["gender"]?></td>
                                <td><?=$row["Profession"]?></td>
                                <td><?=$row["Studying"]?></td>
                                <td><?=$row["College/School Name"]?></td>
                                <td><?=$row["Nakshatra"]?></td>
                                <td><?=$row["bloodgroup"]?></td>
                                <?php 
                                $sql2 = "Select * from phone WHERE home_office = 1 AND member_id=".$row['member_id'];
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) { ?>
                                    <td>
                                    <?php
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                        <?= $row2["phone_no"] ?> 
                                    <?php } ?>
                                    </td>
                                <?php }else{
                                    echo "<td></td>";
                                } ?>
                                <td><?=$row["other_details"]?></td>
                                <td><button onclick="addphone(<?=$row['member_id']?>, '<?=$row['Name']?>')" class="btn btn-default">Add</button></td>
                                <td><button onclick="addaddress(<?=$row['member_id']?>, '<?=$row['Name']?>')" class="btn btn-default">Add</button></td>
                                <td><button onclick="addmember(<?=$row['member_id']?>, '<?=$row['Name']?>')" class="btn btn-default">Add</button></td>
                            </tr>
                        <?php
                    } ?>
                    </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
<?php if(file_exists ( "../ads.php" )){ ?>
    <div class="container" style="height: 200px">
        <?php include("../ads.php"); ?>
    </div>
<?php } ?>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
        <form method="post" action="input_member.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Main Member</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Name:</label>
                    <input type="text" class="form-control" required name="name">
                </div>
                <div class="form-group">
                    <label for="pwd">Gender:</label>
                    <select name="gender" class="">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Fathers Name:</label>
                    <input type="text" class="form-control" required name="fathers_name">
                </div>
                <div class="form-group">
                    <label for="pwd">Mothers Name:</label>
                    <input type="text" class="form-control" required name="mothers_name">
                </div>
                <div class="form-group">
                    <label for="pwd">Profession:</label>
                    <input type="text" class="form-control" required name="profession">
                </div>
                <div class="form-group">
                    <label for="pwd">Math:</label>
                    <!--<input type="text" class="form-control" required name="math">-->
                    <select class="form-control" required name="math">
                        <option selected disabled>--Selected--</option>
                        <option value="Kashi">Kashi Math</option>
                        <option value="Gokarn">Gokarn Math</option>
                        <option value="Kavale">Kavale Math</option>
                        <option value="Chitrapur">Chitrapur Math</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Native Place:</label>
                    <input type="text" class="form-control" required name="nativeplace">
                </div><div class="form-group">
                    <label for="pwd">Email Id:</label>
                    <input type="text" class="form-control" required name="email_id">
                </div>
                <div class="form-group">
                    <label for="pwd">Study:</label>
                    <input type="text" class="form-control" required name="studying_in">
                </div>
                <div class="form-group">
                    <label for="pwd">School/College Name:</label>
                    <input type="text" class="form-control" required name="school_college_name">
                </div>
                <div class="form-group">
                    <label for="pwd">Gotra:</label>
                    <input type="text" class="form-control" required name="gotra">
                </div>
                <div class="form-group">
                    <label for="pwd">Date of Birth:</label>
                     <select name="day" class="">
                        <?php for($i=1; $i<32; $i++) { ?> 
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php } ?>
                    </select>
                    <select name="month" class="">
                        <?php for($i=1; $i<13; $i++) { ?> 
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php } ?>
                    </select>
                    <select name="year" class="">
                        <?php for($i=1930; $i<date("Y"); $i++) { ?>
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Blood Group:</label>
                    <!--<input type="text" class="form-control" required name="bloodgroup">-->
                    <select  class="form-control" required name="bloodgroup">
                        <option value="-">
                            -
                        </option>
                        <option value="A+">
                            A+
                        </option>
                        <option value="A-">
                            A-
                        </option>
                        <option value="B+">
                            B+
                        </option>
                        <option value="B-">
                            B-
                        </option>
                        <option value="AB+">
                            AB+
                        </option>
                        <option value="AB-">
                            AB-
                        </option>
                        <option value="O+">
                            O+
                        </option>
                        <option value="O-">
                            O-
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Nakshatra:</label>
                    <input type="text" class="form-control" required name="nakshatra">
                </div>
                <div class="form-group hidden">
                    <label for="pwd">family_id:</label>
                    <input type="text" class="form-control" required name="family_id" value="<?=$family_id?>">
                </div>
                <div class="form-group">
                    <label for="pwd">Kuldev:</label>
                    <input type="text" class="form-control" required name="kuldev">
                </div>
                <div class="form-group">
                    <label for="pwd">Membership Id:</label>
                    <input type="text" class="form-control" required name="membership_id">
                </div>
                <div class="form-group">
                    <label for="pwd">Other Details:</label>
                    <input type="text" class="form-control" required name="other_details">
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Save" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="input_member.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Other Member</h4>
                </div>
                <input id="existingmemberid" name="existingmemberid" value="" type="text" class="hidden" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pwd" id="relationshipto">Relation:</label>
                        <select name="relationto" class="">
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                            <option value="Husband">Husband</option>
                            <option value="Wife">Wife</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                            <option value="Brother">Brother</option>
                            <option value="Sister">Sister</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Name:</label>
                        <input type="text" class="form-control" required name="othername">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Gender:</label>
                        <select name="gender" class="">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Fathers Name:</label>
                        <input type="text" class="form-control" required name="otherfathers_name">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mothers Name:</label>
                        <input type="text" class="form-control" required name="mothers_name">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Profession:</label>
                        <input type="text" class="form-control" required name="profession">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Math:</label>
                        <!--<input type="text" class="form-control" required name="professional_addr">-->
                        <select class="form-control" required name="math">
                            <option selected disabled>--Selected--</option>
                            <option value="Kashi">Kashi Math</option>
                            <option value="Gokarn">Gokarn Math</option>
                            <option value="Kavale">Kavale Math</option>
                            <option value="Chitrapur">Chitrapur Math</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Native Place:</label>
                        <input type="text" class="form-control" required name="nativeplace">
                    </div><div class="form-group">
                        <label for="pwd">Email Id:</label>
                        <input type="text" class="form-control" required name="email_id">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Study:</label>
                        <input type="text" class="form-control" required name="studying_in">
                    </div>
                    <div class="form-group">
                        <label for="pwd">School/College Name:</label>
                        <input type="text" class="form-control" required name="school_college_name">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Gotra:</label>
                        <input type="text" class="form-control" required name="gotra">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Date of Birth:</label>
                        <select name="day" class="">
                            <?php for($i=1; $i<32; $i++) { ?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?php } ?>
                        </select>
                        <select name="month" class="">
                            <?php for($i=1; $i<13; $i++) { ?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?php } ?>
                        </select>
                        <select name="year" class="">
                            <?php for($i=1930; $i<date("Y"); $i++) { ?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Blood Group:</label>
                        <!--<input type="text" class="form-control" required name="bloodgroup">-->
                        <select  class="form-control" required name="bloodgroup">
                            <option value="-">
                                -
                            </option>
                            <option value="A+">
                                A+
                            </option>
                            <option value="A-">
                                A-
                            </option>
                            <option value="B+">
                                B+
                            </option>
                            <option value="B-">
                                B-
                            </option>
                            <option value="AB+">
                                AB+
                            </option>
                            <option value="AB-">
                                AB-
                            </option>
                            <option value="O+">
                                O+
                            </option>
                            <option value="O-">
                                O-
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Nakshatra:</label>
                        <input type="text" class="form-control" required name="nakshatra">
                    </div>
                    <div class="form-group hidden">
                        <label for="pwd">family_id:</label>
                        <input type="text" class="form-control" required name="family_id" value="<?=$family_id?>">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Kuldev:</label>
                        <input type="text" class="form-control" required name="kuldev">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Membership Id:</label>
                        <input type="text" class="form-control" required name="membership_id">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Other Details:</label>
                        <input type="text" class="form-control" required name="other_details">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="myModal3" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="input_member.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Phone No. of Member</h4>
                </div>
                <input id="existingmemberidforphone" name="existingmemberid" value="" type="text" class="hidden" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="address">Phone Number:</label>
                        <input type="text" class="form-control" name="phone_mobile" required>
                    </div>
                    <div class="form-group">
                        <label for="home_business">Personal/Professional:</label>
                        <select name="home_business" class="form-control" required>
                            <option value="1">Personal</option>
                            <option value="2">Professional</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="myModal4" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="input_member.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Address of Member</h4>
                </div>
                <input id="existingmemberidforaddress" name="existingmemberid" value="" type="text" class="hidden" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="address">Room No:</label>
                        <input type="text" class="form-control" name="room_no" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Wing:</label>
                        <input type="text" class="form-control" name="wing" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Building Name:</label>
                        <input type="text" class="form-control" name="buildingname" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Area/Locality:</label>
                        <input type="text" class="form-control" name="area_name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Street Name:</label>
                        <input type="text" class="form-control" name="street_name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">City:</label>
                        <input type="text" class="form-control" name="city_name" value="Virar" required>
                    </div>
                    <div class="form-group">
                        <label for="address">East/West:</label>
                        <select class="form-control" name="east_west">
                            <option value="West">West</option>
                            <option value="East">East</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Taluka:</label>
                        <input type="text" class="form-control" name="taluka" value="Vasai" required>
                    </div>
                    <div class="form-group">
                        <label for="address">District:</label>
                        <input type="text" class="form-control" name="district" value="Palghar" required>
                    </div>
                    <div class="form-group">
                        <label for="address">State:</label>
                        <input type="text" class="form-control" name="state" value="Mahrashtra" required>
                    </div>
                    <div class="form-group">
                        <label for="home_business">Home/Office:</label>
                        <select name="home_office" class="form-control" required>
                            <option value="1">Home</option>
                            <option value="2">Office</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {

    (function ($) {

    $('#filter').keyup(function () {

    var rex = new RegExp($(this).val(), 'i');
    $('.searchable tr').hide();
    $('.searchable tr').filter(function () {
    return rex.test($(this).text());
    }).show();

    })

    }(jQuery));

    });


    function addmember(id, name){
        document.getElementById("relationshipto").innerText = name + " is his/her : ";
        document.getElementById("existingmemberid").value=id;
        $("#myModal2").modal();
    }
    function addphone(id, name){
        document.getElementById("existingmemberidforphone").value=id;
        $("#myModal3").modal();
    }
    function addaddress(id, name){
        document.getElementById("existingmemberidforaddress").value=id;
        $("#myModal4").modal();
    }
</script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
</body>
</html>
