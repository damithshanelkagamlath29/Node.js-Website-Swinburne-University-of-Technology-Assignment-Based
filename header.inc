<?php
/*
=====================================================
File Name: header.inc
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Reusable header include file containing
         the HTML document structure, metadata,
         navigation setup, and page header
=====================================================
*/

/* Default values used when a page has not set its own variables */
if (!isset($page_title))       { $page_title       = "Node.js"; }
if (!isset($page_description)) { $page_description = "Introduction to Node.js - a server-side JavaScript runtime"; }
if (!isset($page_keywords))    { $page_keywords    = "Node.js, JavaScript, PHP, MySQL, web development"; }
if (!isset($page_author))      { $page_author      = "Group Members"; }
if (!isset($page_heading))     { $page_heading     = $page_title; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords"    content="<?php echo htmlspecialchars($page_keywords); ?>">
    <meta name="author"      content="<?php echo htmlspecialchars($page_author); ?>">
    <meta name="viewport"    content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title><?php echo htmlspecialchars($page_title); ?></title>
</head>
<body>

    <!-- Background Video - enhancement using CSS/HTML video background -->
    <div class="backgroundvideo">
        <video autoplay muted loop playsinline id="bgvideo">
            <source src="images/background.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>

    <!-- Site header - appears on every page -->
    <header>
        <h1><?php echo htmlspecialchars($page_heading); ?></h1>
    </header>

    <!-- Navigation menu included from menu.inc -->
    <?php include "menu.inc"; ?>
