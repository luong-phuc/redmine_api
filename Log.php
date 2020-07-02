<?php

namespace Common;

class Log
{
    public function error($msg)
    {
        echo "\033[01;31m \n" . $msg . " \033[0m \n";
        exit;
    }

    public function warning($msg)
    {
        echo "\033[0;33m \n" . $msg . " \033[0m \n";
    }

    public function info($msg)
    {
        echo "\033[0;34m \n" . $msg . " \033[0m \n";
    }
}
