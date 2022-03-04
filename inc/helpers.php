<?php

function nice_die($msg) {
    die($msg . "\n");
}

function nice_echo($msg, $emoji = "ℹ️") {
    echo "{$emoji}\t{$msg}\n";
}

function nice_separator() {
    echo "___________________________________\n";
}