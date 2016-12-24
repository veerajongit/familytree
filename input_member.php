<?php
session_start();
if($_SESSION["username"]!="admin"){
    header("location:index.php");
}
function insert($sql){
    $servername = NULL;
    $username = NULL;
    $password = NULL;
    $dbname = NULL;
    include("db.php");
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


if(isset($_REQUEST["name"]) && isset($_REQUEST["fathers_name"]) && isset($_REQUEST["mothers_name"])
    && isset($_REQUEST["profession"]) && isset($_REQUEST["math"]) && isset($_REQUEST["gotra"])
    && isset($_REQUEST["day"]) && isset($_REQUEST["month"]) && isset($_REQUEST["year"])
    && isset($_REQUEST["nakshatra"]) && isset($_REQUEST["family_id"]) && isset($_REQUEST["kuldev"])
    && isset($_REQUEST["membership_id"]) && isset($_REQUEST["bloodgroup"]) && isset($_REQUEST["other_details"]) ){
    $sql1 = "INSERT INTO `gsbfamily`.`family` (`id`, `creation_date`, `is_delete`) VALUES
    ('".$_REQUEST["family_id"]."', CURRENT_TIMESTAMP, NULL);";

    $sql2 = "
        INSERT INTO `gsbfamily`.`member` (`member_id`, `Name`, `fathers_name`, `mothers_name`,
        `Profession`, `Math`, `Studying`, `College/School Name`, `Gotra`, `Date of birth`,
        `Nakshatra`, `family_id`, `bloodgroup`, `other_details`, `creation_date`, `updation_date`, `is_delete`,
        `kuldev`, `membership_id`, `gender`, `nativeplace`, `email`) VALUES
        (NULL, '".$_REQUEST["name"]."', '".$_REQUEST["fathers_name"]."', '".$_REQUEST["mothers_name"]."', '".$_REQUEST["profession"]."'
        , '".$_REQUEST["math"]."','".$_REQUEST["studying_in"]."', '".$_REQUEST["school_college_name"]."', '".$_REQUEST["gotra"]."', '".$_REQUEST["day"]."-".$_REQUEST["month"]."-".$_REQUEST["year"]."',
        '".$_REQUEST["nakshatra"]."', '".$_REQUEST["family_id"]."', '".$_REQUEST["bloodgroup"]."', '".$_REQUEST["other_details"]."',
          CURRENT_TIMESTAMP, '0000-00-00 00:00:00', NULL, '".$_REQUEST["kuldev"]."', '".$_REQUEST["membership_id"]."', '".$_REQUEST["gender"]."', '".$_REQUEST["nativeplace"]."', '".$_REQUEST["email_id"]."');
    ";

    if(insert($sql1)){
        if(insert($sql2)){
            header("location: family.php?family_id=".$_REQUEST["family_id"]);
        }
    }


}


if(isset($_REQUEST["othername"]) && isset($_REQUEST["otherfathers_name"]) && isset($_REQUEST["mothers_name"])
    && isset($_REQUEST["profession"]) && isset($_REQUEST["math"]) && isset($_REQUEST["gotra"])
    && isset($_REQUEST["day"]) && isset($_REQUEST["month"]) && isset($_REQUEST["year"])
    && isset($_REQUEST["nakshatra"]) && isset($_REQUEST["family_id"]) && isset($_REQUEST["kuldev"])
    && isset($_REQUEST["membership_id"]) && isset($_REQUEST["bloodgroup"]) && isset($_REQUEST["other_details"]) ){
    $sql1 = "INSERT INTO `gsbfamily`.`family` (`id`, `creation_date`, `is_delete`) VALUES
    ('".$_REQUEST["family_id"]."', CURRENT_TIMESTAMP, NULL);";

    //print_r($_REQUEST);
    echo "<br>";

    $sql2 = "
        INSERT INTO `gsbfamily`.`member` (`member_id`, `Name`, `fathers_name`, `mothers_name`,
        `Profession`, `Math`, `Studying`, `College/School Name`, `Gotra`, `Date of birth`,
        `Nakshatra`, `family_id`, `bloodgroup`, `other_details`, `creation_date`, `updation_date`, `is_delete`,
        `fathers_id`, `mothers_id`, `husbands_id`, `wifes_id`, `brothers_id`, `sisters_id`, `sons_id`, `daughters_id`, `others_id`, `kuldev`, `membership_id`, `gender`, `nativeplace`, `email`) VALUES
        (NULL, '".$_REQUEST["othername"]."', '".$_REQUEST["otherfathers_name"]."', '".$_REQUEST["mothers_name"]."', '".$_REQUEST["profession"]."'
        , '".$_REQUEST["math"]."', '".$_REQUEST["studying_in"]."', '".$_REQUEST["school_college_name"]."', '".$_REQUEST["gotra"]."', '".$_REQUEST["day"]."-".$_REQUEST["month"]."-".$_REQUEST["year"]."',
        '".$_REQUEST["nakshatra"]."', '".$_REQUEST["family_id"]."', '".$_REQUEST["bloodgroup"]."', '".$_REQUEST["other_details"]."',
          CURRENT_TIMESTAMP, '0000-00-00 00:00:00', NULL, ";



    if($_REQUEST["relationto"] == "Father"){
        $sql2 = $sql2."'".$_REQUEST["existingmemberid"]."', NULL, NULL, NULL,
         NULL, NULL, NULL, NULL, NULL";
    }
    if($_REQUEST["relationto"] == "Mother"){
        $sql2 = $sql2."NULL, '".$_REQUEST["existingmemberid"]."', NULL, NULL,
         NULL, NULL, NULL, NULL, NULL";
    }
    if($_REQUEST["relationto"] == "Husband"){
        $sql2 = $sql2."NULL, NULL, '".$_REQUEST["existingmemberid"]."', NULL,
         NULL, NULL, NULL, NULL, NULL";
    }
    if($_REQUEST["relationto"] == "Wife"){
        $sql2 = $sql2."NULL, NULL, NULL, '".$_REQUEST["existingmemberid"]."',
         NULL, NULL, NULL, NULL, NULL";
    }
    if($_REQUEST["relationto"] == "Son"){
        $sql2 = $sql2."NULL, NULL, NULL, NULL,
         NULL, NULL, '".$_REQUEST["existingmemberid"]."', NULL, NULL";
    }
    if($_REQUEST["relationto"] == "Daughter"){
        $sql2 = $sql2."NULL, NULL, NULL, NULL,
         NULL, NULL, NULL, '".$_REQUEST["existingmemberid"]."', NULL";
    }
    if($_REQUEST["relationto"] == "Brother"){
        $sql2 = $sql2."NULL, NULL, NULL, NULL,
         '".$_REQUEST["existingmemberid"]."', NULL, NULL, NULL, NULL";
    }
    if($_REQUEST["relationto"] == "Sister"){
        $sql2 = $sql2."NULL, NULL, NULL, NULL,
         NULL, '".$_REQUEST["existingmemberid"]."', NULL, NULL, NULL";
    }
    if($_REQUEST["relationto"] == "Other"){
        $sql2 = $sql2."NULL, NULL, NULL, NULL,
         NULL, NULL, NULL, NULL, '".$_REQUEST["existingmemberid"]."'";
    }

    $sql2 = $sql2.", '".$_REQUEST["kuldev"]."', '".$_REQUEST["membership_id"]."', '".$_REQUEST["gender"]."', '".$_REQUEST["nativeplace"]."', '".$_REQUEST["email_id"]."');
    ";

    if(insert($sql2)){
       header("location: family.php?family_id=".$_REQUEST["family_id"]);
    }


}


if(isset($_REQUEST["home_business"]) && isset($_REQUEST['address']) && isset($_REQUEST['existingmemberid'])){
    //$sql = 'INSERT INTO `address` ()';
    //insert($sql);
    header("location:membership.php");
}

if(isset($_REQUEST["home_business"]) && isset($_REQUEST['phone_mobile']) && isset($_REQUEST['existingmemberid'])){
    $sql = "INSERT INTO `phone` (phone_no, member_id, home_office) VALUES ('".$_REQUEST['phone_mobile']."', '".$_REQUEST['existingmemberid']."', '".$_REQUEST['home_business']."')";
    insert($sql);
    header("location:membership.php");
}


if(isset($_REQUEST['room_no']) && isset($_REQUEST['wing']) && isset($_REQUEST['buildingname']) && isset($_REQUEST['area_name']) && isset($_REQUEST['street_name']) && isset($_REQUEST['city_name'])){
    $sql = "
    INSERT INTO `address` (room_no, wing, building_name, street_name, area_name, city_name, west_east, taluka, district, state, member_id, home_office) VALUES
    ('".$_REQUEST['room_no']."', '".$_REQUEST['wing']."', '".$_REQUEST['buildingname']."', '".$_REQUEST['street_name']."', '".$_REQUEST['area_name']."', '".$_REQUEST['city_name']."', '".$_REQUEST['east_west']."', '".$_REQUEST['taluka']."', '".$_REQUEST['district']."', '".$_REQUEST['state']."', '".$_REQUEST['existingmemberid']."', '".$_REQUEST['home_office']."')
    ";
    insert($sql);
    header("location:membership.php");
}


if(isset($_REQUEST["deletefamilyid"])){
    $sql = 'UPDATE `gsbfamily`.`family` SET `is_delete` = \'1\' WHERE `family`.`id` ='.$_REQUEST["deletefamilyid"];
    insert($sql);
    header("location:membership.php");
}
?>