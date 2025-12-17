<?php
define('BASE_PATH', realpath(__DIR__ . '/..'));

$docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$projectPath = str_replace('\\', '/', realpath(__DIR__ . '/..'));
$computedUrl = '';
if ($docRoot && strpos($projectPath, str_replace('\\', '/', $docRoot)) === 0) {
    $computedUrl = substr($projectPath, strlen(str_replace('\\', '/', $docRoot)));
    $computedUrl = rtrim(str_replace('\\', '/', $computedUrl), '/');
}

if ($computedUrl === '') {
    $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    $computedUrl = ($scriptDir === '/' ? '' : $scriptDir);
}

if ($computedUrl === '') {
    $computedUrl = '';
}

if ($computedUrl !== '' && $computedUrl[0] !== '/') {
    $computedUrl = '/' . ltrim($computedUrl, '/');
}

define('BASE_URL', $computedUrl);

?>
