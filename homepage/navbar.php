<body>
    <!-- <span class="topnav">
        <a href="newPost.php"> New Posts </a>
        <a href="">Comments</a>
        <a href="">Submit</a>
        <a href="">Ask</a>
        <?php if (isset($_SESSION['user'])) : ?>
            <a class="nav-link" href="/web/user/logout.php">Logout</a>
        <?php else : ?>
            <a href="loginPage.php"> Log In</a>
            <a href="signUp.php">Sign up</a>
        <?php endif; ?>

    </span> -->
    <div class="topnav">

        <ul class="navbar-nav">
            <li>
                <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
            </li><!-- /nav-item -->

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/about.php' ? 'active' : ''; ?>" href="/about.php">About</a>
            </li><!-- /nav-item -->
            <?php if (isset($_SESSION['user'])) : ?>

                <div class="rightNav">
                    <li class="nav-item">
                        <a href="profile.php?username=<?php echo $_SESSION['user']['username']; ?>"> <?php echo $_SESSION['user']['username']; ?> </a>
                    </li>

                    <?php if (isset($_SESSION['user'])) : ?>

                        <li class="nav-item">
                            <a href="/user/logout.php">Sign out</a>
                        </li>
                    <?php endif; ?>




                <?php else : ?>
                    <li class="nav-item">
                        <a href="loginPage.php">login</a>
                    </li>

                    <li class="nav-item">
                        <a href="signUp.php">Sign up</a>
                    </li>

                <?php endif; ?>
                </div>

                <!-- <li class="nav-item">
                <?php if (isset($_SESSION['user'])) : ?>
                    <a class="nav-link" href="/web/user/logout.php">Log out</a>
                <?php else : ?>
                    <a class="nav-link" <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/loginPage.php">Log in</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/register.php' ? 'active' : ''; ?>" href="/signUp.php">Sign Up</a>
            </li>/nav-item -->
        </ul><!-- /navbar-nav -->
    </div><!-- /navbar -->