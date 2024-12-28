<?php

namespace Utils;

class Logger {
    private string $logFile;

    public function __construct(string $logFile = 'app.log') {
        $this->logFile = $logFile;
    }

    // Log a message to the log file
    public function log(string $message): void {
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$timestamp] $message\n", FILE_APPEND);
    }
}
