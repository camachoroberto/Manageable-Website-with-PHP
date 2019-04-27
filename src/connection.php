<?php
/**
 * Created by PhpStorm.
 * User: Troiano
 * Date: 05/04/2019
 * Time: 13:24
 */

mysqli_report(MYSQLI_REPORT_ERROR);

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);