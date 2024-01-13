<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Takimet e Mia</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php
    include("session-start.php");
    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where doctor_email='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["doctor_id"];
    $username = $userfetch["doctor_name"];
    //echo $userid;
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Dil" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord ">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Grafika Informative</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
                <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
                    <div>
                        <p class="menu-text">Konsultat e Mia</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Seancat e Skeduluara</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Pacientët e Mi</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Cilësime</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="appointment.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Kthehu</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Menaxhimi i Takimeve</p>

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Data Sot
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php

                        date_default_timezone_set('Europe/Tirane');

                        $today = date('Y-m-d');
                        echo $today;

                        $list110 = $database->query("select * from schedule inner join appointment on schedule.schedule_id=appointment.schedule_id inner join patient on patient.patient_id=appointment.pacient_id inner join doctor on schedule.doctor_id=doctor.doctor_id  where  doctor.doctor_id=$userid ");

                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>


            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">

                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Takimet e Mia (<?php echo $list110->num_rows; ?>)</p>
                </td>

            </tr>
            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0">
                            <tr>
                                <td width="10%">

                                </td>
                                <td width="5%" style="text-align: center;">
                                    Data:
                                </td>
                                <td width="30%">
                                    <form action="" method="post">

                                        <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                                </td>

                                <td width="12%">
                                    <input type="submit" name="filter" value=" Filter" class=" btn-primary-soft btn button-icon btn-filter" style="padding: 15px; margin :0;width:100%">
                                    </form>
                                </td>

                            </tr>
                        </table>

                    </center>
                </td>

            </tr>

            <?php


            $sqlmain = "select appointment.appointment_id,schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_number,appointment.appointment_date from schedule inner join appointment on schedule.schedule_id=appointment.schedule_id inner join patient on patient.patient_id=appointment.pacient_id inner join doctor on schedule.doctor_id=doctor.doctor_id  where  doctor.doctor_id=$userid ";

            if ($_POST) {
                //print_r($_POST);

                if (!empty($_POST["sheduledate"])) {
                    $sheduledate = $_POST["sheduledate"];
                    $sqlmain .= " and schedule.schedule_date='$sheduledate' ";
                };

                //echo $sqlmain;

            }


            ?>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            Emri i Pacientit
                                        </th>
                                        <th class="table-headin">

                                            Numri i Takimit

                                        </th>

                                        <th class="table-headin">


                                            Titulli i Seancës

                                        </th>

                                        <th class="table-headin">

                                            Data & Ora e Seancës

                                        </th>

                                        <th class="table-headin">

                                            Data e Takimit

                                        </th>

                                        <th class="table-headin">

                                            Ngjarjet

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Ne nuk mund të gjenim asgjë në lidhje me fjalët tuaja kyçe!</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaq të gjitha Takimet &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $appointment_id = $row["appointment_id"];
                                            $schedule_id = $row["schedule_id"];
                                            $title_of_schedule = $row["title_of_schedule"];
                                            $doctor_name = $row["doctor_name"];
                                            $schedule_date = $row["schedule_date"];
                                            $schedule_time = $row["schedule_time"];
                                            $patient_name = $row["patient_name"];
                                            $appointment_number = $row["appointment_number"];
                                            $appointment_date = $row["appointment_date"];
                                            echo '<tr >
                                        <td style="font-weight:600;"> &nbsp;' .

                                                substr($patient_name, 0, 25)
                                                . '</td >
                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                        ' . $appointment_number . '
                                        
                                        </td>
                                        <td>
                                        ' . substr($title_of_schedule, 0, 15) . '
                                        </td>
                                        <td style="text-align:center;;">
                                            ' . substr($schedule_date, 0, 10) . ' @' . substr($schedule_time, 0, 5) . '
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            ' . $appointment_date . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                       <a href="?action=drop&id=' . $appointment_id . '&name=' . $patient_name . '&session=' . $title_of_schedule . '&appointment_number=' . $appointment_number . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Anullo</font></button></a>
                                       &nbsp;&nbsp;&nbsp;</div>
                                        </td>
                                    </tr>';
                                        }
                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </center>
                </td>
            </tr>



        </table>
    </div>
    </div>
    <?php

    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
         if ($action == 'drop') {
            $nameget = $_GET["name"];
            $session = $_GET["session"];
            $appointment_number = $_GET["appointment_number"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>A je i sigurt?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            Ju dëshironi ta fshini këtë rekord<br><br>
                            Emri i Pacientit: &nbsp;<b>' . substr($nameget, 0, 40) . '</b><br>
                            Numri Takimit&nbsp; : <b>' . substr($appointment_number, 0, 40) . '</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="../admin/delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Po&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;Jo&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } 
     
    }

    ?>
    </div>
<?php
include("../footer.html")
?>
</body>

</html>