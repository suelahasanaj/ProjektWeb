<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Sektori i Takimeve</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php
    include("session_start.php");
    include("../connection.php");
    ?>

    <div class="container">
    <?php
    include("menu.html");
    ?>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="appointment.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Kthehu</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Menaxhim I Takimeve</p>
                                           
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

                        $list110 = $database->query("select  * from  appointment;");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Të gjitha takimet (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="8%">
                           </td> 
                        <td width="5%" style="text-align: center;">
                        Data:
                        </td>
                        <td width="30%">
                        <form action="" method="post">
                            
                            <input type="date" name="schedule_date" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        <td width="5%" style="text-align: center;">
                        Doktor:
                        </td>
                        <td width="30%">
                        <select name="doctor" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;" >
                            <option value="" disabled selected hidden>Zgjidhni emrin e doktorit nga lista</option><br/>
                                
                            <?php
                        
                                $list11 = $database->query("select  * from  doctor order by doctor_name asc;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $sn=$row00["doctor_name"];
                                    $id00=$row00["doctor_id"];
                                    echo "<option value=".$id00.">$sn</option><br/>";
                                };
                                ?>

                        </select>
                    </td>
                    <td width="12%">
                        <input type="Submit"  name="filter" value=" Filtro" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>
                    </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                
                <?php
                    if($_POST){
                        $sqlpt1="";
                        if(!empty($_POST["schedule_date"])){
                            $schedule_date=$_POST["schedule_date"];
                            $sqlpt1=" schedule.schedule_date='$schedule_date' ";
                        }

                        // filter appointments by doctor name and show only those appointments that include the name of the doctor entered by user in the filter form otherwise show all appointments
                        $sqlpt2="";
                        if(!empty($_POST["doctor"])){
                            $doctor=$_POST["doctor"];
                            $sqlpt2=" doctor.doctor_id='$doctor' ";
                        }
                        $sqlmain= "select appointment.appointment_id,schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_number,appointment.appointment_date from schedule inner join appointment on schedule.schedule_id=appointment.schedule_id inner join patient on patient.patient_id=appointment.pacient_id inner join doctor on schedule.doctor_id=doctor.doctor_id  ";
                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        foreach($sqllist as $key){

                            if(!empty($key)){
                                $sqlmain.=$sqlkeywords[$key2].$key;
                                $key2++;
                            };
                        };
                    }else{
                        $sqlmain= "select appointment.appointment_id,schedule.schedule_id,schedule.title_of_schedule,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_number,appointment.appointment_date from schedule inner join appointment on schedule.schedule_id=appointment.schedule_id inner join patient on patient.patient_id=appointment.pacient_id inner join doctor on schedule.doctor_id=doctor.doctor_id  order by schedule.schedule_date desc";

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
                                    Emri i pacientit
                                </th>
                                <th class="table-headin">
                                    
                                    Numri i takimit
                                    
                                </th>
                               
                                
                                <th class="table-headin">
                                        
                                        Doktori
                                </th>
                                <th class="table-headin">
                                    
                                
                                    Titulli i sesionit
                                    
                                    </th>
                                
                                <th class="table-headin" >
                                    
                                    Data dhe ora e sesionit
                                    
                                </th>
                                
                                <th class="table-headin">
                                    
                                    Data e takimit
                                    
                                </th>
                                
                                <th class="table-headin">
                                    
                                    Eventet
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nuk u gjet asnjë rezultat nga kërkimi!</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Shfaq te gjitha takimet &nbsp;</font></button>
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
                                    echo '<tr >
                                        <td style="font-weight:600;"> &nbsp;'.
                                        
                                        substr($patient_name,0,25)
                                        .'</td >
                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                        '.$appointment_number.'
                                        
                                        </td>
                                        <td>
                                        '.substr($doctor_name,0,25).'
                                        </td>
                                        <td>
                                        '.substr($title_of_schedule,0,15).'
                                        </td>
                                        <td style="text-align:center;font-size:12px;">
                                            '.substr($schedule_date,0,10).' <br>'.substr($schedule_time,0,5).'
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            '.$appointment_date.'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <!--<a href="?action=view&id='.$appointment_id.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Shiko</font></button></a>
                                       &nbsp;&nbsp;&nbsp;-->
                                       <a href="?action=drop&id='.$appointment_id.'&name='.$patient_name.'&session='.$title_of_schedule.'&appointment_number='.$appointment_number.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Anullo</font></button></a>
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
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='drop'){
            $nameget=$_GET["name"];
            $session=$_GET["session"];
            $appointment_number=$_GET["appointment_number"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Jeni i sigurt?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            Dëshiron ta fshish këtë rekord<br><br>
                            Emri i pacientit: &nbsp;<b>'.substr($nameget,0,40).'</b><br>
                            Numri i takimit &nbsp; : <b>'.substr($appointment_number,0,40).'</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="../common/delete-appointment.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Po&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;Jo&nbsp;&nbsp;</font></button></a>

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