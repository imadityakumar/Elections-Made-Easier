<?php

session_start();
include("connect.php");

$mobile=$_POST['number'];
$password=$_POST['pwd'];
$role=$_POST['gruptype'];

$check=mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile' AND password='$password' AND role='$role'");

if(mysqli_num_rows($check)>0)
{
    $userdata = mysqli_fetch_array($check);
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
    $groupsdata=mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata']=$userdata;
    $_SESSION['groupsdata']=$groupsdata;

    echo '
    <script>
    window.location = "../routes/dashboard.php";
    </script>
    ';
}

else
{
    print_r($_POST);

    echo '
        <script>
            alert("Invalid credentials or User Not Found!");
            window.location="../";
        </script>
    ';
}

?>