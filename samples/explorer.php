<?php
/**
 * Explorer sample
 */

include_once __DIR__ . '/../src/DocxDoc/Explorer.php';

use DocxDoc\Explorer;

$filename = __DIR__ . '/resources/doc.docx';
$filename = __DIR__ . '/../build/Profil Risiko.docx';
$explorer = new Explorer($filename);
$files = $explorer->parseImages();
foreach ($files as $file) {
    echo $file['name'], '<br>';
    echo '<img src="', $file['source'], '"><br>';
}