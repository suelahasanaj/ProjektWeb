<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title_of_schedule>Grafika Informative</title_of_schedule>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
    <?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    include("../connection.php");
    ?>

    <div class="container">
    <?php 
        include("menu.html");
        ?>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="2" class="nav-bar" >
                                
                                <form action="doctors.php" method="post" class="header-search">
        
                                    <input type="search" name="search" class="input-text header-searchbar" placeholder="Kërko emrin e doktorit ose emailin" list="doctors">&nbsp;&nbsp;
                                    
                                    <?php
                                        echo '<datalist id="doctors">';
                                        $list11 = $database->query("select  doctor_name,doctor_email from  doctor;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $d=$row00["doctor_name"];
                                            $c=$row00["doctor_email"];
                                            echo "<option value='$d'><br/>";
                                            echo "<option value='$c'><br/>";
                                        };
        
                                    echo ' </datalist>';
                                    ?>
                                    
                               
                                    <input type="Submit" value="Kërko" class="login-btn btn-primary-soft btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                
                                </form>
                                
                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Data e sotme
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Europe/Tirane');
        
                                $today = date('Y-m-d');
                                echo $today;


                                $patientrow = $database->query("select  * from  patient;");
                                $doctorrow = $database->query("select  * from  doctor;");
                                $appointmentrow = $database->query("select  * from  appointment where appointment_date>='$today';");
                                $schedulerow = $database->query("select  * from  schedule where schedule_date='$today';");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
                        </tr>
                <tr>
                    <td colspan="4">
                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $doctorrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Doktorë &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $patientrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Pacientë &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex; ">
                                        <div>
                                                <div class="h1-dashboard" >
                                                    <?php    echo $appointmentrow ->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard" >
                                                    Rezervim i ri &nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;padding-top:26px;padding-bottom:26px;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $schedulerow ->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px">
                                                    Sesionet e sotme
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                    </div>
                                </td>
                                
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables">
                            <tr>
                                <td>
                                    <p style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                        Takimet e ardhshme deri ne datë <?php  
                                        echo date("l",strtotime("+1 week"));
                                        ?>
                                    </p>
                                    <p style="padding-bottom:19px;padding-left:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                        Këtu gjeni akses të takimeve të ardhshme deri në 7 ditë<br>
                                        Më shumë detaje i gjeni tek sektori @Takime.
                                    </p>

                                </td>
                                <td>
                                    <p style="text-align:right;padding:10px;padding-right:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                        Sesionet e ardhshme deri në datë <?php  
                                        echo date("l",strtotime("+1 week"));
                                        ?>
                                    </p>
                                    <p style="padding-bottom:19px;text-align:right;padding-right:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                        Këtu gjeni akses të sesioneve të ardhshme të skeduluara deri në 7 ditë<br>
                                        Shto, Fshij dhe shumë detaje të tjera të disponueshme në sektorin @Skedulim.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;">
                                        <table width="85%" class="sub-table scrolldown" border="0">
                                        <thead>
                                        <tr>    
                                                <th class="table-headin" style="font-size: 12px;">
                                                        
                                                    Numri i Takimit
                                                    
                                                </th>
                                                <th class="table-headin">
                                                    Emri i Pacientit
                                                </th>
                                                <th class="table-headin">
                                                    
                                                
                                                    Doktori
                                                    
                                                </th>
                                                <th class="table-headin">
                                                    
                                                
                                                    Sesioni
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select appointment.appointment_id,schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_number,appointment.appointment_date from schedule inner join appointment on schedule.schedule_id=appointment.schedule_id inner join patient on patient.patient_id=appointment.pacient_id inner join doctor on schedule.doctor_id=doctor.doctor_id  where schedule.schedule_date>='$today'  and schedule.schedule_date<='$nextweek' order by schedule.schedule_date desc";

                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="3">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nuk gjetëm asgjë në lidhje me kërkimin tuaj!</p>
                                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaq të gjitha takimet &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                    
                                                }
                                                else{
                                                for ( $x=0; $x<$result->num_rows;$x++){
                                                    $row=$result->fetch_assoc();
                                                    $appointment_id=$row["appointment_id"];
                                                    $schedule_id=$row["schedule_id"];
                                                    $title_of_schedule=$row["title_of_schedule"];
                                                    $doctor_name=$row["doctor_name"];
                                                    $schedule_date=$row["schedule_date"];
                                                    $schedule_time=$row["schedule_time"];
                                                    $patient_name=$row["patient_name"];
                                                    $appointment_number=$row["appointment_number"];
                                                    $appointment_date=$row["appointment_date"];
                                                    echo '<tr>


                                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                            '.$appointment_number.'
                                                            
                                                        </td>

                                                        <td style="font-weight:600;"> &nbsp;'.
                                                        
                                                        substr($patient_name,0,25)
                                                        .'</td >
                                                        <td style="font-weight:600;"> &nbsp;'.
                                                        
                                                            substr($doctor_name,0,25)
                                                            .'</td >
                                                           
                                                        
                                                        <td>
                                                        '.substr($title_of_schedule,0,15).'
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
                                <td width="50%" style="padding: 0;">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                        <tr>
                                                <th class="table-headin">
                                                    
                                                
                                                Titulli i sesionit
                                                
                                                </th>
                                                
                                                <th class="table-headin">
                                                    Doctor
                                                </th>
                                                <th class="table-headin">
                                                    
                                                    Data dhe ora e sesionit
                                                    
                                                </th>
                                                    
                                                </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,schedule.schedule_date,schedule.schedule_time,schedule.number_of_patients from schedule inner join doctor on schedule.doctor_id=doctor.doctor_id  where schedule.schedule_date>='$today' and schedule.schedule_date<='$nextweek' order by schedule.schedule_date desc"; 
                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nuk gjetëm asgjë në lidhje me kërkimin tuaj !</p>
                                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaq të gjitha sesionet &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                    
                                                }
                                                else{
                                                for ( $x=0; $x<$result->num_rows;$x++){
                                                    $row=$result->fetch_assoc();
                                                    $schedule_id=$row["schedule_id"];
                                                    $title_of_schedule=$row["title_of_schedule"];
                                                    $doctor_name=$row["doctor_name"];
                                                    $schedule_date=$row["schedule_date"];
                                                    $schedule_time=$row["schedule_time"];
                                                    $number_of_patients=$row["number_of_patients"];
                                                    echo '<tr>
                                                        <td style="padding:20px;"> &nbsp;'.
                                                        substr($title_of_schedule,0,30)
                                                        .'</td>
                                                        <td>
                                                        '.substr($doctor_name,0,20).'
                                                        </td>
                                                        <td style="text-align:center;">
                                                            '.substr($schedule_date,0,10).' '.substr($schedule_time,0,5).'
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
                            <tr>
                                <td>
                                    <center>
                                        <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Shfaq të gjitha takimet</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="schedule.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Shfaq të gjitha sesionet</button></a>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                        </table>
                        </center>
                        </td>
                </tr>
            </table>
        </div>
    </div>


</body>
</html>