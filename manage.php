<?php
/*
=====================================================
File Name: manage.php
Author: Damith Shanelka Gamlath
Created: 2026
Last Modified: 2026
Purpose: Supervisor management page. Allows viewing, searching, sorting,
         updating and deleting quiz attempts. Protected by session login.
         Includes sortable results (PHP Enhancement 2).
=====================================================
*/

session_start();

if (!isset($_SESSION["supervisor_logged_in"]) || $_SESSION["supervisor_logged_in"] !== true) {
    header("Location: manage_login.php");
    exit();
}

require_once "settings.php";

$conn = get_db_connection();
create_attempts_table($conn);

$feedback = "";

/* Delete all attempts for a student */
if (isset($_GET["delete"]) && $_GET["delete"] != "") {

    $del_id = $_GET["delete"];
    $stmt = mysqli_prepare($conn, "DELETE FROM attempts WHERE student_id = ?");
    mysqli_stmt_bind_param($stmt, "s", $del_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $feedback = "All attempts for student ID " . htmlspecialchars($del_id) . " have been deleted.";
}

/* Update score for a specific attempt */
if (isset($_POST["update_score"])) {

    $upd_student_id = trim($_POST["upd_student_id"]);
    $upd_attempt_no = (int)$_POST["upd_attempt_no"];
    $upd_score      = (int)$_POST["upd_score"];

    $stmt = mysqli_prepare($conn, "UPDATE attempts SET score = ? WHERE student_id = ? AND attempt_no = ?");
    mysqli_stmt_bind_param($stmt, "isi", $upd_score, $upd_student_id, $upd_attempt_no);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $feedback = "Score updated for student ID " . htmlspecialchars($upd_student_id) . ", attempt " . $upd_attempt_no . ".";
}

/* Build main query - search or sort or list all */
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";
$allowed_sort = array("score", "student_id", "attempt_no", "attempt_datetime", "firstname", "lastname");
$sort = (isset($_GET["sort"]) && in_array($_GET["sort"], $allowed_sort)) ? $_GET["sort"] : "";

/* Use plain mysqli_query for SELECT * so we can use mysqli_fetch_assoc without get_result */
if ($search != "") {
    $safe_search = mysqli_real_escape_string($conn, $search);
    $query = "SELECT * FROM attempts WHERE student_id LIKE '%$safe_search%' OR firstname LIKE '%$safe_search%' OR lastname LIKE '%$safe_search%' ORDER BY attempt_id ASC";
} elseif ($sort != "") {
    $query = "SELECT * FROM attempts ORDER BY " . $sort . " ASC";
} else {
    $query = "SELECT * FROM attempts ORDER BY attempt_id ASC";
}

$result = mysqli_query($conn, $query);

/* Query for 100% first attempt */
$result_full = mysqli_query($conn, "SELECT firstname, lastname, student_id FROM attempts WHERE score = 100 AND attempt_no = 1 ORDER BY lastname ASC");

/* Query for less than 50% second attempt */
$result_fail = mysqli_query($conn, "SELECT firstname, lastname, student_id FROM attempts WHERE score < 50 AND attempt_no = 2 ORDER BY lastname ASC");

$page_title   = "Manage Quiz Attempts";
$page_heading = "Node.js Website";
$active_page  = "manage";

include "header.inc";
?>

<main>

<section class="bubble">

    <h2>Quiz Attempts</h2>

    <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION["supervisor_username"]); ?></strong>
    &nbsp;&mdash;&nbsp; <a href="manage_logout.php">Logout</a></p>

    <?php if ($feedback != "") { ?>
        <p class="success-box"><?php echo $feedback; ?></p>
    <?php } ?>

    <!-- Search form -->
    <form method="get" action="manage.php">
        <label for="search">Search by Student ID or Name:</label>
        <input type="text" id="search" name="search"
               value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Search">
        <?php if ($search != "") { ?>
            <a href="manage.php">Clear Search</a>
        <?php } ?>
    </form>

    <br>

    <!-- Sort form (Enhancement 2: sortable results) -->
    <form method="get" action="manage.php">
        <label for="sort">Sort By:</label>
        <select name="sort" id="sort">
            <option value="">-- Select --</option>
            <option value="score"            <?php if ($sort == "score")            echo "selected"; ?>>Score</option>
            <option value="student_id"       <?php if ($sort == "student_id")       echo "selected"; ?>>Student ID</option>
            <option value="attempt_no"       <?php if ($sort == "attempt_no")       echo "selected"; ?>>Attempt Number</option>
            <option value="attempt_datetime" <?php if ($sort == "attempt_datetime") echo "selected"; ?>>Date / Time</option>
            <option value="firstname"        <?php if ($sort == "firstname")        echo "selected"; ?>>First Name</option>
            <option value="lastname"         <?php if ($sort == "lastname")         echo "selected"; ?>>Last Name</option>
        </select>
        <input type="submit" value="Sort">
    </form>

    <br>

    <!-- Attempts table -->
    <?php if (!$result || mysqli_num_rows($result) == 0) { ?>

        <p>No attempts found.</p>

    <?php } else { ?>

        <table border="1">
            <tr>
                <th>Attempt ID</th>
                <th>Date / Time</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Student ID</th>
                <th>Attempt No.</th>
                <th>Score (%)</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars((string)$row["attempt_id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["attempt_datetime"]); ?></td>
                    <td><?php echo htmlspecialchars($row["firstname"]); ?></td>
                    <td><?php echo htmlspecialchars($row["lastname"]); ?></td>
                    <td><?php echo htmlspecialchars($row["student_id"]); ?></td>
                    <td><?php echo htmlspecialchars((string)$row["attempt_no"]); ?></td>
                    <td><?php echo htmlspecialchars((string)$row["score"]); ?>%</td>
                    <td>
                        <a href="manage.php?delete=<?php echo urlencode($row["student_id"]); ?>"
                           onclick="return confirm('Delete ALL attempts for this student?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>

        </table>

    <?php } ?>

    <br>

    <!-- Update score form -->
    <h3>Update Quiz Score</h3>

    <form method="post" action="manage.php" novalidate="novalidate">

        <p>
            <label for="upd_student_id">Student ID:</label>
            <input type="text" id="upd_student_id" name="upd_student_id" required>
        </p>

        <p>
            <label for="upd_attempt_no">Attempt Number:</label>
            <input type="number" id="upd_attempt_no" name="upd_attempt_no" min="1" max="2" required>
        </p>

        <p>
            <label for="upd_score">New Score (%):</label>
            <input type="number" id="upd_score" name="upd_score" min="0" max="100" required>
        </p>

        <p>
            <input type="submit" name="update_score" value="Update Score">
        </p>

    </form>

    <br>

    <!-- Students with 100% on first attempt -->
    <h3>Students with 100% on Their First Attempt</h3>

    <?php
    if (!$result_full || mysqli_num_rows($result_full) == 0) {
        echo "<p>No students found.</p>";
    } else {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result_full)) {
            echo "<li>" .
                htmlspecialchars($row["firstname"]) . " " .
                htmlspecialchars($row["lastname"]) . " (" .
                htmlspecialchars($row["student_id"]) . ")</li>";
        }
        echo "</ul>";
    }
    ?>

    <!-- Students with less than 50% on second attempt -->
    <h3>Students with Less Than 50% on Their Second Attempt</h3>

    <?php
    if (!$result_fail || mysqli_num_rows($result_fail) == 0) {
        echo "<p>No students found.</p>";
    } else {
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result_fail)) {
            echo "<li>" .
                htmlspecialchars($row["firstname"]) . " " .
                htmlspecialchars($row["lastname"]) . " (" .
                htmlspecialchars($row["student_id"]) . ")</li>";
        }
        echo "</ul>";
    }

    mysqli_close($conn);
    ?>

</section>

</main>

<?php include "footer.inc"; ?>
