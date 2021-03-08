<?php
include_once("connection.php");


function is_user_registered($tbl, $user)
{

    global $db_con;

    $result = $db_con->query("SELECT * FROM '$tbl' WHERE username = '$user'");

    if ($result->num_rows == 0) {

        return FALSE;
    }
    return TRUE;
}

/**
 * Checks whether the specified $item is in the table given as $table. The second 
 * variable $column refers to the column name of $item in the table
 * @global Handle $db_con The connection handle
 * @param string $table Table to check through
 * @param string $column The column to search item
 * @param string $item The item to query.
 * @return boolean True if item in table. False if item is not in table
 */
function in_db($table, $column, $itemn)
{

    global $db_con;

    $name = strval($column);

    $res = $db_con->query("SELECT * FROM $table WHERE $name = $item");

    if ($res->num_rows == 1) {

        return TRUE;
    }
    return FALSE;
}

/**
 * This function is used to determine whether some rows were affected in the last 
 * database query. If rows were affected, it returns an integer value of one(1) 
 * zero(0) if no row was affetcted 
 * @global Handle $handle The connection handle to the database
 * @param Handle $handle The connection handle
 * @return int Returns 1 if some rows are affected by the query. Otherwise, zero(0)
 *  is returned.
 */
function rows_affected($handle)
{

    global $handle;

    if ($handle->affected_rows > 0) {
        return 1;
    }

    return 0;
}


/**
 * @param string $page
 * Redirects to the page passed in as @param 
 */


function redirect_user($page)
{

    if (isset($page)) {

        header("Location:$page");
    }
}

function show_alert()
{

    if (isset($_GET['error']) && $_GET['error'] !== '') {

        echo "<div class='alert alert-danger alert-dismissible'>"
            . strval($_GET['error']) . "<span class='close' data-dismiss='alert'>&times;
            </span></div>";
    }

    if (isset($_GET['msg']) && $_GET['msg'] !== '') {

        echo "<div class='alert alert-success alert-dismissible'>"
            . $_GET['msg'] . "<span class='close' data-dismiss='alert'>"
            . "&times;</span></div>";
    }
}
/**
 * This function queries the database with the command passed to it
 * @global Handle $db_con - The database connection handle.
 * @param String $str - The query statement/string
 * @return boolean = False query unsuccessful or @param $rows on query success
 */
function query_db($str)
{

    global $db_con;

    $res = $db_con->query($str);

    if ($res->num_rows < 1 || $db_con->affected_rows == 0) {

        return FALSE;
    }

    $rows = $res->fetch_object();

    return $rows;
}

/**
 * 
 * @str String $tbl is table name to select from
 * @param int $id is the id of the item to select
 * @param String $col_identifier is the string representation of @param $col. It's 
 * required if @param $col is specified
 * @param String $col is the column to test against in addtion to id.
 * @return boolean - Returns @param $rows populated with data for use upon success
 * or FALSE on failure
 */

function select_with_prepare_stmt($tbl, $id = NULL, $col_identifier = NULL, $col = NULL)
{
    global $db_con;
    $str = "SELECT * FROM $tbl";

    if ($id !== "") {

        $str .= " WHERE id = ?";
    }

    if ($col !== "" && $col_identifier !== "") {
        $str .= " AND $col_identifier = ?";
    }

    $stmt = $db_con->prepare($str);

    $stmt->bind_param("is", $id, $col);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $rows = $result->fetch_object();
        return $rows;
    }

    return FALSE;
}

/**
 * 
 * @param String $user - User that's to be verified
 * @param String $password - User password
 * @param String $tbl - Table name
 * @return boolean - True on success, False on failure
 */
function verify_user($user, $password, $tbl)
{

    $query = "SELECT $password FROM $tbl WHERE username = $user";

    if (query_db($query)) {

        if (!password_verify($rows->password, PASSWORD_DEFAULT)) {

            return FALSE;
        }
    }

    return TRUE;
}

