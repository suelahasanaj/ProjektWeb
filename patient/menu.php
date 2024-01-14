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
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php" ><input type="button" value="Dil" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home <?php maybeAddActiveClasses("/patient/index.php", "menu-icon-dashbord-active") ?>" >
                        <a href="index.php" class="non-style-link-menu <?php addActiveClasses("/patient/index.php") ?>">
                            <div><p class="menu-text">Kreu</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor <?php maybeAddActiveClasses("/patient/doctors.php", "menu-icon-dashbord-active") ?>">
                        <a href="doctors.php" class="non-style-link-menu <?php addActiveClasses("/patient/doctors.php") ?>">
                            <div><p class="menu-text">Lista e Doktorëve</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session <?php maybeAddActiveClasses("/patient/schedule.php", "menu-icon-dashbord-active") ?>">
                        <a href="schedule.php" class="non-style-link-menu <?php addActiveClasses("/patient/schedule.php") ?>">
                            <div><p class="menu-text">Seancat e Skeduluara</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment <?php maybeAddActiveClasses("/patient/appointment.php", "menu-icon-dashbord-active") ?>">
                        <a href="appointment.php" class="non-style-link-menu <?php addActiveClasses("/patient/appointment.php") ?>">
                            <div><p class="menu-text">Konsultat e Mia</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings <?php maybeAddActiveClasses("/patient/settings.php", "menu-icon-dashbord-active") ?>">
                        <a href="settings.php" class="non-style-link-menu <?php addActiveClasses("/patient/settings.php") ?>">
                            <div><p class="menu-text">Cilësime</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>