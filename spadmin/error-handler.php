<?php
/**
 * Error Handler untuk InfinityFree
 * Membantu menangkap dan mencatat error yang mungkin tidak terlihat
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Create error log directory if it doesn't exist
$logDir = __DIR__ . '/logs';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

$errorLogFile = $logDir . '/error.log';

// Custom error handler
set_error_handler(function($errno, $errstr, $errfile, $errline) use ($errorLogFile) {
    $errorType = [
        E_ERROR => 'ERROR',
        E_WARNING => 'WARNING',
        E_PARSE => 'PARSE',
        E_NOTICE => 'NOTICE',
        E_CORE_ERROR => 'CORE_ERROR',
        E_CORE_WARNING => 'CORE_WARNING',
        E_COMPILE_ERROR => 'COMPILE_ERROR',
        E_COMPILE_WARNING => 'COMPILE_WARNING',
        E_USER_ERROR => 'USER_ERROR',
        E_USER_WARNING => 'USER_WARNING',
        E_USER_NOTICE => 'USER_NOTICE',
        E_STRICT => 'STRICT',
        E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
        E_DEPRECATED => 'DEPRECATED',
        E_USER_DEPRECATED => 'USER_DEPRECATED',
    ];

    $type = isset($errorType[$errno]) ? $errorType[$errno] : 'UNKNOWN';
    $message = "[" . date('Y-m-d H:i:s') . "] $type: $errstr in $errfile on line $errline\n";
    
    if (is_writable($logDir)) {
        @file_put_contents($errorLogFile, $message, FILE_APPEND);
    }

    return true;
});

// Custom exception handler
set_exception_handler(function($exception) use ($errorLogFile, $logDir) {
    $message = "[" . date('Y-m-d H:i:s') . "] EXCEPTION: " . $exception->getMessage() . 
               " in " . $exception->getFile() . " on line " . $exception->getLine() . "\n";
    
    if (is_writable($logDir)) {
        @file_put_contents($errorLogFile, $message, FILE_APPEND);
    }

    // Display user-friendly error
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Error</title>
        <style>
            body { font-family: Arial, sans-serif; background: #f5f5f5; }
            .container { max-width: 600px; margin: 50px auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
            .error { color: #d32f2f; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1 class="error">Terjadi Kesalahan</h1>
            <p>Maaf, terjadi kesalahan pada sistem. Tim support telah diberitahu tentang masalah ini.</p>
            <p><a href="javascript:history.back()">Kembali</a></p>
        </div>
    </body>
    </html>
    <?php
    exit;
});

// Catch fatal errors
register_shutdown_function(function() use ($errorLogFile, $logDir) {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
        $message = "[" . date('Y-m-d H:i:s') . "] FATAL: " . $error['message'] . 
                   " in " . $error['file'] . " on line " . $error['line'] . "\n";
        
        if (is_writable($logDir)) {
            @file_put_contents($errorLogFile, $message, FILE_APPEND);
        }
    }
});
?>