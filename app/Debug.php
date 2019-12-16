<?php

namespace HO;

class Debug 
{
    public static function dump($aData, $bExit = true) 
    {
        if (PRODUCTION !== true) {
            $aBackTrace = debug_backtrace();
            $aBackTrace = current($aBackTrace);
        
            echo '<small>'.$aBackTrace['file'].' [L.'.$aBackTrace['line'].']</small>';
            echo '<pre>'.preg_replace(
                ['/(\[.*\])/u', '/( => )/u'],
                ['<span style="color:red">$1</span>', '<span style="color:blue"> => </span>'],
                print_r($aData, true)).'</pre>';
            
            if ($bExit) exit();
        }
    }

    public static function deleteCache()
    {
        self::deleteDirectory(VIEW_CACHE);
    }

    private static function deleteDirectory($directory)
    {
        $files = glob($directory.'/*');
        foreach($files as $file) {
            if ($file !== '.' && $file !== '..') {                
                if (is_dir($file)) {
                    self::deleteDirectory($file);
                    rmdir($file);
                } else {
                    unlink($file);
                }
            }
        }
    }
}