<nav class="side-menu">
    <div class="side-menu-avatar">
        <div class="avatar-preview avatar-preview-100">
            <img src="images/avatar-1-256.png" alt="">
        </div>
        <div class="">
            <h6 style="text-align: center; padding-top: 20px; margin-bottom: -10px; color: #797979">
              <?php

                  $query="SELECT * FROM  affiliateuser WHERE username='".$_SESSION['username']."'";
                  if ($result = mysqli_query($con, $query)) {

                    /* fetch associative array */
                    while ($row = mysqli_fetch_row($result)) {
                        $row = $row[3];
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
                <i class="font-icon font-icon-comments"></i>
                <span class="lbl">Account</span>
            </span>
            <ul>
                <li><a href="downline.php"><span class="lbl">Downline/Earnings</span></a></li>
                <li><a href="invoice.php"><span class="lbl">Invoice/Account Status</span></a></li>
                <li><a href="paymentshistory.php"><span class="lbl">Payment History</span></a></li>
            </ul>
        </li>
        <li class="blue with-sub">
            <span>
                <i class="font-icon font-icon-mail"></i>
                <span class="lbl">Messages</span>
            </span>
            <ul>
                <li><a href="notifications.php"><span class="lbl">Notification</span></a></li>
                <li><a href="contact.php"><span class="lbl">Send Message</span></a></li>
            </ul>
        </li>

    </ul>
</nav>
