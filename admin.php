<?php
session_start();
include_once 'utils/ValidateAdmin.php';

include_once 'container.php';
include_once 'CustomTags.php';

$resetLink = rCLink('admin_resetpassword.php','','Reset User Password',null);
$createContestLink = rCLink('admin_createcontest.php',null,'Create New Contest','');
$content = $resetLink.'<br/>'.
$createContestLink;
showPage('Admin Panel', false, parrafoOK($content), '');


?>

