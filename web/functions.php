<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

require __DIR__ . '/functions/userFunction.php';
require __DIR__ . '/functions/postsFunction.php';
require __DIR__ . '/functions/commentsFunction.php';
require __DIR__ . '/functions/upvoteFunctions.php';
