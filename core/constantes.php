<?php
// BASE_PUBLIC_URL
define('BASE_PUBLIC_URL', 'http://' . $_SERVER['HTTP_HOST'] . explode(DISPATCHER_NAME, $_SERVER['SCRIPT_NAME'])[0]);
