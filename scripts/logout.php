<?php

session_start();
session_destroy();
include("function.php");

redirect("../sign-in.php");
