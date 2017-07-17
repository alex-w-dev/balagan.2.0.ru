<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 29.01.2017
 * Time: 19:49
 */
namespace app\modules\api\models;

use yii\base\Model;
use yii\helpers\BaseFileHelper;
use yii\helpers\FileHelper;

class BioFileHelper extends Model
{

    /*var symbol means main of directory*/
    public static $MAIN_SUMBOL = '!';

    /*directory separator*/
    public static $DIRECTORY_SEPARATOR = '/';

    public static function filePutContents($content, $dir, $file = '')
    {
        $filePath = '';
        if (!$file) $filePath = self::getMainFile($dir);
        if (!$filePath) $filePath = self::getFilePath($dir, $file);

        return file_put_contents($filePath, $content);
    }

    public static function fileGetContents($dir, $file = '')
    {
        $filePath = self::getFilePath($dir, $file);
        if (!file_exists($filePath)) return '';
        return file_get_contents($filePath);
    }


    public static function randomFileName($prefix = '')
    {
        return uniqid($prefix, true);
    }

    public static function deleteMainSymbols($dir)
    {
        /* dir  is not found - create empty */
        $dir = self::normalizeDir($dir);
        var_dump($dir);

        $files = BaseFileHelper::findFiles($dir);
        foreach ($files as $file) {
            $file_n = str_replace($dir, '', $file);
            if (strripos($file_n, self::$MAIN_SUMBOL) !== false) {
                rename($file, $dir . str_replace(self::$MAIN_SUMBOL, '', $file_n));
            }
        }

        return true;
    }

    public static function deleteFile($dir, $file = '')
    {
        $filePath = self::getFilePath($dir, $file);
        if (!file_exists($filePath)) return false;

        return unlink($filePath);
    }

    public static function deleteAllFiles($dir)
    {
        $dir = self::normalizeDir($dir);
        $files = BaseFileHelper::findFiles($dir);

        foreach ($files as $file) {
            unlink($file);
        }

        return true;
    }



    public static function getMainFile($dir)
    {
        /* dir  is not found - create empty */
        $dir = self::normalizeDir($dir);
        /* get files and check main symbol */
        $files = BaseFileHelper::findFiles($dir);
        foreach ($files as $file) {
            $file_n = str_replace($dir, '', $file);
            if (strripos($file_n, self::$MAIN_SUMBOL) !== false) {
                return $file;
            }
        }
        /* last chance */
        if (count($files) && isset($files[0]) && $files[0]) {
            return $files[0];
        }


        return false;
    }

    public static function normalizeDir($dir)
    {
        /* dir  is not found - create empty */
        if (!is_dir($dir)) {
            BaseFileHelper::createDirectory($dir);
            return $dir;
        }
        return $dir;
    }

    public static function normalizeFileName($file)
    {
        if (!$file) {
            return self::randomFileName();
        }
        return $file;
    }

    public static function getFilePath($dir, $file = '')
    {
        //if (!$file) $filePath = self::getMainFile($dir);
        $filePath = self::normalizeDir($dir) . self::$DIRECTORY_SEPARATOR . self::normalizeFileName($file);
        return $filePath;
    }


}