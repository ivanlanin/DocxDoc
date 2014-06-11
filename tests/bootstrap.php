<?php
/**
 * This file is part of DocxDoc, a collection of utilities to parse or
 * manipulate OOXML DOCX. DocxDoc is a free software distributed under MIT
 * License. For the full copyright and license information, please view the
 * LICENSE file.
 */

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->addPsr4('DocxDoc\\', __DIR__ . '/DocxDoc');

date_default_timezone_set('UTC');
