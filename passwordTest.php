<?php



$email = "admin2022";

echo md5($email);

echo "<br><br>";

echo bin2hex(md5($email));

echo "<br><br>";

echo strlen("6335363438313030386132323537643366616233366662663537323061326536");

function replace($data){
    
    return md5(md5(str_ireplace("a", "z", md5($data))).strlen($data));
}

echo "<br><br>";

echo replace($email);