/**
 * This function updates the total yearly booking remaining in the booking table 
 * at the end of the month. Note that "end of month" here doesn't actually means 
 * the end of the actual month. It's calculated based on the day the booking's created. 
 * This may not be what you want(so it's a bug, huh? :-) )
 * @global Handle $db_con Connection handle
 */
function auto_update_booking_curr_date()
{

    global $db_con;

    $date_now = date("U");

    $query = $db_con->query("SELECT * FROM booking");

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_object()) {

            $difference = intval($date_now) - $row->auto_update;

            $reduced = $row->current_days - $row->allowed_monthly_days;

            if ($difference == 0) {

                $db_con->query("UPDATE booking SET current_days = $reduced WHERE id = $row->id");
            }
        }
    }
}

/**
 * Checks whether a given variable is set and/or not empty
 * @param string $var - The variable we're testing
 * @return boolean True if the variable is set, False otherwise
 */
function var_set($var)
{

    if ((isset($var) && $var !== "")) {

        return TRUE;
    }

    return FALSE;
}
/**
 * 
 * @param string $user_type: the type of user. Used to set the right session variables
 * based  on its value
 * @param string $rows: the name to set session to
 */
function determine_user_set_session($user_type, $rows)
{

    session_start();

    if ($user_type == "admin") {

        $_SESSION['admin-user'] = $rows->username;

        $_SESSION['admin-fname'] = $rows->fname;

        $_SESSION['admin-lname'] = $rows->lname;

        $_SESSION['admin-id'] = $rows->id;
    } elseif ($user_type == "employee") {

        $_SESSION['staff-user'] = $rows->username;

        $_SESSION['staff-fname'] = $rows->fname;

        $_SESSION['staff-lname'] = $rows->lname;

        $_SESSION['staff-emails'] = $rows->email;

        $_SESSION['staff-id'] = $rows->staff_id;

        $_SESSION['staff-level'] = $rows->staff_level;
    } else {

        $_SESSION['supervisor-user'] = $rows->username;

        $_SESSION['supervisor-id'] = $rows->supervisor_id;

        $_SESSION['supervisor-email'] = $rows->email;

        $_SESSION['supervisor-level'] = $rows->staff_level;
    }
}
/**
 * 
 * @param String $user - The user to verify 
 * @param String $password - Password of this very user
 * @param String $tbl - The table to perform verification
 * @param String $page - Where to redirect to after successful verification
 * @return boolean 
 */

function verify_redirrect_user($user, $password, $tbl, $page)
{

    $query = "SELECT * FROM $tbl WHERE username = $user";

    if (query_db($query)) {

        if (password_verify($rows->password, PASSWORD_DEFAULT)) {

            //Verified. Start and set sessions
            determine_user_set_session($tbl);

            redirect_user("Location:$page");
        } else {
            $errors[] = urlencode("Password incorrect");
        }
    }

    return FALSE;
}

/**
 * 
 * @param string $field - the field we're checking
 * @return boolean - True if field is empty, false otherwise
 */

function is_empty($field)
{

    if ($field == '' || empty($field)) {
        return TRUE;
    }

    return FALSE;
}

/**
 * This function loads sylesheets into the workspace/page.
 */

function load_styles()
{
    include("styles.php");
}

/**
 * This function is similar to load_styles, except it loads javascript files rather than css file
 */
function load_scripts()
{
    include("scripts.php");
}

/**
 * Redirects the user to an appropriate page, if the user is logged in. Will absolutely redirect the user to login page if there's no session running/user's not logged in.
 */
function session_redirect()
{

    if (isset($_SESSION['staff-user'])) {

        redirect_user("Location:dashboard.php");
    } elseif (isset($_SESSION['supervisor-user'])) {

        redirect_user("Location:dashboard.php?type=supervisor");
    } elseif (isset($_SESSION['admin-user'])) {

        redirect_user("Location:admin.php");
    } else {

        redirect_user("index.php");
    }
}

/**
 * This is boolean function that tells whether there is an existing session in place
 * @param string $session_var The session variable to check. This is always string and cannot be any other type
 * @return boolean True if there is session and False otherwise.
 */
