<!DOCTYPE html>
<html lang="en">
<?php
include("header.html");
?>

<body>
    <?php

    include("session-start.php");
    include("../connection.php");
    $sqlmain = "select * from patient where patient_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["patient_id"];
    $username = $userfetch["patient_name"];


    //echo $userid;
    //echo $username;



    $sqlmain = "select appointment.appointment_id,schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_number,appointment.appointment_date from schedule inner join appointment on schedule.schedule_id=appointment.schedule_id inner join patient on patient.patient_id=appointment.pacient_id inner join doctor on schedule.doctor_id=doctor.doctor_id  where  patient.patient_id=$userid ";

    if ($_POST) {
        //print_r($_POST);
        if (!empty($_POST["sheduledate"])) {
            $sheduledate = $_POST["sheduledate"];
            $sqlmain .= " and schedule.schedule_date='$sheduledate' ";
        };
        //echo $sqlmain;
    }

    $sqlmain .= "order by appointment.appointment_date  asc";
    $result = $database->query($sqlmain);
    ?>
    <div class="container">
        <?php
         include("menu.php");
        ?>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="appointment.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Kthehu</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Konsultat e Mia</p>

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


                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>
            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">

                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Konsultat e Mia (<?php echo $result->num_rows; ?>)</p>
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



            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0" style="border:none">

                                <tbody>

                                    <?php




                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nuk mundëm të gjenim asgjë në lidhje me fjalët tuaja kyçe!</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaq të gjitha takimet &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {

                                        for ($x = 0; $x < ($result->num_rows); $x++) {
                                            echo "<tr>";
                                            for ($q = 0; $q < 3; $q++) {
                                                $row = $result->fetch_assoc();
                                                if (!isset($row)) {
                                                    break;
                                                };
                                                $schedule_id = $row["schedule_id"];
                                                $title = $row["title_of_schedule"];
                                                $doctor_name = $row["doctor_name"];
                                                $schedule_date = $row["schedule_date"];
                                                $schedule_time = $row["schedule_time"];
                                                $appointment_number = $row["appointment_number"];
                                                $appointment_date = $row["appointment_date"];
                                                $appointment_id = $row["appointment_id"];

                                                if ($schedule_id == "") {
                                                    break;
                                                }

                                                echo '
                                            <td style="width: 25%;">
                                                    <div  class="dashboard-items search-items"  >
                                                    
                                                        <div style="width:100%;">
                                                        <div class="h3-search">
                                                                    Data e Konsultës: ' . substr($appointment_date, 0, 30) . '<br>
                                                                    Numri i Referencës : OC-000-' . $appointment_id . '
                                                                </div>
                                                                <div class="h1-search">
                                                                    ' . substr($title, 0, 21) . '<br>
                                                                </div>
                                                                <div class="h3-search">
                                                                    Numri i Konsultës:<div class="h1-search">0' . $appointment_number . '</div>
                                                                </div>
                                                                <div class="h3-search">
                                                                    ' . substr($doctor_name, 0, 30) . '
                                                                </div>
                                                                
                                                                
                                                                <div class="h4-search">
                                                                    Data e Skeduluar: ' . $schedule_date . '<br>Fillon në: <b>@' . substr($schedule_time, 0, 5) . '</b> (24h)
                                                                </div>
                                                                <br>
                                                                <a href="?action=drop&id=' . $appointment_id . '&title=' . $title . '&doc=' . $doctor_name . '" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Anuloni rezervimin</font></button></a>
                                                        </div>
                                                                
                                                    </div>
                                                </td>';
                                            }
                                            echo "</tr>";
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
        if ($action == 'booking-added') {

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Rezervimi me sukses.</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                        Numri juaj i Konsultës është ' . $id . '.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'drop') {
            $title = $_GET["title"];
            $doctor_name = $_GET["doc"];

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>A je i sigurt?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            Dëshiron ta anulosh këtë takim?<br><br>
                            Emri i seancës: &nbsp;<b>' . substr($title, 0, 40) . '</b><br>
                            Emri i Doktorit: <b>' . substr($doctor_name, 0, 40) . '</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="../common/delete-appointment.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Po&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;Jo&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from doctor where doctor_id=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $name = $row["doctor_name"];
            $email = $row["doctor_email"];
            $spe = $row["specialties"];

            $sqlmain = "select specialty_name from specialties where id=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("s", $spe);
            $stmt->execute();
            $spcil_res = $stmt->get_result();
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["specialty_name"];
            $nic = $row['doctor_nic'];
            $tele = $row['doctor_phonenumber'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            eDoc Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Shiko detajet.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Emri: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email-i: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $email . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIC: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $nic . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telefoni: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialiteti: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $spcil_name . '<br><br>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
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