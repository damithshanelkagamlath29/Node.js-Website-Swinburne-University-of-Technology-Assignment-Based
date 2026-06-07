<?php
/*
=====================================================
File Name: markquiz.php
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Validates, marks and stores Node.js quiz attempts using mysqli prepared statements.
         Server-side validation mirrors the HTML5 client-side checks.
=====================================================
*/
 
$page_title       = "Quiz Result";
$page_description = "Node.js quiz result page";
$page_keywords    = "Node.js, quiz, result";
$page_author      = "Group Members";
$page_heading     = "Node.js Website";
$active_page      = "quiz";
 
include "header.inc";
require_once "settings.php";
 
/* =====================================================
   sanitise_input($data)
   Trims, strips slashes and escapes HTML special characters
   ===================================================== */
function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}
 
/* Collect all errors into this array */
$errors = array();
$score  = 0;
 
/* =====================================================
   CHECK REQUEST METHOD
   ===================================================== */
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $errors[] = "Please submit the quiz form before opening this page.";
}
 
/* =====================================================
   GET AND SANITISE FORM DATA
   ===================================================== */
$firstname = sanitise_input(isset($_POST["firstname"]) ? $_POST["firstname"] : "");
$lastname  = sanitise_input(isset($_POST["lastname"])  ? $_POST["lastname"]  : "");
$studentid = sanitise_input(isset($_POST["studentid"]) ? $_POST["studentid"] : "");
$q1        = sanitise_input(isset($_POST["q1"])        ? $_POST["q1"]        : "");
$q2        = sanitise_input(isset($_POST["q2"])        ? $_POST["q2"]        : "");
$q3        = isset($_POST["q3"])                       ? $_POST["q3"]        : array();
$q4        = sanitise_input(isset($_POST["q4"])        ? $_POST["q4"]        : "");
$q5        = sanitise_input(isset($_POST["q5"])        ? $_POST["q5"]        : "");
 
/* =====================================================
   SERVER-SIDE VALIDATION
   ===================================================== */
 
/* First name: not empty, letters/spaces/hyphens, max 30 */
if ($firstname == "") {
    $errors[] = "First name is required.";
} elseif (!preg_match("/^[A-Za-z\s\-]{1,30}$/", $firstname)) {
    $errors[] = "First name must contain only letters, spaces, or hyphens and must be 30 characters or fewer.";
}
 
/* Last name: not empty, letters/spaces/hyphens, max 30 */
if ($lastname == "") {
    $errors[] = "Last name is required.";
} elseif (!preg_match("/^[A-Za-z\s\-]{1,30}$/", $lastname)) {
    $errors[] = "Last name must contain only letters, spaces, or hyphens and must be 30 characters or fewer.";
}
 
/* Student ID: exactly 7 or 10 digits */
if ($studentid == "") {
    $errors[] = "Student number is required.";
} elseif (!preg_match("/^([0-9]{7}|[0-9]{10})$/", $studentid)) {
    $errors[] = "Student number must be exactly 7 or 10 digits.";
}
 
/* All questions must be answered */
if ($q1 == "") {
    $errors[] = "Question 1 was not completed.";
}
if ($q2 == "") {
    $errors[] = "Question 2 was not completed (please select a radio button).";
}
if (!is_array($q3) || count($q3) == 0) {
    $errors[] = "Question 3 was not completed (please select at least one checkbox).";
}
if ($q4 == "") {
    $errors[] = "Question 4 was not completed (please choose from the dropdown).";
}
if ($q5 == "") {
    $errors[] = "Question 5 was not completed.";
}
 
/* =====================================================
   MARK QUIZ (only if validation passed so far)
   Score: 1 point per question, 5 questions total => displayed as percentage
   ===================================================== */
