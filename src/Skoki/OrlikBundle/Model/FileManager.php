<?php

namespace Skoki\OrlikBundle\Model;

use Symfony\Component\HttpKernel\KernelInterface;


/**
 * File Manager class
 *
 * @author Daniel Fryc <dfryc@ioki.com.pl>
 */
class FileManager
{
    /**
     * Xml validator
     *
     * @var XMLValidator
     */
    protected $validator;

    /**
     * @var mixed
     */
    protected $filePath = null;

    /**
     * Constructor
     *
     * @param  $xmlValidator - xml validator
     */
    public function __construct()
    {
    }

    /**
     * Creates file from stream and sets file path
     *
     * @param string  $fileContent     - stream with file content
     * @param string  $cacheDir        - dir in wich file will be created
     * @param boolean $addUniqueSubDir - should create sub directory with unique name
     */
    public function createFile($fileContent, $cacheDir, $addUniqueSubDir = false)
    {
        $this->filePath = $cacheDir . DIRECTORY_SEPARATOR . "zip" . DIRECTORY_SEPARATOR;
        if ($addUniqueSubDir) {
            $this->filePath .= $this->generateUniqueDirname() . DIRECTORY_SEPARATOR;
        }
        $this->filePath .= tmpfile() . ".zip";

        if (!file_exists(dirname($this->filePath))) {
            mkdir(dirname($this->filePath), 0777, true);
        }

        file_put_contents($this->filePath, $fileContent);

        $this->filePath = $this->isFileValid($this->filePath) ? $this->filePath : $this->deleteFile();
    }

    /**
     * @param string  $filePath        - file path
     * @param string  $cacheDir        - cache dir
     * @param boolean $addUniqueSubDir - should create sub directory with unique name
     *
     * @return bool|string
     */
    public function extractFile($filePath, $cacheDir, $addUniqueSubDir = false)
    {
        if (!$this->isFileValid($filePath)) {
            return false;
        }

        $begin = strrpos($filePath, "/");
        $end = strrpos($filePath, ".") - $begin;
        $fileDir = substr($filePath, $begin, $end);

        $extractedDir = $cacheDir . DIRECTORY_SEPARATOR . 'zip';
        if ($addUniqueSubDir) {
            $extractedDir .=  DIRECTORY_SEPARATOR . $this->generateUniqueDirname();
        }
        $extractedDir .= $fileDir;

        $zip = new \ZipArchive;
        $zip->open($filePath);
        $zip->extractTo($extractedDir);
        $zip->close();

        return $extractedDir;
    }

    /**
     * Generates unique dirname
     *
     * @return string
     */
    protected function generateUniqueDirname()
    {
        return sprintf("%s_%s_%s", time(), uniqid(), mt_rand());
    }

    /**
     * Check if file is valid zip file
     *
     * @param string $filePath
     *
     * @return boolean
     */
    protected function isFileValid($filePath)
    {
//        $zip = zip_open($filePath);
//
//        if (is_resource($zip)) {
//            zip_close($zip);

            return true;
//        }
//
//        return false;
    }

    /**
     * Get file path
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Delete file
     *
     * @return boolean
     */
    public function deleteFile()
    {
        if (file_exists(dirname($this->filePath))) {
            unlink($this->filePath);
            $this->filePath = null;
        }

        return null;
    }

    /**
     * Delete dir with all files
     *
     * @param string $dirPath
     *
     * @return boolean
     */
    public function deleteFolder($dirPath)
    {
        if (!file_exists($dirPath)) {
            return false;
        }

        foreach (glob($dirPath . '/*') as $file) {
            if (is_dir($file)) {
                $this->deleteFolder($file);
            } else {
                unlink($file);
            }
        }

        return rmdir($dirPath);
    }

//    /**
//     * Validate all assessment files in dir
//     *
//     * @param string $dirPath path to folder with xml files
//     * @param string $jarFile validator file
//     *
//     * @return boolean/array
//     */
//    public function validateAssessmentFilesInFolder($dirPath, $jarFile = null)
//    {
//        if (null == $jarFile) {
//            $jarFile = __DIR__.self::XMLVALIDATOR_JAR_PATH;
//        }
//
//        if (!file_exists($dirPath)) {
//            return false;
//        }
//
//        // Validation errors array
//        $errors = array();
//
//        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dirPath), \RecursiveIteratorIterator::CHILD_FIRST);
//
//        /** @var \SplFileInfo $file */
//        foreach ($iterator as $file) {
//            if (!$file->isDir() && strtolower($file->getExtension()) === 'xml') {
//                $pathElements = explode('/', $file);
//                if (!in_array('imsmanifest.xml', $pathElements)) {
//                    $result = $this->validator->validate(file_get_contents($file), array('schema' => $this->getSchema($file), 'jar_path' => $jarFile));
//
//                    if (!empty($result)) {
//                        $errors[] = $result;
//                    }
//                }
//            }
//        }
//        if (!empty($errors)) {
//            return $errors;
//        }
//
//        return true;
//    }

//    /**
//     * Validate product xml manifest file
//     *
//     * @param string $dirPath path to folder with xml files
//     * @param string $schema  schema for validatior
//     * @param string $jarFile validator file
//     *
//     * @return boolean/array
//     */
//    public function validateManifest($dirPath, $schema = null, $jarFile = null)
//    {
//        if (null == $schema) {
//            $manifestSchema = __DIR__.self::XML_MANIFEST_SCHEMA_PATH;
//        }
//
//        if (null == $jarFile) {
//            $jarFile = __DIR__.self::XMLVALIDATOR_JAR_PATH;
//        }
//
//        if (!file_exists($dirPath)) {
//            return false;
//        }
//
//        // Validation errors array
//        $errors = array();
//
//        if (is_dir($dirPath)) {
//            return false;
//        } else {
//            $pathElements = explode('/', $dirPath);
//
//            if (!in_array('imsmanifest.xml', $pathElements)) {
//                return false;
//            }
//
//            $result = $this->validator->validate(file_get_contents($dirPath), array('schema' => $manifestSchema,'jar_path' => $jarFile));
//            if (!empty($result)) {
//                $errors[] = $result;
//            }
//        }
//
//        if (!empty($errors)) {
//
//            return $errors;
//        }
//
//        return true;
//    }
//
//    /**
//     * @param SplFileInfo $file xml file
//     *
//     * @return string
//     */
//    protected function getSchema(\SplFileInfo $file)
//    {
//        try {
//            $xmlContent = file_get_contents($file);
//            $xmlFile = new \DOMDocument('1.0', 'utf-8');
//            $xmlFile->preserveWhiteSpace = false;
//            $xmlFile->loadXML($xmlContent);
//            $xmlns = $xmlFile->documentElement->getAttribute('xmlns');
//            if ($xmlns == self::DEFAULT_NAMESPACE) {
//                $end =  self::XML_SCHEMA_PATH;
//            } elseif ($xmlns == self::WEB_LINK_NAMESPACE) {
//                $end =  self::XML_WEB_LINK_SCHEMA_PATH;
//            }
//        } catch (\Exception $e) {
//            $end =  self::XML_SCHEMA_PATH;
//        }
//
//        return __DIR__.$end;
//    }
}
