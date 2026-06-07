<?php
/*
=====================================================
File Name: menu.inc
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Reusable navigation menu include file
         used across all website pages
=====================================================
*/

/* Default active page to empty string if not set by parent page */
if (!isset($active_page)) { $active_page = ""; }
?>
<nav>
    <ul>
        <li><a href="index.php"          class="<?php echo ($active_page == 'home')          ? 'active' : ''; ?>">Home</a></li>
        <li><a href="topic.php"          class="<?php echo ($active_page == 'topic')         ? 'active' : ''; ?>">Topic</a></li>
        <li><a href="quiz.php"           class="<?php echo ($active_page == 'quiz')          ? 'active' : ''; ?>">Quiz</a></li>
        <li><a href="enhancements1.html" class="<?php echo ($active_page == 'enhancements1') ? 'active' : ''; ?>">Enhancements 01</a></li>
        <li><a href="enhancements2.html" class="<?php echo ($active_page == 'enhancements2') ? 'active' : ''; ?>">Enhancements 02</a></li>
        <li><a href="phpenhancements.php" class="<?php echo ($active_page == 'phpenhancements') ? 'active' : ''; ?>">PHP Enhancements</a></li>
        <li><a href="manage.php"         class="<?php echo ($active_page == 'manage')        ? 'active' : ''; ?>">Manage</a></li>
    </ul>
</nav>
