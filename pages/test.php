<?php
include_once 'connection.php';

$query = "CREATE TABLE IF NOT EXISTS job_description(id INT NOT NULL 
    AUTO_INCREMENT PRIMARY KEY, staff_id BIGINT NOT NULL,
    staff_level ENUM('supervisor','non-supervisor') NOT NULL, salary_level 
    DECIMAL(100,2) NOT NULL, date_joined VARCHAR(25) NOT NULL,
    annual_booking_days_allowed INT NOT NULL, total_booking_days INT NOT NULL, 
    total_taken_bookings INT NOT NULL)";

$result = $db_con->query($query);

if (!$result) {
    $eror = $db_con->error;
    echo "<h1>You have an error in your statement. Error $eror</h1>";
}