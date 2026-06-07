<?php
/*
=====================================================
File Name: manage_login.php
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Login page for quiz supervisor. Accounts are locked for 5 minutes
         after 3 failed login attempts (PHP Enhancement 1).
=====================================================
*/

session_start();

if (isset($_SESSION["supervisor_logged_in"]) && $_SESSION["supervisor_logged_in"] === true) {
    header("Location: manage.php");
    exit();
}

require_once "settings.php";

$message = "";

$conn = get_db_connection();

/* Create tables */
create_attempts_table($conn);
create_supervisor_table($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim(isset($_POST["username"]) ? $_POST["username"] : "");
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    /* Escape username and use plain query - no prepared statements needed here */
    $safe_username = mysqli_real_escape_string($conn, $username);

    $result = mysqli_query($conn, "SELECT username, password_hash, failed_attempts, locked_until FROM supervisors WHERE username = '$safe_username'");

    if ($result) {

        $user_row = mysqli_fetch_assoc($result);

        if ($user_row) {

            $locked_until = $user_row["locked_until"];

            if ($locked_until != null && strtotime($locked_until) > time()) {

                $message = "This account is temporarily locked. Please try again later.";

            } elseif (md5($password) == $user_row["password_hash"]) {

                /* Correct password - reset failed attempts */
                $safe_user = mysqli_real_escape_string($conn, $username);
                mysqli_query($conn, "UPDATE supervisors SET failed_attempts = 0, locked_until = NULL WHERE username = '$safe_user'");

                mysqli_close($conn);

                $_SESSION["supervisor_logged_in"] = true;
                $_SESSION["supervisor_username"]  = $username;
                header("Location: manage.php");
                exit();

            } else {

                /* Wrong password - increment failed attempts */
                $failed = (int)$user_row["failed_attempts"] + 1;
                $safe_user = mysqli_real_escape_string($conn, $username);

                if ($failed >= 3) {
                    $lock_time = date("Y-m-d H:i:s", time() + 300);
                    mysqli_query($conn, "UPDATE supervisors SET failed_attempts = $failed, locked_until = '$lock_time' WHERE username = '$safe_user'");
                    $message = "Incorrect password. Account locked for 5 minutes after 3 failed attempts.";
                } else {
                    mysqli_query($conn, "UPDATE supervisors SET failed_attempts = $failed WHERE username = '$safe_user'");
                    $message = "Incorrect username or password.";
                }
            }

        } else {
            $message = "Incorrect username or password.";
        }

    } else {
        $message = "Query failed: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

$page_title   = "Supervisor Login";
$page_heading = "Node.js Website";
$active_page  = "manage";

include "header.inc";
?>

<main>

    <section class="section-login">

        <h2>Supervisor Login</h2>

        <p>Default credentials: username <strong>admin</strong>, password <strong>admin123</strong></p>

        <?php if ($message != "") { ?>
            <p class="error-box"><?php echo htmlspecialchars($message); ?></p>
        <?php } ?>

        <form method="post" action="manage_login.php" novalidate="novalidate">

            
                Login Details

                <p>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </p>

                <p>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </p>

                <p>
                    <input type="submit" value="Login">
                </p>

            

        </form>

    </section>

</main>

<?php include "footer.inc"; ?>
