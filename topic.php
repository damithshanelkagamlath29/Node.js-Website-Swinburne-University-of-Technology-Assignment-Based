<?php
/*
=====================================================
File Name: topic.php
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Detailed topic page describing Node.js technology,
         features, comparisons, advantages, and usage
=====================================================
*/

$page_title       = "Node.js - Topic";
$page_description = "Detailed description of Node.js technology, history, features and comparisons";
$page_keywords    = "Node.js, JavaScript, server-side, Ryan Dahl, npm, V8 engine";
$page_author      = "Geenod Bogoda";
$page_heading     = "Node.js Website";
$active_page      = "topic";

include "header.inc";
?>

<main>

    <header>

    <h1>Topic</h1>

    </header>

<!-- Section 1: What is Node.js -->
<section class="section-topic-one">

    <h2 class="section-topic-one-h2">What is Node.js?</h2>

    <p class="section-topic-one-p">Node.js is a server-side JavaScript runtime environment that allows developers to run JavaScript outside of a web browser. It is mainly used for building fast and scalable web applications, especially for backend services such as APIs and real-time systems. Node.js uses an event-driven, non-blocking input/output model which makes it efficient and suitable for handling multiple connections at the same time.</p>

    <p class="section-topic-one-p">Node.js was created to overcome limitations of traditional server-side technologies that struggled with performance and scalability. It is widely used in modern web development because it allows developers to use a single programming language (JavaScript) for both frontend and backend development. This reduces complexity and improves productivity. Today, Node.js is used in many applications including chat apps, streaming services, and online platforms due to its speed and flexibility.</p>

</section>

<!-- Aside: Key facts panel - floats right at 30% width per spec -->
<aside>
    <h2>Key Facts</h2>
    <dl>
        <div>
            <dt>Purpose</dt>
            <dd>Run JavaScript on the server side</dd>
        </div>
        <div>
            <dt>Developer</dt>
            <dd>Ryan Dahl (2009)</dd>
        </div>
        <div>
            <dt>Managed by</dt>
            <dd>OpenJS Foundation</dd>
        </div>
        <div>
            <dt>Language</dt>
            <dd>JavaScript (V8 engine)</dd>
        </div>
        <div>
            <dt>Package Manager</dt>
            <dd>npm (Node Package Manager)</dd>
        </div>
    </dl>
</aside>

<!-- Section 2: Development and features -->

<section class="section-topic-two">

    <h2 class="section-topic-two-h2">Development and Features</h2>

    <p class="section-topic-two-p">Node.js was first introduced in 2009 by Ryan Dahl to improve the performance of web servers. It uses the V8 JavaScript engine developed by Google, which allows fast execution of JavaScript code. Over time, Node.js has grown rapidly with support from a large developer community and the availability of npm (Node Package Manager), which provides thousands of reusable packages.</p>

    <h3 class="section-topic-two-h3">Main Features</h3>

    <ol>
        <li>Asynchronous and non-blocking operations</li>
        <li>High performance using the V8 JavaScript engine</li>
        <li>Large ecosystem through npm (over one million packages)</li>
        <li>Single-threaded event loop for handling many connections</li>
        <li>Cross-platform support (Windows, macOS, Linux)</li>
    </ol>

</section>

<!-- Section 3: Illustration with figure -->
<section class="section-topic-three">

    <h2 class="section-topic-three-h2">Illustration</h2>

    <figure class="section-topic-three-figure">
        <a href="https://nodejs.org/en" target="_blank" rel="noopener noreferrer">
            <img src="images/topic_image.png" class="section-topic-three-figure-img" alt="Node.js official logo and branding image">
        </a>
        <figcaption class="section-three-figcaption">Node.js logo. <strong>(Click the image to visit the official website)</strong></figcaption>
    </figure>

</section>

<!-- Section 4: Comparison table -->
<section class="section-topic-four">

    <h2 class="section-topic-four-h2">Comparison with Other Technologies</h2>

    <p class="section-topic-four-p">Node.js is often compared with traditional backend technologies like PHP and Python. Each has its own strengths and is suited to different types of applications.</p>

    <table class="section-topic-four-table">
        <caption class="section-topic-four-caption">Comparison of Node.js with other backend technologies</caption>
        <thead>
            <tr>
                <th>Technology</th>
                <th>Main Use</th>
                <th>Strength</th>
                <th>Limitation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Node.js</td>
                <td>Web backend / APIs</td>
                <td>Fast and scalable, real-time</td>
                <td>Not ideal for CPU-heavy tasks</td>
            </tr>
            <tr>
                <td>PHP</td>
                <td>Web development</td>
                <td>Easy to learn, large community</td>
                <td>Slower performance under load</td>
            </tr>
            <tr>
                <td>Python</td>
                <td>General programming</td>
                <td>Versatile, great for data science</td>
                <td>Slower for real-time apps</td>
            </tr>
            <tr>
                <td>Ruby on Rails</td>
                <td>Web applications</td>
                <td>Fast development, clean code</td>
                <td>Performance limitations at scale</td>
            </tr>
        </tbody>
    </table>

