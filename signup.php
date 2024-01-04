<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Rregjistrohu</title>
    
</head>
<body>

<?php

session_start(); 
$_SESSION["user"]=""; 
$_SESSION["usertype"]=""; 

date_default_timezone_set('Europe/Tirane');
$date = date('Y-m-d'); 

$_SESSION["date"]=$date; 

if($_POST){ 

    $_SESSION["personal"]=array( 
        'first_name'=>$_POST['first_name'], 
        'last_name'=>$_POST['last_name'],
        'address'=>$_POST['address'],
        'nic'=>$_POST['nic'],
        'date_of_birth'=>$_POST['date_of_birth']
    ); 
    print_r($_SESSION["personal"]); 
    header("location: create-account.php");  
}
?>

    <center> 
    <div class="container"> 
        <table border="0"> 
            <tr>
                <td colspan="2"> 
                    <p class="header-text">Mirësevini!</p> 
                    <p class="sub-text">Ju lutem vendosni detajet personale më poshtë për të vijuar:</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" > 
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Emri i plotë: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="first_name" class="input-text" placeholder="Emri" required>
                </td>
                <td class="label-td">
                    <input type="text" name="last_name" class="input-text" placeholder="Mbiemri" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label">Adresa: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="address" class="input-text" placeholder="psh: Rr.Krotoni, Tiranë" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="nic" class="form-label">Numri I Identifikimit Personal(NIC):</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="nic" class="input-text" placeholder="Numri juaj personal" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="date_of_birth" class="form-label">Data e lindjes: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="date" name="date_of_birth" class="input-text" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                </td>
            </tr>

            <tr>
                <td>
                    <input type="reset" value="Rifillo" class="login-btn btn-primary-soft btn" > 
                </td>
                <td>
                    <input type="submit" value="Vazhdo" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">I regjistruar tashmë&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Hyr</a>
                    <br><br><br>
                </td>
            </tr>
                    </form>
            </tr>
        </table>
    </div>
</center>
</body>
</html>