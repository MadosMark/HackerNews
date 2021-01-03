<body>
    <div class="topnav">
        <ul class="navbar-nav">
            <li>
                <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/about.php' ? 'active' : ''; ?>" href="/about.php">About</a>
            </li>
            <?php if (isset($_SESSION['user'])) : ?>

                <li class="nav-item">
                    <a href="/profile.php?username=<?php echo $_SESSION['user']['username']; ?>"> <?php echo $_SESSION['user']['username']; ?> </a>
                </li>

                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a href="web/user/logout.php">Log Out</a>
                    </li>
                <?php endif; ?>

            <?php else : ?>
                <li class="nav-item">
                    <a href="loginPage.php">Log In</a>
                </li>

                <li class="nav-item">
                    <a href="signUp.php">Sign up</a>
                </li>

            <?php endif; ?>

        </ul>
    </div>