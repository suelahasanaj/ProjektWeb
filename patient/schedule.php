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

    date_default_timezone_set('Europe/Tirane');

    $today = date('Y-m-d');

    ?>
    <div class="container">
    <?php
         include("menu.php");
        ?>
    <?php
    $sqlmain = "SELECT * FROM schedule
                INNER JOIN doctor ON schedule.doctor_id = doctor.doctor_id
                WHERE schedule.schedule_date >= '$today'";

    $insertkey = "";
    $q = '';
    $searchtype = "All";

    if ($_POST && !empty($_POST["search"])) {
        $keyword = $_POST["search"];
        $keyword = $database->real_escape_string($keyword); // Sanitize user input

        $sqlmain .= " AND (
            doctor.doctor_name LIKE '%$keyword%' OR
            schedule.title_of_schedule LIKE '%$keyword%' OR
            schedule.schedule_date LIKE '%$keyword%'
        )";

        $insertkey = $keyword;
        $searchtype = "Search Result: ";
        $q = '"';
    }

    $sqlmain .= " ORDER BY schedule.schedule_date ASC";

    $result = $database->query($sqlmain);

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
                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Kërkoni emrin e mjekut ose emailin ose datën (VVVV-MM-DD)" list="doctors" value="<?php echo $insertkey ?>">&nbsp;&nbsp;

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
                            $d = $row00["title_of_schedule"];

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
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo " Seancat" . "(" . $result->num_rows . ")"; ?> </p>
                    <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)"><?php echo $q . $insertkey . $q; ?> </p>
                </td>

            </tr>



            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">

                                <tbody>

                                    <?php



                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nuk mund të gjenim diçka nga kërkimi yt!</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaq gjithë Seancat</p> &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        //echo $result->num_rows;
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

                                                if ($schedule_id == "") {
                                                    break;
                                                }

                                                echo '
                                        <td style="width: 25%;">
                                                <div  class="dashboard-items search-items"  >
                                                
                                                    <div style="width:100%">
                                                            <div class="h1-search">
                                                                ' . substr($title, 0, 21) . '
                                                            </div><br>
                                                            <div class="h3-search">
                                                                ' . substr($doctor_name, 0, 30) . '
                                                            </div>
                                                            <div class="h4-search">
                                                                ' . $schedule_date . '<br>Fillon në: <b>@' . substr($schedule_time, 0, 5) . '</b> (24h)
                                                            </div>
                                                            <br>
                                                            <a href="booking.php?id=' . $schedule_id . '" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Cakto Konsultën</font></button></a>
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

    </div>
    <?php
include("../footer.html")
?>
</body>

</html>