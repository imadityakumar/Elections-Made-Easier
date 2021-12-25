<?php
session_start();

if (!isset($_SESSION['userdata'])) {
    header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if ($_SESSION['userdata']['status'] == 0) {
    $status = '<b style="color:#ff1217"> Not Voted </b>';
} else {
    $status = '<b style="color:green"> Voted </b>';
}

?>


<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css" </head>

<body>

    <style>
        #backbtn 
        {
            padding: 5px;
            font-size: 15px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            float: left;
            margin:15px;
        }

        #logoutbtn 
        {
            padding: 5px;
            font-size: 15px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            float: right;
            margin:15px;
        }

        #profile 
        {
            padding: 20px;
            background-color: white;
            width: 30%;
            float: left;
        }

        #Group
        {
            background-color: white;
            padding: 20px;
            width: 60%;
            float: right;
        }

        #votebtn 
        {
            padding: 5px;
            font-size: 15px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            float: center;

        }

        #mainpanel 
        {
            padding: 13px;
        }

        #voted
        {
            padding: 5px;
            font-size: 15px;
            background-color: green;
            color: white;
            border-radius: 5px;
            float: left;
        }

    </style>

    <div id="mainSection">
        <div id="headerSection">
        <a href="../">     <button id="backbtn">  Back</button></a>
            <a href="logout.php">     <button id="logoutbtn">Logout</button></a>
            <h1>Elections Made Easier</h1>
        </div>

        <hr>

        <div id="mainpanel">

            <div id="Profile" style="text-align:left">
                <center> <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="200"> </center>
                <br><br><br>
                <b>Name:</b> <?php echo $userdata['name'] ?> <br><br>
                <b>Mobile:</b> <?php echo $userdata['mobile'] ?> <br><br>
                <b>Address:</b> <?php echo $userdata['address'] ?> <br><br>
                <b>Status:</b> <?php echo $status ?>
                <br><br>
            </div>

            <div id="Group">
                <?php
                if ($_SESSION['groupsdata']) 
                {
                    for ($i = 0; $i < count($groupsdata); $i++) 
                    {
                        ?>
                        <div>
                            <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="200">
                            <br><br>
                            <div style="float:left;"> <b>Group Name: </b><?php echo $groupsdata[$i]['name'] ?>
                            </div>
                            <br><br>
                            <div style="float:left;">
                                <b>Votes: </b><?php echo $groupsdata[$i]['votes'] ?>
                            </div>
                            <br><br>
                            <form action="../api/vote.php" method="POST">
                                <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                                <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>" >

                                <?php
                                if($_SESSION['userdata']['status']==0)
                                {
                                    ?>

                                    <input style="float:left;" type="submit" name="votebtn" value="Vote" id="votebtn">
                                    <?php
                                }

                                else
                                {
                                    ?>
                                    <button type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                    <?php
                                }
                            ?>
                            </form>

                        </div>

                        <br>
                        <hr><br>

                        <?php
                    }
                }
                ?>
            
            </div>
        </div>
        
    </div>

</body>

</html>