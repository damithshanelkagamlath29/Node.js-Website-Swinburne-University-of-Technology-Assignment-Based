<?php
/*
=====================================================
File Name: phpenhancements.php
Author: Damith Shanelka Gamlath
Student Id: 106419262
Created: 2026
Last Modified: 2026
Purpose: Describes the two PHP/MySQL enhancements implemented beyond the
         basic assignment requirements
=====================================================
*/

$page_title   = "PHP Enhancements";
$page_heading = "Node.js Website";
$active_page  = "phpenhancements";

include "header.inc";
?>

<main>

    
    <header>

    <h1>PHP Enhancements</h1>

    </header>

    

<section class="section-enhancements-one">
    <h2 class="section-enhancements-one-h2">PHP / MySQL Enhancements</h2>
    <p class="section-enhancements-one-p">This page lists the PHP and MySQL enhancements implemented in this project that go beyond the basic assignment requirements. A maximum of 2 enhancements are submitted for marking.</p>
</section>

<!-- Enhancement 1: Secure Supervisor Login with Account Lockout -->
<section class="section-enhancements-two">

    <h2 class="section-enhancements-two-h2">Enhancement 1: Secure Supervisor Login with Account Lockout</h2>

    <p class="section-enhancements-two-p">
        <strong>How it goes beyond the specified requirements:</strong>
        The basic assignment only requires a supervisor page (manage.php) to be accessible. This enhancement goes further by protecting the supervisor page with a login system. A supervisor must enter a username and password before accessing manage.php. After logging out, the page cannot be entered directly by typing the URL. The account is also locked for 5 minutes after 3 consecutive failed login attempts, providing protection against brute-force attacks.
    </p>

    <p class="section-enhancements-two-p">
        <strong>What a programmer must do to implement this feature:</strong>
    </p>
    <ul class="section-enhancements-two-ul">
        <li>Create a <code>supervisors</code> table with columns for <code>username</code>, <code>password_hash</code>, <code>failed_attempts</code>, and <code>locked_until</code>.</li>
        <li>Store the password as a PHP <code>password_hash()</code> hash (not plaintext).</li>
        <li>Use <code>session_start()</code> and set <code>$_SESSION["supervisor_logged_in"] = true</code> on successful login.</li>
        <li>At the top of manage.php, check the session variable and redirect to manage_login.php if not set.</li>
        <li>In manage_login.php, track failed attempts and set <code>locked_until</code> to 5 minutes in the future after 3 failures.</li>
        <li>Create manage_logout.php which destroys the session and redirects to manage_login.php.</li>
    </ul>

    <p class="section-enhancements-two-p">
        This can be seen in: <a href="manage_login.php" class="section-enhancements-two-link">manage_login.php</a> and
        <a href="manage.php" class="section-enhancements-two-link">manage.php</a>.
    </p>

</section>

<!-- Enhancement 2: Sortable Supervisor Results -->
<section class="section-enhancements-three">

    <h2 class="section-enhancements-three-h2">Enhancement 2: Sortable Supervisor Query Results</h2>

    <p class="section-enhancements-three-p">
        <strong>How it goes beyond the specified requirements:</strong>
        The basic assignment only requires fixed supervisor queries (list all, search by id/name, etc.). This enhancement allows the supervisor to choose which column the query results are sorted by &mdash; such as attempt ID, date and time, student name, attempt number, or score. This improves usability when viewing large result sets.
    </p>

    <p class="section-enhancements-three-p">
        <strong>What a programmer must do to implement this feature:</strong>
    </p>
    <ul class="section-enhancements-three-ul">
        <li>Define an <code>$allowed_sort</code> array listing all valid column names (whitelist).</li>
        <li>Read the selected field from <code>$_POST["sort_field"]</code> and validate it against the whitelist to prevent SQL injection via the ORDER BY clause.</li>
        <li>Append <code>ORDER BY $sort_field</code> to all queries on manage.php.</li>
        <li>Add a <code>&lt;select&gt;</code> dropdown in the form so the supervisor can choose the sort order before submitting any query.</li>
        <li>Pass the selected sort field as a hidden input in every other form on the page so the preference is remembered across actions.</li>
    </ul>

    <p class="section-enhancements-three-p">
        This can be seen in: <a href="manage.php" class="section-enhancements-three-link">manage.php</a>.
    </p>

</section>

</main>

<?php include "footer.inc"; ?>
