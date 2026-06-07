<?php
/*
=====================================================
File Name: settings.php
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Database connection settings and helper functions for Assignment Part 2
=====================================================
*/

$host   = "feenix-mariadb.swin.edu.au";
$user   = "s106398824";
$pwd    = "190506";
$sql_db = "s106398824_db";

/* Returns an active mysqli connection or dies with error */
function get_db_connection() {
    global $host, $user, $pwd, $sql_db;
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    if (!$conn) {
        die("<main><section><h2>Database Connection Error</h2><p>Could not connect to the database.</p></section></main>");
    }
    return $conn;
}

/* Creates the attempts table if it does not already exist */
function create_attempts_table($conn) {
    $query = "CREATE TABLE IF NOT EXISTS attempts (
        attempt_id       INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        attempt_datetime DATETIME NOT NULL,
        firstname        VARCHAR(30) NOT NULL,
        lastname         VARCHAR(30) NOT NULL,
        student_id       VARCHAR(10) NOT NULL,
        attempt_no       TINYINT NOT NULL,
        score            INT NOT NULL
    )";
    mysqli_query($conn, $query);
}

/* Creates the supervisors table and inserts default admin account */
function create_supervisor_table($conn) {
    $query = "CREATE TABLE IF NOT EXISTS supervisors (
        supervisor_id   INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username        VARCHAR(30) NOT NULL UNIQUE,
        password_hash   VARCHAR(255) NOT NULL,
        failed_attempts INT NOT NULL DEFAULT 0,
        locked_until    DATETIME NULL
    )";
    mysqli_query($conn, $query);

    /* Insert default admin account if table is empty */
    $count_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM supervisors");
    $count_row    = mysqli_fetch_assoc($count_result);

    if ($count_row && (int)$count_row["total"] === 0) {
        /* Use md5 for compatibility with older PHP on Mercury */
        /* Password is: admin123 */
        $default_hash = md5("admin123");
        mysqli_query($conn, "INSERT INTO supervisors (username, password_hash) VALUES ('admin', '$default_hash')");
    }
}
?>
