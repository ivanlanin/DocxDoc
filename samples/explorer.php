<?php
/**
 * Explorer sample
 */

include_once __DIR__ . '/../src/DocxDoc/Explorer.php';

use DocxDoc\Explorer;

$filename = __DIR__ . '/resources/doc.docx';
$explorer = new Explorer($filename);
$files = $explorer->parseImages();
echo implode('<br />', $files);