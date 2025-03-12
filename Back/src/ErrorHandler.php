<?php

namespace Stoneage\Back;

class ErrorHandler
{
    public static function handle(): void
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        set_exception_handler(function ($e) {

            $message = $e->getMessage();
            $file = $e->getFile();
            $line = $e->getLine();
            $code = $e->getCode();
            $trace = $e->getTraceAsString();
            include_once __DIR__ . '/../templates/error.php';
            exit(0);
        });
        ini_set('display_errors', 1);
        ini_set('error_reporting', E_ALL);
    }
}
