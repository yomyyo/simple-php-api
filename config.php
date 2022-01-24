<?php

/**
 * Configuration for database connection
 *
 */

$host       = "137.184.195.46:3306";
$username   = "finance_user";
$password   = "13376XENQog682JZQX6TxpQpcoxWN";
$dbname     = "finance";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );