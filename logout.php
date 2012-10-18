<?php
// including necessary files
require_once 'config/config.php';

// destroy session i.e. remove all the session values
session_destroy();

// redirect user to index.php
header("location: index.php?logout");