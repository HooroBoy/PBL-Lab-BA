<?php
// Base configuration to allow header/footer reference assets and links
// even when included from files inside subfolders or different table structures.

// Absolute filesystem path to project root (one level above includes/)
define('BASE_PATH', realpath(__DIR__ . '/..'));

// Attempt to compute BASE_URL (web path) relative to DOCUMENT_ROOT.
$docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$projectPath = str_replace('\\', '/', realpath(__DIR__ . '/..'));
$computedUrl = '';
if ($docRoot && strpos($projectPath, str_replace('\\', '/', $docRoot)) === 0) {
    $computedUrl = substr($projectPath, strlen(str_replace('\\', '/', $docRoot)));
    $computedUrl = rtrim(str_replace('\\', '/', $computedUrl), '/');
}

// Fallback: use dirname of script name (works when project is served as a subfolder)
if ($computedUrl === '') {
    $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    $computedUrl = ($scriptDir === '/' ? '' : $scriptDir);
}

// Final fallback: empty (root). You can change this to '/PBL' if your site is always at that path.
if ($computedUrl === '') {
    $computedUrl = '';
}

// Ensure leading slash (but not a trailing slash)
if ($computedUrl !== '' && $computedUrl[0] !== '/') {
    $computedUrl = '/' . ltrim($computedUrl, '/');
}

define('BASE_URL', $computedUrl);

// Usage:
// echo BASE_URL . '/assets/style.css';
// include BASE_PATH . '/includes/header.php';

?>