function is_session_inplace($session_var)
{

    if (!isset($_SESSION[$session_var])) {

        return FALSE;
    }

    return TRUE;
}

/**
 * This takes care of sending email messages to users of this system.
 * @param string $user_email he email of the user to send message to. 
 * @param string $subject Subject of the message.
 * @param string $msg The body of the message.
 * @param array $headers Addtional headers to be included in message. This includes 
 * headers such as From, cc and Bcc.
 * @return boolean Returns true if message is sent. False otherwise
 */
function mail_user($user_email, $subject, $msg, $headers = NULL)
{

    $add_h = var_set($headers) ? $headers : "";

    if (mail($user_email, $subject, $msg, $add_h)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
///ส่วนที่ 3 line แจ้งเตือน
function sendlinemesg()
{
    // LINE LINE_API https://notify-api.line.me/api/notify
    // LINE TOKEN mhIYaeEr9u3YUfSH1u7h9a9GlIx3Ry6TlHtfVxn1bEu แนะนำให้ใช้ของตัวเองนะครับเพราะของผมยกเลิกแล้วไม่สามารถใช้ได้
    define('LINE_API', "https://notify-api.line.me/api/notify");
    define('LINE_TOKEN', "4PHZSxJ2SzDLncQIW9s6gx8w2WwUOdQmqj2rBEe1Wre");

    function notify_message($message)
    {
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . LINE_TOKEN . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}
function selectAndArray()
{
    //include("db_connect.php"); // เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
    $db_con = connect(); // เชื่อมต่อกับฐานข้อมูล  
    $no = 0;
    $data = array();
    $arr = array(); //booking_applications
    $sql = "SELECT employee.staff_id, booking_applications.*
                   FROM `booking_applications`
                   INNER JOIN `employee` ON booking_applications.staff_id = employee.staff_id";
    $qry = mysqli_query($db_con, $sql) or die($db_con->showError('', __FILE__, __LINE__));
    //$qry = mysql_query($sql) or die( $db_con->showError('',__FILE__,__LINE__) );
    //while($row = mysql_fetch_assoc($qry)){  //-- วนลูปแสดงข้อมูลทั้งหมด
    while ($row = mysqli_fetch_array($qry)) {

        if ($row['action'] == "reject") {

            $active_qty  = 0;
            $expire_qty = 0;
            //-- วันที่มากกว่าหรือเท่ากับวันนี้=ใช้งานปกติ, ถ้าน้อยกว่า=หมดอายุ
            if ($row['date_requested'] >= date('Y-m-d')) {
                $active_qty = 1;
            } else {
                $expire_qty = 1;
            }
            //-- ตรวจสอบค่าเดิมของสาขานั้นๆ ถ้ามีให้เพิ่มเข้าไปด้วย
            if (isset($arr[$row['staff_id']]['active'])) {
                $active_qty += $arr[$row['staff_id']]['active'];
            }
            if (isset($arr[$row['staff_id']]['expire'])) {
                $expire_qty += $arr[$row['staff_id']]['expire'];
            }
            //-- เก็บข้อมูลไว้ในอาร์เรย์
            $arr[$row['staff_id']]['expire'] = $expire_qty;
            $arr[$row['staff_id']]['active'] = $active_qty;
            $arr[$row['staff_id']]['name'] = $row['staff_id'];
            $arr[$row['staff_id']]['1'] = $row['booking_type'];
            $arr[$row['staff_id']]['action'] = $row['action'];
            //$staff_id = $_POST['staff_id'];

        }
    }

    if (!empty($arr)) {  //-- ถ้ามีข้อมูลให้วนลูปแสดงข้อมูลทั้งหมด
        foreach ($arr as $rs) {

            $no++;
            $rs = array(
                //'ลำดับ' => $no,
                'ชื่อ' => $rs['name'],
                'จำนวน' => $rs['active'] + $rs['expire'],

            );
            $data[] = $rs;
        }
    }

    $json = array(
        'รายชื่อ' => $data
    );

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
}