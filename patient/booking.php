<!DOCTYPE html>
<html lang="en">
<?php
include("header.html");
?>
<body>
    <?php
    include("session-start.php");
    include("../connection.php");

    $userrow = $database->query("select * from patient where patient_email='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["patient_id"];
    $username = $userfetch["patient_name"];

    date_default_timezone_set('Europe/Tirane');

    $today = date('Y-m-d');


    ?>
    <div class="container">
    <?php
         include("menu.php");
        ?>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Kthehu</font>
                        </button></a>
                </td>
                <td>
                    <form action="schedule.php" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Kërkoni emrin e mjekut ose emailin ose datën (VVVV-MM-DD)" list="doctors">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="doctors">';
                        $list11 = $database->query("select DISTINCT * from  doctor;");
                        $list12 = $database->query("select
                        MAX(schedule_id) as schedule_id, 
                        MAX(doctor_id) as doctor_id,
                        MAX(title_of_schedule) as title_of_schedule,
                        MAX(schedule_date) as schedule_date,
                        MAX(schedule_time) as schedule_time,
                        MAX(number_of_patients) as number_of_patients
                        from  schedule GROUP BY title_of_schedule;");


                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["doctor_name"];

                            echo "<option value='$d'><br/>";
                        };


                        for ($y = 0; $y < $list12->num_rows; $y++) {
                            $row00 = $list12->fetch_assoc();
                            $d = $row00["title"];

                            echo "<option value='$d'><br/>";
                        };

                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Kërko" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                    </form>
                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Data Sot
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php

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
                    <!-- <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49);font-weight:400;">Seancat e Skeduluara / Booking / <b>Review Booking</b></p> -->

                </td>

            </tr>
            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">

                                <tbody>

                                    <?php

                                        if (($_GET)) {


                                            if (isset($_GET["id"])) {


                                             $id = $_GET["id"];

                                             $sqlmain = "select * from schedule inner join doctor on schedule.doctor_id=doctor.doctor_id where schedule.schedule_id=? order by schedule.schedule_date desc";
                                             $stmt = $database->prepare($sqlmain);
                                             $stmt->bind_param("i", $id);
                                             $stmt->execute();
                                             $result = $stmt->get_result();
                                             $row = $result->fetch_assoc();
                                             $schedule_id = $row["schedule_id"];
                                             $title = $row["title_of_schedule"];
                                             $doctor_name = $row["doctor_name"];
                                             $doctor_email = $row["doctor_email"];
                                             $schedule_date = $row["schedule_date"];
                                             $schedule_time = $row["schedule_time"];
                                             $sql2 = "select * from appointment where schedule_id=$id";

                                             $result12 = $database->query($sql2);
                                             $appointment_number = ($result12->num_rows) + 1;

                                             echo '
                                                    <form action="booking-complete.php" method="post">
                                                    <input type="hidden" name="schedule_id" value="' . $schedule_id . '" >
                                                    <input type="hidden" name="appointment_number" value="' . $appointment_number . '" >
                                                    <input type="hidden" name="date" value="' . $today . '" >
                                                ';


                                             echo '
                                                    <td style="width: 50%;" rowspan="2">
                                                        <div  class="dashboard-items search-items"  >
                                            
                                                            <div style="width:100%">
                                                                <div class="h1-search" style="font-size:25px;">
                                                                    Detajet e seances
                                                                </div><br><br>
                                                                <div class="h3-search" style="font-size:18px;line-height:30px">
                                                                    Emri Doktorit:  &nbsp;&nbsp;<b>' . $doctor_name . '</b><br>
                                                                    Email-i Doktorit:  &nbsp;&nbsp;<b>' . $doctor_email . '</b> 
                                                                </div>
                                                                <div class="h3-search" style="font-size:18px;">
                                                          
                                                                </div><br>
                                                                <div class="h3-search" style="font-size:18px;">
                                                                    Titulli i Seancës: ' . $title . '<br>
                                                                    Data e Skeduluar: ' . $schedule_date . '<br>
                                                                    Fillon në : ' . $schedule_time . '<br>
                                                                    Tarifa : <b>2 000.00 Lekë</b>
                                                                </div><br>
                                                        
                                                            </div>
                                                        
                                                        </div>
                                                    </td>
                                        
                                        
                                        
                                                    <td style="width: 25%;">
                                                        <div  class="dashboard-items search-items"  >
                                            
                                                            <div style="width:100%;padding-top: 15px;padding-bottom: 15px;">
                                                                <div class="h1-search" style="font-size:20px;line-height: 35px;margin-left:8px;text-align:center;">
                                                                    Numri juaj i Konsultës
                                                                </div>
                                                                <center>
                                                                    <div class=" dashboard-icons" style="margin-left: 0px;width:90%;font-size:70px;font-weight:800;text-align:center;color:var(--btnnictext);background-color: var(--btnice)">' . $appointment_number . '</div>
                                                                </center>
                                                       
                                                            </div><br><br><br>
                                                        </div>
                                                        
                                                        </div>
                                                    </td>
                                                        </tr>
                                                        <tr>
                                                        <td>
                                                        <input type="Submit" class="login-btn btn-primary btn btn-book" style="margin-left:10px;padding-left: 25px;padding-right: 40px;padding-top: 10px;padding-bottom: 10px;width:95%;text-align: center;" value="Cakto konsultën" name="booknow"></button>
                                                        </form>
                                                        </td>
                                                    </tr>
                                                ';
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
    </div>
</body>
</html>