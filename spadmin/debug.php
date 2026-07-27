<?php
// Debug script untuk troubleshooting login issues
// File ini membantu mengidentifikasi masalah pada environment InfinityFree

header('Content-Type: text/html; charset=utf-8');

echo "<h2>System Diagnostics - Sistem Pakar Diabetes</h2>";
echo "<hr>";

// 1. Check PHP version
echo "<h3>1. PHP Version</h3>";
echo "PHP Version: " . phpversion() . "<br>";

// 2. Check session configuration
echo "<h3>2. Session Configuration</h3>";
echo "Session Status: " . (session_status() === PHP_SESSION_NONE ? "Not Started" : "Started") . "<br>";
echo "Session Save Path: " . ini_get('session.save_path') . "<br>";

// 3. Check environment variables
echo "<h3>3. Environment Variables (.env)</h3>";
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    echo "<span style='color: green;'>✓ .env file exists</span><br>";
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with($line, '#')) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        echo "Env: " . $name . " = " . (strlen($value) > 0 ? "SET" : "EMPTY") . "<br>";
    }
} else {
    echo "<span style='color: red;'>✗ .env file NOT found at: $envFile</span><br>";
}

// 4. Check database connection
echo "<h3>4. Database Connection Test</h3>";
require_once __DIR__ . '/env.php';

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'pakar_diabetes';
$db_port = getenv('DB_PORT') ?: '3306';

echo "DB_HOST: " . $db_host . "<br>";
echo "DB_USER: " . $db_user . "<br>";
echo "DB_NAME: " . $db_name . "<br>";
echo "DB_PORT: " . $db_port . "<br>";

$koneksi = mysqli_init();
if (!mysqli_real_connect($koneksi, $db_host, $db_user, $db_pass, $db_name, (int)$db_port, NULL, 0)) {
    echo "<span style='color: red;'>✗ Database Connection Failed: " . mysqli_connect_error() . "</span><br>";
} else {
    echo "<span style='color: green;'>✓ Database Connection Successful</span><br>";
    
    // Check admin table
    $result = mysqli_query($koneksi, "SELECT COUNT(*) as count FROM admin");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "Admin Records: " . $row['count'] . "<br>";
    } else {
        echo "Error checking admin table: " . mysqli_error($koneksi) . "<br>";
    }
    
    mysqli_close($koneksi);
}

// 5. Check file permissions
echo "<h3>5. File Permissions</h3>";
$testDir = __DIR__ . '/test_write';
if (!is_dir($testDir)) {
    mkdir($testDir, 0755, true);
}
if (is_writable($testDir)) {
    echo "<span style='color: green;'>✓ Write permissions OK</span><br>";
    rmdir($testDir);
} else {
    echo "<span style='color: red;'>✗ Write permissions issue</span><br>";
}

// 6. Check error reporting
echo "<h3>6. Error Reporting</h3>";
echo "Error Reporting: " . (ini_get('display_errors') ? "ON" : "OFF") . "<br>";
echo "Error Log: " . (ini_get('error_log') ?: "Not Set") . "<br>";

// 7. Check required extensions
echo "<h3>7. Required PHP Extensions</h3>";
$extensions = ['mysqli', 'session', 'openssl'];
foreach ($extensions as $ext) {
    echo $ext . ": " . (extension_loaded($ext) ? "<span style='color: green;'>✓</span>" : "<span style='color: red;'>✗</span>") . "<br>";
}

echo "<hr>";
echo "<p><strong>Note:</strong> If you see any red ✗ marks, there may be issues with your hosting configuration.</p>";
?>