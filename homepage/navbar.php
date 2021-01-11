<body>
    <div class="top_nav">
        <p class="page_title">Hacker News</p>
        <ul class="nav_bar">



            <li class="">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
            </li>

            <li class="">
                <a href="/postCreator.php"> New Post </a>
            </li>


            <li class="">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/about.php' ? 'active' : ''; ?>" href="/about.php">About</a>
            </li>
            <?php if (isset($_SESSION['user'])) : ?>

                <li class="">
                    <a href="/profile.php?username=<?php echo $_SESSION['user']['username']; ?>"> <?php echo $_SESSION['user']['username']; ?> </a>
                </li>



                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="">
                        <a href="web/user/logout.php">Log Out</a>
                    </li>
                <?php endif; ?>

            <?php else : ?>
                <li class="">
                    <a href="loginPage.php">Log In</a>
                </li>

                <li class="">
                    <a href="signUp.php">Sign up</a>
                </li>

            <?php endif; ?>

        </ul>
    </div>