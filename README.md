# HackerNews

Winter Project 2020 - 2021

# Assignment

You're going to create a Hacker News clone. Prepare a short presentation of your project which you're going to present for the entire class on January 14, 2021. Add the link to your public GitHub repository in this Google Sheet.

Make sure your project includes all the default features and any optional extra features. Please also make sure the all requirements are fulfilled before sending us your project.

Bonus points for consistent syntax including correct indentation, readable and well documented code!

# Features

Below you'll find a list of user stories. This is the behavior on how the user interact with the application. You'll show all features during your presentation.

:ballot_box_with_check: As a user I should be able to create an account. <br>
:ballot_box_with_check: As a user I should be able to login.<br>
:ballot_box_with_check: As a user I should be able to logout.<br>
:ballot_box_with_check: As a user I should be able to edit my account email, password and biography.<br>
:ballot_box_with_check: As a user I should be able to upload a profile avatar image.<br>
:ballot_box_with_check: As a user I should be able to create new posts with title, link and description.<br>
:ballot_box_with_check: As a user I should be able to edit my posts.<br>
:ballot_box_with_check: As a user I should be able to delete my posts.<br>
:ballot_box_with_check: As a user I'm able to view most upvoted posts.<br>
:ballot_box_with_check: As a user I'm able to view new posts.<br>
:ballot_box_with_check: As a user I should be able to upvote posts.<br>
:ballot_box_with_check: As a user I should be able to remove upvote from posts.<br>
:ballot_box_with_check: As a user I'm able to comment on a post.<br>
:ballot_box_with_check: As a user I'm able to edit my comments.<br>
:ballot_box_with_check: As a user I'm able to delete my comments.<br>

## Extra features [View pull request](https://github.com/MadosMark/HackerNews/pull/2)
- As a user I'm able to reply to comments. [View commit](https://github.com/MadosMark/HackerNews/pull/2/commits/d06b4cadf98b5e01245d2a60a47161ae537cb19b)
- As a user I'm able to upvote and remove upvote on comments. [View commit](https://github.com/MadosMark/HackerNews/pull/2/commits/f4b034136008f6c4dfbb32c25fecd8c7ac149430)
- As a user I'm able to delete my account along with all posts, upvotes and comments. [View commit](https://github.com/MadosMark/HackerNews/pull/2/commits/5d690b2e8c767616569df48e123c535b93007a6c)

# Review
## Code review by Hugo Sundberg

* Sorting by popular posts only shows posts with upvotes. Ignores posts without upvotes. Possible solution is to use 'ifnull' in SQLite. 
* Inconsistent folder names. 'Assets' in capital. (nitpick, mine is more inconsistent)
* Functions for database communications is great. Easily readable and reusable
* The variable name 'database' in upvoteFunctions.php on row 8 could be confusing since it is an SQL string and not a connection to a database.  
* Search doesnt work and breaks site when used on profile page
* Tip: You can use '<?=' instead of '<?php echo' to save finger strenght. 
* Site checks for password length on change but not on sign up
* Site scroll jumps to the top on reload. Solution for this could be to save the current 'scrollY' value in 'window.sessionStorage.'
