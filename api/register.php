<?php
    include("connect.php");

    $name = $_POST['username'];
    $mobile = $_POST['phonenumber'];
    $password = $_POST['pwd'];
    $cpassword = $_POST['Confirmedpwd'];
    $address = $_POST['gharkapata'];
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name']; 
    $role = $_POST['chunlo'];

    if($password==$cpassword)
    {
        move_uploaded_file($tmp_name, "../uploads/$image");
        $insert = mysqli_query($connect, "INSERT INTO user (name, mobile, password, address, photo, role, status, votes) VALUES ('$name', '$mobile', '$password', '$address', '$image', '$role', 0, 0)");
      
        if($insert)
        {
            echo '
                <script>
                    alert("Registration Successful");
                    window.location="../index.html";
                </script>
            ';
        }

        else
        {
            echo '
                <script>
                    alert("Some error occured!");
                    window.location = "../registration.html"
                </script>
            ';
        }

    }

    else
    {
        echo '
            <script>
                alert("Passwords donot match");
                window.location = "../registration.html";
            </script>
        ';
    }

?>