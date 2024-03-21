<?php

session_start();
session_destroy();
include("functions.php");
redirect("../sign-in.php");
