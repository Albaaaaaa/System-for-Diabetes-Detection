<?php
/**
 * COMPREHENSIVE DIAGNOSTIC SCRIPT
 * Untuk troubleshooting login issues di InfinityFree
 * 
 * USAGE: https://yourdomain.com/spadmin/diagnostic.php
 */

// Ensure logs directory exists
$logsDir = __DIR__ . '/logs';
if (!is_dir($logsDir)) {
    @mkdir($logsDir, 0755, true);
}

$logFile = $logsDir . '/diagnostic.log';

function log_diagnostic($message) {
    global $logFile, $logsDir;
    $timestamp = date('Y-m-d H:i:s');
    $fullMessage = "[$timestamp] $message\n";
    if (is_writable($logsDir)) {
        @file_put_contents($logFile, $fullMessage, FILE_APPEND);
    }
}

// Start logging
log_diagnostic("=== DIAGNOSTIC SESSION STARTED ===");
log_diagnostic("URL: " . $_SERVER['REQUEST_URI']);
log_diagnostic("Server: " . $_SERVER['SERVER_SOFTWARE']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Diagnostic - Diabetes Detection</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .header {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px;
        }
        .section {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        .section-title {
            background: #f5f5f5;
            padding: 15px;
            font-weight: bold;
            font-size: 16px;
            border-bottom: 2px solid #667eea;
            cursor: pointer;
            user-select: none;
        }
        .section-title:hover {
            background: #efefef;
        }
        .section-content {
            padding: 15px;
            display: none;
        }
        .section-content.active {
            display: block;
        }
        .test-item {
            padding: 10px;
            margin: 5px 0;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f9f9f9;
        }
        .status-ok {
            background: #d4edda !important;
            color: #155724;
        }
        .status-warning {
            background: #fff3cd !important;
            color: #856404;
        }
        .status-error {
            background: #f8d7da !important;
            color: #721c24;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 12px;
        }
        .badge-ok {
            background: #28a745;
            color: white;
        }
        .badge-warn {
            background: #ffc107;
            color: #333;
        }
        .badge-error {
            background: #dc3545;
            color: white;
        }
        .code-block {
            background: #f4f4f4;
            padding: 10px;
            border-left: 4px solid #667eea;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            overflow-x: auto;
        }
        .action-btn {
            background: #667eea;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 5px 5px 5px 0;
        }
        .action-btn:hover {
            background: #764ba2;
        }
        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .success-box {
            background: #d4edda;
            border: 1px solid #28a745;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .error-box {
            background: #f8d7da;
            border: 1px solid #dc3545;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🔍 System Diagnostic Tool</h1>
        <p>Sistem Pakar Diagnosis Diabetes - InfinityFree Troubleshooting</p>
    </div>

    <div class="content">
        <?php
        // SECTION 1: PHP CONFIGURATION
        ?>
        <div class="section">
            <div class="section-title" onclick="toggleSection(this)">
                📊 1. PHP Configuration & Environment
            </div>
            <div class="section-content">
                <?php
                $items = [];
                
                // PHP Version
                $phpVersion = phpversion();
                $items[] = [
                    'label' => 'PHP Version',
                    'value' => $phpVersion,
                    'status' => version_compare($phpVersion, '7.0.0', '>=') ? 'ok' : 'warn'
                ];
                
                // Display Errors
                $displayErrors = ini_get('display_errors');
                $items[] = [
                    'label' => 'Display Errors',
                    'value' => $displayErrors ? 'ON' : 'OFF',
                    'status' => 'warn'
                ];
                
                // Error Reporting
                $errorReporting = ini_get('error_reporting');
                $items[] = [
                    'label' => 'Error Reporting',
                    'value' => $errorReporting === '-1' ? 'E_ALL' : $errorReporting,
                    'status' => $errorReporting == -1 ? 'ok' : 'warn'
                ];
                
                // Max Execution Time
                $maxExecution = ini_get('max_execution_time');
                $items[] = [
                    'label' => 'Max Execution Time',
                    'value' => $maxExecution . 's',
                    'status' => 'ok'
                ];
                
                foreach ($items as $item) {
                    $statusClass = 'status-' . $item['status'];
                    echo '<div class="test-item ' . $statusClass . '">';
                    echo '<span>' . $item['label'] . '</span>';
                    echo '<span><code>' . htmlspecialchars($item['value']) . '</code></span>';
                    echo '</div>';
                }
                
                log_diagnostic("PHP Version: $phpVersion, Display Errors: $displayErrors");
                ?>
            </div>
        </div>

        <?php
        // SECTION 2: FILE SYSTEM
        ?>
        <div class="section">
            <div class="section-title" onclick="toggleSection(this)">
                📁 2. File System & Permissions
            </div>
            <div class="section-content">
                <?php
                $checks = [
                    '.env' => dirname(__DIR__) . '/.env',
                    'env.php' => __DIR__ . '/env.php',
                    'conn.php' => __DIR__ . '/conn.php',
                    'proseslogin.php' => __DIR__ . '/proseslogin.php',
                    'admin/index.php' => __DIR__ . '/admin/index.php',
                    'User/index.php' => __DIR__ . '/User/index.php',
                    'logs/ (dir)' => __DIR__ . '/logs'
                ];
                
                foreach ($checks as $name => $path) {
                    $exists = file_exists($path) || is_dir($path);
                    $readable = is_readable($path);
                    $writable = is_writable($path);
                    
                    $status = $exists ? 'ok' : 'error';
                    
                    echo '<div class="test-item status-' . $status . '">';
                    echo '<span>' . $name . '</span>';
                    echo '<span>';
                    echo $exists ? '<span class="badge badge-ok">EXISTS</span> ' : '<span class="badge badge-error">MISSING</span> ';
                    echo $readable ? '<span class="badge badge-ok">R</span> ' : '<span class="badge badge-error">✗R</span> ';
                    echo $writable ? '<span class="badge badge-ok">W</span>' : '<span class="badge badge-warn">✗W</span>';
                    echo '</span>';
                    echo '</div>';
                    
                    log_diagnostic("File: $name - Exists: " . ($exists ? 'YES' : 'NO') . ", Readable: " . ($readable ? 'YES' : 'NO'));
                }
                ?>
            </div>
        </div>

        <?php
        // SECTION 3: ENVIRONMENT VARIABLES
        ?>
        <div class="section">
            <div class="section-title" onclick="toggleSection(this)">
                🔑 3. Environment Variables (.env)
            </div>
            <div class="section-content">
                <?php
                $envFile = dirname(__DIR__) . '/.env';
                if (file_exists($envFile)) {
                    require_once __DIR__ . '/env.php';
                    
                    $envVars = ['DB_HOST', 'DB_USER', 'DB_NAME', 'DB_PORT', 'DB_PASS'];
                    
                    foreach ($envVars as $var) {
                        $value = getenv($var);
                        $status = !empty($value) ? 'ok' : 'error';
                        
                        echo '<div class="test-item status-' . $status . '">';
                        echo '<span>' . $var . '</span>';
                        echo '<span><code>' . (strpos($var, 'PASS') !== false ? '●●●●●●' : htmlspecialchars($value)) . '</code></span>';
                        echo '</div>';
                        
                        log_diagnostic("Env: $var = " . (empty($value) ? 'EMPTY' : 'SET'));
                    }
                } else {
                    echo '<div class="error-box">⚠️ .env file not found at: ' . htmlspecialchars($envFile) . '</div>';
                    log_diagnostic("ERROR: .env file not found!");
                }
                ?>
            </div>
        </div>

        <?php
        // SECTION 4: DATABASE CONNECTION
        ?>
        <div class="section">
            <div class="section-title" onclick="toggleSection(this)">
                🗄️ 4. Database Connection Test
            </div>
            <div class="section-content">
                <?php
                require_once __DIR__ . '/env.php';
                
                $db_host = getenv('DB_HOST') ?: 'localhost';
                $db_user = getenv('DB_USER') ?: 'root';
                $db_pass = getenv('DB_PASS') ?: '';
                $db_name = getenv('DB_NAME') ?: 'pakar_diabetes';
                $db_port = getenv('DB_PORT') ?: '3306';
                
                echo '<div class="test-item">';
                echo '<span>Host</span>';
                echo '<code>' . htmlspecialchars($db_host) . '</code>';
                echo '</div>';
                
                echo '<div class="test-item">';
                echo '<span>Database</span>';
                echo '<code>' . htmlspecialchars($db_name) . '</code>';
                echo '</div>';
                
                // Test connection
                $koneksi = mysqli_init();
                $connected = @mysqli_real_connect($koneksi, $db_host, $db_user, $db_pass, $db_name, (int)$db_port, NULL, 0);
                
                if ($connected) {
                    echo '<div class="test-item status-ok">';
                    echo '<span>Database Connection</span>';
                    echo '<span><span class="badge badge-ok">✓ CONNECTED</span></span>';
                    echo '</div>';
                    
                    log_diagnostic("Database: CONNECTED successfully");
                    
                    // Check admin table
                    $result = mysqli_query($koneksi, "SELECT COUNT(*) as count FROM admin");
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $adminCount = $row['count'];
                        
                        echo '<div class="test-item">';
                        echo '<span>Admin Records in Database</span>';
                        echo '<span><code>' . $adminCount . '</code></span>';
                        echo '</div>';
                        
                        log_diagnostic("Admin records: $adminCount");
                        
                        if ($adminCount == 0) {
                            echo '<div class="warning-box">⚠️ No admin records found! You need to create at least one admin user.</div>';
                        }
                    }
                    
                    // Check other tables
                    $tables = ['gejala', 'penyakit', 'riwayat'];
                    foreach ($tables as $table) {
                        $result = mysqli_query($koneksi, "SELECT COUNT(*) as count FROM $table");
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            echo '<div class="test-item">';
                            echo '<span>Records in ' . ucfirst($table) . '</span>';
                            echo '<span><code>' . $row['count'] . '</code></span>';
                            echo '</div>';
                        }
                    }
                    
                    mysqli_close($koneksi);
                } else {
                    $error = mysqli_connect_error();
                    echo '<div class="test-item status-error">';
                    echo '<span>Database Connection</span>';
                    echo '<span><span class="badge badge-error">✗ FAILED</span></span>';
                    echo '</div>';
                    
                    echo '<div class="error-box">';
                    echo '<strong>Connection Error:</strong><br>';
                    echo '<code>' . htmlspecialchars($error) . '</code>';
                    echo '</div>';
                    
                    log_diagnostic("Database: CONNECTION FAILED - $error");
                }
                ?>
            </div>
        </div>

        <?php
        // SECTION 5: SESSION CONFIGURATION
        ?>
        <div class="section">
            <div class="section-title" onclick="toggleSection(this)">
                🔐 5. Session Configuration
            </div>
            <div class="section-content">
                <?php
                $sessionTests = [
                    'Session Status' => session_status() === PHP_SESSION_NONE ? 'Not Started' : (session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Disabled'),
                    'Session Save Path' => ini_get('session.save_path'),
                    'Session Name' => ini_get('session.name'),
                    'Session Timeout' => ini_get('session.gc_maxlifetime') . 's',
                    'Cookies Enabled' => ini_get('session.use_cookies') ? 'Yes' : 'No',
                ];
                
                foreach ($sessionTests as $label => $value) {
                    $status = empty($value) ? 'warn' : 'ok';
                    echo '<div class="test-item status-' . $status . '">';
                    echo '<span>' . $label . '</span>';
                    echo '<span><code>' . htmlspecialchars($value) . '</code></span>';
                    echo '</div>';
                }
                
                log_diagnostic("Session: " . json_encode($sessionTests));
                ?>
            </div>
        </div>

        <?php
        // SECTION 6: TEST LOGIN PROCESS
        ?>
        <div class="section">
            <div class="section-title" onclick="toggleSection(this)">
                🧪 6. Test Login Process
            </div>
            <div class="section-content">
                <p>Test dengan username/password untuk debugging:</p>
                <form method="POST" style="margin-top: 15px;">
                    <div style="margin-bottom: 10px;">
                        <label>Username:</label>
                        <input type="text" name="test_username" placeholder="Enter username" style="padding: 8px; width: 200px;">
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label>Password:</label>
                        <input type="password" name="test_password" placeholder="Enter password" style="padding: 8px; width: 200px;">
                    </div>
                    <button type="submit" name="test_login" class="action-btn">Test Login Query</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test_login'])) {
                    require_once __DIR__ . '/env.php';
                    $db_host = getenv('DB_HOST');
                    $db_user = getenv('DB_USER');
                    $db_pass = getenv('DB_PASS');
                    $db_name = getenv('DB_NAME');
                    $db_port = getenv('DB_PORT');
                    
                    $koneksi = mysqli_init();
                    if (mysqli_real_connect($koneksi, $db_host, $db_user, $db_pass, $db_name, (int)$db_port, NULL, 0)) {
                        $username = mysqli_real_escape_string($koneksi, $_POST['test_username']);
                        $password = mysqli_real_escape_string($koneksi, $_POST['test_password']);
                        
                        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
                        $result = mysqli_query($koneksi, $query);
                        
                        if ($result) {
                            $count = mysqli_num_rows($result);
                            if ($count == 1) {
                                $row = mysqli_fetch_assoc($result);
                                echo '<div class="success-box">';
                                echo '✓ <strong>Login would succeed!</strong><br>';
                                echo 'Username: ' . htmlspecialchars($row['username']) . '<br>';
                                echo 'Level: ' . htmlspecialchars($row['level']) . '<br>';
                                echo 'Name: ' . htmlspecialchars($row['nama']) . '';
                                echo '</div>';
                                log_diagnostic("Test login SUCCESS for: " . $_POST['test_username']);
                            } else {
                                echo '<div class="error-box">';
                                echo '✗ <strong>Login would fail:</strong> User not found or password incorrect';
                                echo '</div>';
                                log_diagnostic("Test login FAILED - user not found: " . $_POST['test_username']);
                            }
                        } else {
                            echo '<div class="error-box">';
                            echo '✗ <strong>Query Error:</strong> ' . htmlspecialchars(mysqli_error($koneksi));
                            echo '</div>';
                            log_diagnostic("Test login query error: " . mysqli_error($koneksi));
                        }
                        
                        mysqli_close($koneksi);
                    }
                }
                ?>
            </div>
        </div>

        <?php
        // SECTION 7: RECOMMENDATIONS
        ?>
        <div class="section">
            <div class="section-title" onclick="toggleSection(this)">
                💡 7. Recommendations & Next Steps
            </div>
            <div class="section-content">
                <h4>If everything is green (✓):</h4>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Try logging in at: <a href="pages-login.html" target="_blank">pages-login.html</a></li>
                    <li>Check browser console for JavaScript errors (F12)</li>
                    <li>Clear browser cookies and cache</li>
                    <li>Try in incognito/private mode</li>
                </ul>

                <h4>If something is red (✗):</h4>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li><strong>Database Connection Failed:</strong> Check .env credentials with InfinityFree panel</li>
                    <li><strong>No admin records:</strong> Create admin user in database</li>
                    <li><strong>Missing files:</strong> Verify all files uploaded correctly</li>
                    <li><strong>Permission issues:</strong> Contact InfinityFree support</li>
                </ul>

                <h4>Debug Files Created:</h4>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li><code>spadmin/logs/diagnostic.log</code> - This diagnostic log</li>
                    <li><code>spadmin/logs/error.log</code> - PHP error log</li>
                </ul>

                <h4>Quick Links:</h4>
                <div style="margin-top: 15px;">
                    <a href="pages-login.html" class="action-btn">Go to Login</a>
                    <a href="pages-login.html?error=test" class="action-btn">Test Error Display</a>
                    <button class="action-btn" onclick="location.reload()">Refresh Diagnostic</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function toggleSection(element) {
    const content = element.nextElementSibling;
    content.classList.toggle('active');
}

// Auto-expand first section
document.addEventListener('DOMContentLoaded', function() {
    const firstSection = document.querySelector('.section-content');
    if (firstSection) {
        firstSection.classList.add('active');
    }
});
</script>
</body>
</html>

<?php
log_diagnostic("=== DIAGNOSTIC SESSION ENDED ===\n");
?>