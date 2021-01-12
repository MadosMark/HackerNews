<body>
    <div class="top_nav">
        <p class="page_title">Hacker News</p>
        <ul class="nav_bar">
            <li>
                <a <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
            </li>
            <li>
                <a href="/postCreator.php"> New Post </a>
            </li>
            <li>
                <a <?php echo $_SERVER['SCRIPT_NAME'] === '/popularPosts.php' ? 'active' : ''; ?>" href="/popularPosts.php">Popular Posts</a>
            </li>
            <?php if (isset($_SESSION['user'])) : ?>
                <li>
                    <a href="/profile.php?username=<?php echo $_SESSION['user']['username']; ?>"> <?php echo $_SESSION['user']['username']; ?> </a>
                </li>
                <?php if (isset($_SESSION['user'])) : ?>
                    <li>
                        <a href="web/user/logout.php">Log Out</a>
                    </li>
                <?php endif; ?>
            <?php else : ?>
                <li>
                    <a href="loginPage.php">Log In</a>
                </li>
                <li>
                    <a href="signUp.php">Sign up</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>