if (count($errors) == 0) {
 
    /* Q1: Who created Node.js? */
    if (strtolower(trim($q1)) == "ryan dahl") {
        $score++;
    }
 
    /* Q2: Main language used with Node.js */
    if ($q2 == "JavaScript") {
        $score++;
    }
 
    /* Q3: Common uses - correct answers are Web servers, Real-time applications, API development */
    $correct_q3 = array("Web servers", "Real-time applications", "API development");
    /* Sanitise checkbox values */
    $user_q3 = array();
    foreach ($q3 as $answer) {
        $user_q3[] = sanitise_input($answer);
    }
    sort($correct_q3);
    sort($user_q3);
    if ($user_q3 == $correct_q3) {
        $score++;
    }
 
    /* Q4: Company behind V8 engine */
    if ($q4 == "Google") {
        $score++;
    }
 
    /* Q5: Benefit of Node.js - keyword-based check */
    $q5_lower    = strtolower(trim($q5));
    $keywords    = array("fast", "speed", "scalable", "real-time", "real time", "non-blocking", "efficient", "javascript", "server", "npm", "performance");
    foreach ($keywords as $word) {
        if (strpos($q5_lower, $word) !== false) {
            $score++;
            break;
        }
    }
    /* Fallback: any answer of 10+ characters gets the mark */
    if ($score < 5 && strlen($q5) >= 10) {
        $score++;   /* Will only add once due to marking logic above */
    }
 
    /* Convert to percentage (5 questions x 20 = 100%) */
    $percentage_score = $score * 20;
 
    /* Block zero-score submission */
    if ($percentage_score == 0) {
        $errors[] = "The quiz score was zero. Please check your answers and try again.";
    }
}
 
/* =====================================================
   DATABASE: CHECK ATTEMPTS AND INSERT RECORD
   Uses prepared statements to prevent SQL injection
   ===================================================== */
if (count($errors) == 0) {
 
    $conn = get_db_connection();
    create_attempts_table($conn);
 
    /* Count existing attempts for this student */
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total_attempts FROM attempts WHERE student_id = ?");
    mysqli_stmt_bind_param($stmt, "s", $studentid);
    mysqli_stmt_execute($stmt);
    $result       = mysqli_stmt_get_result($stmt);
    $row          = mysqli_fetch_assoc($result);
    $total_attempts = (int)$row["total_attempts"];
    mysqli_stmt_close($stmt);
 
    /* Block if student already has 2 attempts */
    if ($total_attempts >= 2) {
        $errors[] = "This student has already completed two attempts. No more attempts are allowed.";
    } else {
 
        /* Calculate attempt number and generate datetime using PHP */
        $attempt_no       = $total_attempts + 1;
        $attempt_datetime = date("Y-m-d H:i:s");
 
        /* Insert the new attempt record */
        $stmt = mysqli_prepare($conn, "INSERT INTO attempts (attempt_datetime, firstname, lastname, student_id, attempt_no, score) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssii", $attempt_datetime, $firstname, $lastname, $studentid, $attempt_no, $percentage_score);
        $insert_success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
 
        if (!$insert_success) {
            $errors[] = "The attempt could not be saved to the database. Please try again.";
        }
    }
 
    mysqli_close($conn);
}
?>
 
<main>
 
<?php if (count($errors) > 0) { ?>
 
    <!-- Display error page with reasons for failure -->
    <section class="section-result">
        <h2>Quiz Submission Failed</h2>
        <p>The attempt was not stored because of the following reason(s):</p>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php } ?>
        </ul>
        <p><a href="quiz.php" >Return to Quiz</a></p>
    </section>
 
<?php } else { ?>
 
    <!-- Display success page with score and details -->
    <section class="section-result">
        <h2>Quiz Submitted Successfully</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($firstname . " " . $lastname); ?></p>
        <p><strong>Student ID:</strong> <?php echo htmlspecialchars($studentid); ?></p>
        <p><strong>Score for this attempt:</strong> <?php echo htmlspecialchars((string)$percentage_score); ?>%</p>
        <p><strong>Number of attempts made:</strong> <?php echo htmlspecialchars((string)$attempt_no); ?></p>
 
        <?php
        /* Show retry link only if this was their first attempt */
        if ($attempt_no == 1) { ?>
            <p><a href="quiz.php" >Have another attempt at the quiz</a></p>
        <?php } ?>
 
    </section>
 
<?php } ?>
 
</main>
 
<?php include "footer.inc"; ?>
 