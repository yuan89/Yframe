<?php
namespace Yframe\Core;

class Logger
{
    private $logPath;

    public function __construct($logPath)
    {
        $this->logPath = $logPath;
    }

    public function log($message, $level = 'info')
    {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
        $logFile = $this->logPath . '/' . date('Y-m-d') . '.log';

        return file_put_contents($logFile, $logMessage, FILE_APPEND);
    }

    public function info($message)
    {
        return $this->log($message, 'info');
    }

    public function warning($message)
    {
        return $this->log($message, 'warning');
    }

    public function error($message)
    {
        return $this->log($message, 'error');
    }
}
