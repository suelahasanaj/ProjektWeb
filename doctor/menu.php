<?php
function getUrl()
{
    return $_SERVER['PHP_SELF'];
}
//var_dump(getUrl());

function isMenuActive($link)
{

    if ($link == getUrl()) {
        return true;
    }
    return false;
}

function maybeAddActiveClasses($link, $class)
{
    if (isMenuActive($link)) {
        echo "menu-active " . $class;
    }
}
function addActiveClasses($link)
{
    if (isMenuActive($link)) {
        echo "non-style-link-menu-active";
    }
}
?>

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
            <td class="menu-btn menu-icon-dashbord  <?php maybeAddActiveClasses("/doctor/index.php", "menu-icon-dashbord-active") ?>">
                <a href="index.php" class="non-style-link-menu <?php addActiveClasses("/doctor/index.php") ?>">
                    <div>
                        <p class="menu-text">Grafika Informative</p>
                </a>
</div></a>
</td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-appoinment <?php maybeAddActiveClasses("/doctor/appointment.php", "menu-icon-appointment-active") ?> ">
        <a href="appointment.php" class="non-style-link-menu <?php addActiveClasses("/doctor/appointment.php") ?>">
            <div>
                <p class="menu-text">Konsultat e Mia</p>
        </a></div>
    </td>
</tr>

<tr class="menu-row">
    <td class="menu-btn menu-icon-session <?php maybeAddActiveClasses("/doctor/schedule.php", "menu-icon-session-active") ?>">
        <a href="schedule.php" class="non-style-link-menu <?php addActiveClasses("/doctor/schedule.php") ?>">
            <div>
                <p class="menu-text">Seancat e Skeduluara</p>
            </div>
        </a>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-patient <?php maybeAddActiveClasses("/doctor/patient.php", "menu-icon-patient-active") ?>">
        <a href="patient.php" class="non-style-link-menu <?php addActiveClasses("/doctor/patient.php") ?>">
            <div>
                <p class="menu-text">Pacientët e mi</p>
        </a></div>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-settings <?php maybeAddActiveClasses("/doctor/settings.php", "menu-icon-settings-active") ?>">
        <a href="settings.php" class="non-style-link-menu <?php addActiveClasses("/doctor/settings.php") ?>">
            <div>
                <p class="menu-text">Cilësime</p>
        </a></div>
    </td>
</tr>
</table>
</div>