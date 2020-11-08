<?php

const BASE_NAMESPACE_NAME = "kivweb";
const BASE_APP_DIR_NAME = "app";

const FILE_EXTENSIONS = array(".class.php", ".interface.php");

spl_autoload_register(function ($className){
    $className = str_replace(BASE_NAMESPACE_NAME, BASE_APP_DIR_NAME, $className);
    $fileName = dirname(__FILE__) ."\\". $className;

    //pro endoru
    $fileName = str_replace("\\", "/", $fileName);

    foreach(FILE_EXTENSIONS as $ext) {
        if (file_exists($fileName . $ext)) {
            $fileName .= $ext;
            break;
        }
    }

    require_once($fileName);
});
?>
