<?php
require '../libs/rb.php';
R::setup( 'mysql:host=localhost;dbname=users',
 'root', '201082' );
 session_start();