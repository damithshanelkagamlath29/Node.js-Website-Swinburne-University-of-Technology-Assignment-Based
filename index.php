<?php
/*
=====================================================
File Name: index.php
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Introduction and home page for the Node.js website
=====================================================
*/

$page_title       = "Node.js - Home";
$page_description = "Introduction to Node.js - a server-side JavaScript runtime environment";
$page_keywords    = "Node.js, JavaScript, web development, server-side";
$page_author      = "Jayasanka Sadaruwan";
$page_heading     = "Node.js Website";
$active_page      = "home";

include "header.inc";
?>

<!-- Section 1: Welcome introduction -->
<main>

    <header>

    <h1>Home</h1>

    </header>

    <section class="section-index-one">
        <h2 class="section-index-one-h2">Welcome to Node.js</h2>
        <p class="section-index-one-p">Node.js is a popular web technology that allows developers to run JavaScript outside the browser. It is mainly used for server-side programming and helps developers build fast and scalable web applications. Node.js is well known for its speed, efficiency, and ability to handle many connections at the same time.</p>
        <p class="section-index-one-p">This website introduces Node.js and explains its main features, uses, and importance in modern web development. You can visit the topic page to learn more details, try the quiz page to test your knowledge, and view the enhancements page to see any extra features added to the website.</p>
    </section>

    <!-- Section 2: Why learn Node.js -->
    <section class="section-index-two">
        <h2 class="section-index-two-h2">Why Learn Node.js?</h2>
        <p class="section-index-two-p">Node.js is widely used in industry because it supports real-time applications, efficient server performance, and JavaScript-based development. Since both the frontend and backend can use JavaScript, it makes development easier and more consistent for many programmers.</p>
    </section>

    <!-- Section 3: Project video link -->
    <section class="section-index-three">
        <h2 class="section-index-three-h2">Project Video</h2>
        <p class="section-index-three-p">Watch our short project demonstration video here:
            <a href="https://youtu.be/-70Wd7iziP8?si=LYhcgawwGF9VVB3L" class="section-index-three-link" target="_blank" rel="noopener noreferrer">Node.js Website Demonstration</a>
        </p>
    </section>

</main>

<?php include "footer.inc"; ?>
