<?php
/**
 * This file is part of DocxDoc, a collection of utilities to parse or
 * manipulate OOXML DOCX. DocxDoc is a free software distributed under MIT
 * License. For the full copyright and license information, please view the
 * LICENSE file.
 */

namespace DocxDoc;

/**
 * Docx explorer class
 */
class Explorer
{
    /**
     * Filename
     *
     * @var string
     */
    private $filename;

    /**
     * Create instance
     *
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Parse package and return list of files
     *
     * @param bool $imageOnly
     * @return array
     */
    public function parsePackage($imageOnly = false)
    {
        if (file_exists($this->filename) === false) {
            throw new \Exception('File does not exists.');
        }

        $files = array();
        $zip = new \ZipArchive();
        $zip->open($this->filename);
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $file = $zip->statIndex($i);
            $filename = $file['name'];
            $path = pathinfo($filename);
            if (substr($filename, -1) == '/') {
                continue;
            }
            if ($imageOnly === true && $path['dirname'] != 'word/media') {
                continue;
            }
            $files[$filename] = $file;
        }
        $zip->close();
        ksort($files);

        return $files;
    }

    /**
     * Parse images
     *
     * @return array
     */
    public function parseImages()
    {
        $files = $this->parsePackage(true);
        $targetDir = __DIR__ . '/../../temp';

        $zip = new \ZipArchive();
        $zip->open($this->filename);
        foreach ($files as &$file) {
            $filename = $file['name'];
            $fileinfo = pathinfo($filename);
            $sourceFile = "zip://{$this->filename}#{$filename}";
            $targetFile = "{$targetDir}/{$fileinfo['basename']}";
            $file['source'] = '../temp/' . $fileinfo['basename'];
            copy($sourceFile, $targetFile);
        }
        $zip->close();

        return $files;
    }
}
