<?php
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/inc/helpers.php";

if (file_exists("./env")) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} else {
    nice_die("Dude! .env file required");
}
