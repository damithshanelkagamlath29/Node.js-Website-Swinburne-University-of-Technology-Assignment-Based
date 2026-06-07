<?php
/*
=====================================================
File Name: quiz.php
Author: Damith Shanelka
Created: 2026
Last Modified: 2026
Purpose: Node.js quiz form page - collects student details and quiz answers
         novalidate added so server-side validation in markquiz.php can be tested
=====================================================
*/

$page_title       = "Node.js - Quiz";
$page_description = "Node.js knowledge quiz - test what you know";
$page_keywords    = "Node.js, quiz, JavaScript";
$page_author      = "Tharusha Rukshan";
$page_heading     = "Node.js Website";
$active_page      = "quiz";

include "header.inc";
?>

    <header>

    <h1>Quiz</h1>

    </header>

<section class="section-quiz-one">
    <h2 class="section-quiz-one-h2">Quiz Form</h2>
    <p class="section-quiz-one-p">Test your understanding of Node.js by answering the following quiz questions.
        Please complete all required fields before submitting your attempt.
        You are allowed a maximum of two quiz attempts.</p>
</section>

<main>

    

    <!-- novalidate enables server-side validation testing as required by spec -->
    <form method="post" action="markquiz.php" novalidate="novalidate">

        <!-- Student Details -->
        <section class="section-quiz-two">
            <fieldset>
                <legend>Student Details</legend>

                <p>
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" required
                           pattern="[A-Za-z\s\-]{1,30}" maxlength="30"
                           title="First name: letters, spaces or hyphens only, max 30 characters.">
                </p>
                <p>
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" required
                           pattern="[A-Za-z\s\-]{1,30}" maxlength="30"
                           title="Last name: letters, spaces or hyphens only, max 30 characters.">
                </p>
                <p>
                    <label for="studentid">Student Number</label>
                    <input type="text" id="studentid" name="studentid" required
                           pattern="^\d{7}$|^\d{10}$"
                           title="Student number must be exactly 7 or 10 digits.">
                </p>

            </fieldset>
        </section>

        <!-- Question 1: Text input -->
        <section class="section-quiz-three">
            <fieldset>
                <legend>Question 1 &mdash; Text Input</legend>
                <p>
                    <label for="q1">Who created Node.js?</label>
                    <input type="text" id="q1" name="q1" required>
                </p>
            </fieldset>
        </section>

        <!-- Question 2: Radio buttons - single correct answer -->
        <section class="section-quiz-four">
            <fieldset>
                <legend>Question 2 &mdash; Radio Button</legend>
                <p class="section-quiz-four-question">Which programming language is mainly used with Node.js?</p>
                <p>
                    <input type="radio" id="q2a" name="q2" value="Java" required>
                    <label for="q2a">Java</label>
                </p>
                <p>
                    <input type="radio" id="q2b" name="q2" value="Python">
                    <label for="q2b">Python</label>
                </p>
                <p>
                    <input type="radio" id="q2c" name="q2" value="JavaScript">
                    <label for="q2c">JavaScript</label>
                </p>
                <p>
                    <input type="radio" id="q2d" name="q2" value="C++">
                    <label for="q2d">C++</label>
                </p>
            </fieldset>
        </section>

        <!-- Question 3: Checkboxes - multiple correct answers -->
        <section class="section-quiz-five">
            <fieldset>
                <legend>Question 3 &mdash; Check Boxes (select all that apply)</legend>
                <p>Which of the following are common uses of Node.js?</p>
                <p>
                    <input type="checkbox" id="q3a" name="q3[]" value="Web servers">
                    <label for="q3a">Web servers</label>
                </p>
                <p>
                    <input type="checkbox" id="q3b" name="q3[]" value="Real-time applications">
                    <label for="q3b">Real-time applications</label>
                </p>
                <p>
                    <input type="checkbox" id="q3c" name="q3[]" value="Database management system">
                    <label for="q3c">Database management system</label>
                </p>
                <p>
                    <input type="checkbox" id="q3d" name="q3[]" value="API development">
                    <label for="q3d">API development</label>
                </p>
            </fieldset>
        </section>

        <!-- Question 4: Drop-down list -->
        <section class="section-quiz-six">
            <fieldset>
                <legend>Question 4 &mdash; Drop-down List</legend>
                <p>
                    <label for="q4">Which company developed the V8 JavaScript engine used by Node.js?</label>
                    <select id="q4" name="q4" required>
                        <option value="">Please select an option</option>
                        <option value="Google">Google</option>
                        <option value="Microsoft">Microsoft</option>
                        <option value="Netflix">Netflix</option>
                        <option value="Apple">Apple</option>
                    </select>
                </p>
            </fieldset>
        </section>

        <!-- Question 5: Textarea (5th input type) -->
        <section class="section-quiz-seven">
            <fieldset>
                <legend>Question 5 &mdash; Text Area</legend>
                <p>
                    <label for="q5">In your own words, write one benefit of using Node.js:</label>
                </p>
                <p>
                    <textarea id="q5" name="q5" rows="5" cols="40"
                              placeholder="Write your answer here (at least 10 characters)..." required></textarea>
                </p>
            </fieldset>

            <p>
                <input type="submit" value="Submit Quiz">
                <input type="reset"  value="Reset Quiz">
            </p>

        </section>

    </form>

</main>

<?php include "footer.inc"; ?>
