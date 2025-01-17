<?php
include './admin_db.php';
session_start();


if (!isset($_SESSION["admin_id"])) {
    header("Location:admin_login.php");
}

if ($_POST) {
    $blog_title = $_POST['blog_title'];
    $blog_details = $_POST['blog_details'];
    $blog_photo_name = $_FILES['blog_photo']['name'];
    $blog_photo_tmp_name = $_FILES['blog_photo']['tmp_name'];

    $query = mysqli_query($connection, "insert into tbl_blog(blog_title,blog_details,blog_photo) values('{$blog_title}','{$blog_details}','{$blog_photo_name}')");
    move_uploaded_file($blog_photo_tmp_name, "uploads/" . $blog_photo_name);
    if ($query) {
        echo "<script>alert('Blog added to the database');window.location='blog_form.php'</script>";
    }
}

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
    <title>Blog Form</title>
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
    <?php require './admin_header.php' ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php require './admin_sidebar.php' ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-ui-checks"></i>Blog Form</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door fs-6"></i></a></li>
                <li class="breadcrumb-item">Blog</li>
                <li class="breadcrumb-item"><a href="blog_form.php">Blog-Form</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Add Blog</h3>
                    <div class="tile-body">
                        <form method="post" class="row" id="blog_form">
                            <div class="mb-3 col-md-3">
                                <label class="form-label">Blog Title</label>
                                <input class="form-control" type="text" onkeyup="Validatestring(this)" name="blog_title" placeholder="Enter blog title" required>
                                <br>
                                <label class="form-label">Blog Details</label>
                                <textarea name="blog_details" class="form-control" cols="3" rows="5" placeholder="Enter blog details" required></textarea>
                                <br>
                                <label class="form-label">Photo</label>
                                <input class="form-control" type="file" name="blog_photo" placeholder="Upload blog photo" required>
                                <br>
                                <button class="btn btn-primary" type="submit" name="add"><i class="bi bi-check-circle-fill me-2"></i>Add</button>
                            </div>
                        </form>
                    </div>
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
    <script src="tools/jquery-3.7.1.min.js"></script>
    <script src="tools/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $("#blog_form").validate({
                rules: {
                    blog_title: {
                        required: true,
                        minlength: 2
                    },
                    blog_details: "required",
                    file: "required",
                },
                messages: {

                    blog_title: {
                        required: "Please enter blog title",
                        minlength: "Title must consist of at least 2 characters"
                    },
                }
            });
        });

        function Validatestring(no) {
            no.value = no.value.replace(/[^ a-z A-Z\n\r]+/g, '');
        }
    </script>
    <style>
        .error {
            color: red
        }
    </style>
</body>

</html>