<?php

## A logout function basically

session_start();
session_destroy();

header("Location: home.php");
exit;