<!DOCTYPE html>
<html>

<head>
    <title>ดำเนินการต่อไปยังหน้าหลัก</title>
    <link rel="icon" type="image/png" href="../images/Snru_3.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Group One">
    <?php include 'header.php'; ?>
</head>

<body background="../images/bg-arit-big.png">

    <?php
    if (isset($_SESSION['username']) || isset($_GET['msg'])) {
        $msg = strval($_GET['msg']);

        echo '<hr><div class="container mb-lg mt-5">
        <div class="alert alert-success alert-dismissible">';
        echo $msg .
            "<span class='mt-0 mr-0 close' data-dismiss='alert'>&times;</span>
        </div>
        <a href='index.php' class='text-md text-center'>
        ดำเนินการต่อไปยังหน้าหลัก <i class='fa fa-arrow-right'></i></a></div>";
    } else {
        redirect_user('index.php');
    }
    include_once 'footer.php';
    ?>

</body>

</html>