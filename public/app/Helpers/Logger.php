<?php

class Logger
{

    public static function write($file, $message)
    {
        file_put_contents(
            __DIR__ . "/../../storage/logs/$file",
            date('c') . " | " . $message . PHP_EOL,
            FILE_APPEND
        );
    }
}