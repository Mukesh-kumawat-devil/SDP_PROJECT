<?php
session_start();
if (!isset($_SESSION["ngo_id"])) {
    header("Location:ngo_login.php");
}
$ngo_id = $_SESSION["ngo_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Donation Information</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php
    require 'ngo_header.php';
    ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php
    require 'ngo_sidebar.php';
    ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-table"></i> Donation Information</h1>

            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door fs-6"></i></a></li>
                <li class="breadcrumb-item">Donation</li>
                <li class="breadcrumb-item active"><a href="donation_information.php">Donation Information</a></li>
            </ul>
        </div>
        <!-- item -->
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Item Donation Information</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Item Requirement Details</th>
                                <th>Donation Details</th>
                                <th>Donation Date</th>
                                <th>Donation Address</th>
                                <th>Donation Status</th>
                                <th>Volunteer Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'admin_db.php';
                            if (isset($_GET['delete_id'])) {
                                $delete_id = $_GET['delete_id'];
                                $delete_query = "delete from tbl_donation where donation_id = $delete_id";
                                $data = mysqli_query($connection, $delete_query);
                                if ($data) {
                                    echo "<script>alert('Record deleted from the database');window.location='donation_information.php'</script>";
                                } else {
                                    echo "<script>alert('Record not deleted from the database');window.location='donation_information.php'</script>";
                                }
                            }

                            $select = mysqli_query($connection, "select*from tbl_donation where ngo_id='{$ngo_id}' and donation_type='item'");
                            while ($donation_row = mysqli_fetch_array($select)) {

                                $ngo_query = mysqli_query($connection, "select*from tbl_ngo where ngo_id='{$donation_row['ngo_id']}'");
                                $ngo_row = mysqli_fetch_array($ngo_query);

                                $item_requirement_query = mysqli_query($connection, "select*from tbl_item_requirement where item_requirement_id='{$donation_row['item_requirement_id']}'");
                                $item_requirement_row = mysqli_fetch_array($item_requirement_query);

                                $volunteer_query = mysqli_query($connection, "select*from tbl_volunteer where volunteer_id='{$donation_row['volunteer_id']}'");
                                $volunteer_row = mysqli_fetch_array($volunteer_query);

                                $user_query = mysqli_query($connection, "select * from tbl_user where user_id = '{$donation_row['user_id']}'");
                                $user_row = mysqli_fetch_array($user_query);

                                echo "<tr>";
                                // echo "<td>{$donation_row['donation_id']}</td>";
                                echo "<td>{$user_row['user_first_name']}</td>";
                                echo "<td>{$item_requirement_row['item_requirement_details']}</td>";
                                echo "<td>{$donation_row['donation_details']}</td>";
                                echo "<td>{$donation_row['donation_date']}</td>";
                                echo "<td>{$donation_row['donation_address']}</td>";
                                echo "<td>{$donation_row['donation_status']}</td>";
                                echo "<td>{$volunteer_row['volunteer_first_name']} {$volunteer_row['volunteer_last_name']}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- online -->
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Online Donation Information</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Donation Method</th>
                                <th>Donation Type</th>
                                <th>Donation Date</th>
                                <th>Donation Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'admin_db.php';
                            if (isset($_GET['delete_id'])) {
                                $delete_id = $_GET['delete_id'];
                                $delete_query = "delete from tbl_donation where donation_id = $delete_id";
                                $data = mysqli_query($connection, $delete_query);
                                if ($data) {
                                    echo "<script>alert('Record deleted from the database');window.location='donation_information.php'</script>";
                                } else {
                                    echo "<script>alert('Record not deleted from the database');window.location='donation_information.php'</script>";
                                }
                            }

                            $select = mysqli_query($connection, "select*from tbl_donation where ngo_id='{$ngo_id}' and donation_type='online'");
                            while ($donation_row = mysqli_fetch_array($select)) {

                                $ngo_query = mysqli_query($connection, "select*from tbl_ngo where ngo_id='{$donation_row['ngo_id']}'");
                                $ngo_row = mysqli_fetch_array($ngo_query);

                                $user_query = mysqli_query($connection, "select * from tbl_user where user_id = '{$donation_row['user_id']}'");
                                $user_row = mysqli_fetch_array($user_query);

                                echo "<tr>";
                                // echo "<td>{$donation_row['donation_id']}</td>";
                                echo "<td>{$user_row['user_first_name']}</td>";
                                echo "<td>{$donation_row['donation_method']}</td>";
                                echo "<td>{$donation_row['donation_type']}</td>";
                                echo "<td>{$donation_row['donation_date']}</td>";
                                echo "<td>{$donation_row['donation_amount']}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
    <script type="text/javascript">
        if (document.location.hostname == 'pratikborsadiya.in') {
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
    </script>
    <script>
        function confirmDelete() {
            return confirm("Are you Confirm?");
        }
    </script>
</body>

</html>