</section>

<!-- Section 5: Advantages, challenges, modern usage -->
<section class="section-topic-seven">

    <h2 class="section-topic-seven-h2">Advantages, Challenges, and Modern Usage</h2>

    <p class="section-topic-seven-p">Node.js has become one of the most popular technologies in modern web development because of its speed, scalability, and flexibility. One major advantage of Node.js is its asynchronous and non-blocking architecture, which allows servers to handle multiple client requests efficiently without slowing down system performance. This makes Node.js highly suitable for real-time applications such as online chats, multiplayer games, streaming services, and APIs.</p>

    <p class="section-topic-seven-p">Another important advantage is the use of JavaScript for both frontend and backend development. Developers can work with a single programming language across the entire application, reducing development complexity and improving productivity. In addition, the npm ecosystem provides thousands of reusable packages that help developers build applications more quickly and efficiently.</p>

    <p class="section-topic-seven-p">Despite its advantages, Node.js also has some limitations. Since Node.js is single-threaded, it is not always the best choice for CPU-intensive tasks such as heavy image processing, machine learning, or scientific computing. Applications that require large computational workloads may experience performance bottlenecks if not designed carefully.</p>

    <p class="section-topic-seven-p">Security is another important consideration in Node.js applications. Developers must properly validate user input, sanitize data, and protect databases from vulnerabilities such as SQL injection and cross-site scripting attacks. Secure coding practices are essential when building production-level Node.js applications.</p>

    <p class="section-topic-seven-p">Node.js is widely used in industry by companies such as Netflix, PayPal, LinkedIn, and Uber because it performs well under high traffic and supports scalable web services. Its event-driven architecture allows applications to efficiently manage thousands of simultaneous connections while maintaining fast response times.</p>

</section>

<!-- Section 6: Important terms / definition list -->
<section class="section-topic-five">

    <h2 class="section-topic-five-h2">Important Terms</h2>

    <dl class="section-topic-five-dl">
        <dt class="section-topic-five-dt">Runtime Environment</dt>
        <dd class="section-topic-five-dd">A platform where code is executed outside the browser environment</dd>

        <dt class="section-topic-five-dt">Non-blocking I/O</dt>
        <dd class="section-topic-five-dd">Allows multiple operations to run without waiting for each one to finish</dd>

        <dt class="section-topic-five-dt">npm</dt>
        <dd class="section-topic-five-dd">Node Package Manager &mdash; used to install and manage JavaScript libraries</dd>

        <dt class="section-topic-five-dt">V8 Engine</dt>
        <dd class="section-topic-five-dd">Google's open-source JavaScript engine that compiles JavaScript to machine code</dd>

        <dt class="section-topic-five-dt">Event Loop</dt>
        <dd class="section-topic-five-dd">The mechanism that allows Node.js to perform non-blocking operations</dd>
    </dl>

</section>

<!-- Section 7: References -->
<section class="section-topic-six">

    <h2 class="section-topic-six-h2">References</h2>

    <p class="section-topic-six-p">
        The following references were used to research and prepare the content on this page.
    </p>

    <ul class="section-topic-six-ul">

        <li>
            <a href="https://nodejs.org/en"
               target="_blank"
               rel="noopener noreferrer"
               class="section-topic-six-link">
               Node.js Official Website
            </a>
        </li>

        <li>
            <a href="https://developer.mozilla.org/en-US/docs/Learn/Server-side/Express_Nodejs/Introduction"
               target="_blank"
               rel="noopener noreferrer"
               class="section-topic-six-link">
               MDN Web Docs – Node.js Introduction
            </a>
        </li>

        <li>
            <a href="https://www.w3schools.com/nodejs/"
               target="_blank"
               rel="noopener noreferrer"
               class="section-topic-six-link">
               W3Schools – Node.js Tutorial
            </a>
        </li>

        <li>
            <a href="https://nodejs.dev/en/learn/"
               target="_blank"
               rel="noopener noreferrer"
               class="section-topic-six-link">
               Node.js Learn Documentation
            </a>
        </li>

    </ul>

</section>

</main>

<?php include "footer.inc"; ?>
