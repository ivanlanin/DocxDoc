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
     * @return array
     */
    public function parsePackage()
    {
        if (file_exists($this->filename) === false) {
            throw new \Exception('File does not exists.');
        }

        $files = array();
        $zip = new \ZipArchive();
        $zip->open($this->filename);
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $file = $zip->statIndex($i);
            $path = pathinfo($file['name']);
            if ($path['dirname'] != '.') {
                $files[] = $file['name'];
            }
            sort($files);
        }

        return $files;
    }
}
