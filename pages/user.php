<?php

require_once 'connection.php';

include_once 'functions.php';

if (!isset($_POST['login-type']) || $_POST['login-type'] == 'admin') {
    $errors = [];

    if (!isset($_POST['username']) || $_POST['username'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อผู้ใช้');
    } else {
        $username = strip_tags(trim(htmlspecialchars($_POST['username'])));
    }

    if (isset($_POST['table']) || $_POST['table'] !== '') {
        $tbl = strip_tags(trim(htmlspecialchars($_POST['table'])));
    }

    if (isset($_POST['page']) || $_POST['page'] !== '') {
        $page = strip_tags(trim(htmlspecialchars($_POST['page'])));
    }

    if (isset($_POST['login-type']) || $_POST['login-type'] !== '') {
        $login_type = strip_tags(trim($_POST['login-type']));
    }
    if (!isset($_POST['password']) || $_POST['password'] == '') {
        $errors[] = urlencode('ต้องการรหัสผ่าน');
    } else {
        $password = $_POST['password'];
    }

    if (!$errors) {
        $stmt = $db_con->prepare("SELECT * FROM $tbl WHERE username = ?");

        $stmt->bind_param('s', $username);

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->num_rows;

        if ($row == 1) {
            $rows = $result->fetch_object();

            if (password_verify($password, $rows->password)) {
                session_start();

                if ($login_type == 'admin') {
                    $_SESSION['admin-user'] = $rows->username;

                    $_SESSION['admin-id'] = $rows->admin_id;

                    $_SESSION['admin-email'] = $rows->email;

                    $_SESSION['admin-fname'] = $rows->fname;


                    $_SESSION['admin-lname'] = $rows->lname;


                } elseif ($login_type == 'staff') {
                    $_SESSION['staff-user'] = $rows->username;

                    $_SESSION['staff-email'] = $rows->email;

                    $_SESSION['staff-id'] = $rows->staff_id;

                    $_SESSION['staff-level'] = $rows->staff_level;
                } else {
                    $_SESSION['supervisor-user'] = $rows->username;

                    $_SESSION['supervisor-id'] = $rows->supervisor_id;

                    $_SESSION['supervisor-email'] = $rows->email;

                    $_SESSION['staff-level'] = $rows->staff_level;
                }

                header("Location:$page");
            } else {
                $error = urlencode('รหัสผ่านไม่ถูกต้อง');

                header(
                    "Location:index2.php?action=login&type=$login_type&error=$error"
                );
                echo "login&type=$login_type&error=$error";
            }
        } else {
            $error = urlencode('ชื่อผู้ใช้ที่ให้ไว้ไม่ได้สมัคร');

            header("Location:index2.php?action=login&type=admin&error=$error");
            echo "error=$error";
        }
    } else {
        header(
            'Location:index2.php?action=login&type=admin&error=' .
                join($errors)
        );
        echo "error=$error";
    }
} elseif (!isset($_POST['login-type']) || $_POST['login-type'] == 'staff') {
    $errors = [];

    if (!isset($_POST['username']) || $_POST['username'] == '') {
        $errors[] = urlencode('ต้องระบุชื่อผู้ใช้');
    } else {
        $username = strip_tags(trim(htmlspecialchars($_POST['username'])));
    }

    if (isset($_POST['table']) || $_POST['table'] !== '') {
        $tbl = strip_tags(trim(htmlspecialchars($_POST['table'])));
    }

    if (isset($_POST['page']) || $_POST['page'] !== '') {
        $page = strip_tags(trim(htmlspecialchars($_POST['page'])));
    }

    if (isset($_POST['login-type']) || $_POST['login-type'] !== '') {
        $login_type = strip_tags(trim($_POST['login-type']));
    }
    if (!isset($_POST['password']) || $_POST['password'] == '') {
        $errors[] = urlencode('ต้องการรหัสผ่าน');
    } else {
        $password = $_POST['password'];
    }

    if (!$errors) {
        $stmt = $db_con->prepare("SELECT * FROM $tbl WHERE username = ?");

        $stmt->bind_param('s', $username);

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->num_rows;

        if ($row == 1) {
            $rows = $result->fetch_object();

            if (password_verify($password, $rows->password)) {
                session_start();

                if ($login_type == 'admin') {
                    $_SESSION['admin-user'] = $rows->username;

                    $_SESSION['admin-id'] = $rows->admin_id;

                    $_SESSION['admin-fname'] = $rows->fname;

                    $_SESSION['admin-lname'] = $rows->lname;

                    $_SESSION['admin-email'] = $rows->email;
                } elseif ($login_type == 'staff') {
                    $_SESSION['staff-user'] = $rows->username;

                    $_SESSION['staff-fname'] = $rows->fname;

                    $_SESSION['staff-lname'] = $rows->lname;

                    $_SESSION['staff-email'] = $rows->email;

                    $_SESSION['staff-id'] = $rows->staff_id;

                    $_SESSION['staff-level'] = $rows->staff_level;
                } else {
                    $_SESSION['supervisor-user'] = $rows->username;

                    $_SESSION['supervisor-id'] = $rows->supervisor_id;

                    $_SESSION['supervisor-email'] = $rows->email;

                    //$_SESSION['supervisor-level'] = $rows->staff_level;
                }

                header("Location:$page");
            } else {
                $error = urlencode('รหัสผ่านไม่ถูกต้อง');

                header(
                    "Location:index.php?tab=2action=login&type=$login_type&error=$error"
                );
                echo "login&type=$login_type&error=$error";
            }
        } else {
            $error = urlencode('ชื่อผู้ใช้ที่ให้ไว้ไม่ได้สมัคร');

            header("Location:index.php?tab=2&error=$error");
            echo "error=$error";
        }
    } else {
        header('Location:index.php?tab=2&error=' . join($errors));
        echo "error=$error";
    }
} else {
    redirect_user('404.php');
}