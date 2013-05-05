<?php

function import($classes = '') {
    //Add base folder to the $classes variable
    $classes = 'classes.'.$classes;
    
    //Convert to filepath
    $fileName = str_replace('.', '/', $classes);
    
    if(!file_exists($fileName)) {
        $fileName .= '.php';
        if(!file_exists($fileName)) {
            return;
        }
    }
    if(is_file($fileName)) {
        require_once $fileName;
    } else {
        $dir = new RecursiveDirectoryIterator($fileName);
        foreach (new RecursiveIteratorIterator($dir) as $filename => $file) {
            if($file->isFile() && $file->getExtension() == "php") {
                require_once $file;
            }
        }
    }
}
?>
