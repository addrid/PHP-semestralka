<?php

$valid_passwords = array ("admin" => "xadmin", "daniel"=>"daniel");
$valid_users = array_keys($valid_passwords);

$user = @$_SERVER['PHP_AUTH_USER'];
$password = @$_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($password == $valid_passwords[$user]);

if (!$validated) {
    header('WWW-Authenticate: Basic realm="Dneska je venku hezky"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Unauthorized");
}
?>