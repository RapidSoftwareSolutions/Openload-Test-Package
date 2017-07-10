<?php
$routes = [
    'getAccountInfo',
    'preparingDownload',
    'getDownloadLink',
    'checkFileStatus',
    'uploadFile',
    'uploadFileRemotely',
    'checkRemoteUploadStatus',
    'showFoldersContent',
    'renameFolder',
    'renameFile',
    'convertFiles',
    'getRunningFileConverts',
    'getVideoThumbnail',
    'metadata'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

