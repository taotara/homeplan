<nav class="side-menu">
    <div class="side-menu-avatar">
        <div class="avatar-preview avatar-preview-100">
            <img src="../images/avatar-1-256.png" alt="">
        </div>
        <div class="">
            <h6 style="text-align: center; padding-top: 20px; margin-bottom: -10px; color: #797979">
                <?php
                  $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['adminidusername']."'";
                  if ($result = mysqli_query($con, $sql)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_row($result)) {
                      $row = $row[0];
                      $row = strtoupper($row);
                      print $row;
                    }

                  }
                ?>
            </h6>
        </div>
    </div>
    <ul class="side-menu-list">
        <li class="blue">
            <a href="dashboard.php">
                <i class="font-icon font-icon-speed"></i>
                <span class="lbl">Dashboard</span>
            </a>
        </li>
        <li class="blue with-sub">
            <span>
                <i class="font-icon font-icon-cogwheel"></i>
                <span class="lbl">Configuration</span>
            </span>
            <ul>
                <li><a href="gensettings.php"><span class="lbl">General Settings</span></a></li>
                <li><a href="emailsettings.php"><span class="lbl">E-Mail Settings</span></a></li>
                <li><a href="pacsettings.php"><span class="lbl">Packages Settings</span></a></li>
            </ul>
        </li>
        <li class="blue">
            <a href="notifications.php">
                <i class="font-icon font-icon-mail"></i>
                <span class="lbl">Post Notifications</span>
            </a>
        </li>
        <li class="blue with-sub">
            <span>
                <i class="font-icon font-icon-users"></i>
                <span class="lbl">Manage Users</span>
            </span>
            <ul>
                <li><a href="users.php"><span class="lbl">Users</span></a></li>
                <li><a href="payrequest.php"><span class="lbl">User's Payment Requests</span></a></li>
            </ul>
        </li>
        <li class="blue">
            <a href="profile.php">
                <i class="font-icon glyphicon glyphicon-user"></i>
                <span class="lbl">Profile</span>
            </a>
        </li>
        <li class="blue">
            <a href="logout.php">
                <i class="font-icon glyphicon glyphicon-log-out"></i>
                <span class="lbl">Logout</span>
            </a>
        </li>
    </ul>
</nav>
