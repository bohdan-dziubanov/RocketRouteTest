<?php
/**
 * Index page of the project
 *
 * @author Dziubanov Bohdan <bohdan.dziubanov@gmail.com>
 */

error_reporting(E_ALL);

spl_autoload_register(function ($className)
{
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    include $className . '.php';
});

$application = new Application();
$application->createInstance();