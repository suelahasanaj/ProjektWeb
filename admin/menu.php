<?php
function getUrl()
{
    return $_SERVER['PHP_SELF'];
}

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
                                <p class="profile-title_of_schedule">Administator</p>
                                <p class="profile-subtitle">admin@gmail.com</p>
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
                <td class="menu-btn menu-icon-dashbord <?php maybeAddActiveClasses("/admin/index.php", "menu-icon-dashbord-active") ?>" >
                    <a href="index.php" class="non-style-link-menu <?php addActiveClasses("/admin/index.php") ?>"><div><p class="menu-text">Grafika Informative</p></a></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-doctor <?php maybeAddActiveClasses("/admin/doctors.php", "menu-icon-doctors-active") ?>">
                    <a href="doctors.php" class="non-style-link-menu <?php addActiveClasses("/admin/doctors.php") ?>"><div><p class="menu-text">Doktorë</p></a></div>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-schedule <?php maybeAddActiveClasses("/admin/schedule.php", "menu-icon-session-active") ?>">
                    <a href="schedule.php" class="non-style-link-menu <?php addActiveClasses("/admin/schedule.php") ?>"><div><p class="menu-text">Skedulimet</p></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-appoinment <?php maybeAddActiveClasses("/admin/appointment.php", "menu-icon-appointment-active") ?>">
                    <a href="appointment.php" class="non-style-link-menu <?php addActiveClasses("/admin/appointment.php") ?>"><div><p class="menu-text">Takimet</p></a></div>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-patient <?php maybeAddActiveClasses("/admin/patient.php", "menu-icon-patient-active") ?>">
                    <a href="patient.php" class="non-style-link-menu <?php addActiveClasses("/admin/patient.php") ?>"><div><p class="menu-text">Pacientë</p></a></div>
                </td>
            </tr>

        </table>
    </div>
</body>
</html>