<?PHP

function borrarArchivosBuffer(){
    $dir="../temp";
    $count = 0;

    // ensure that $dir ends with a slash so that we can concatenate it with the filenames directly
    $dir = rtrim($dir, "/\\") . "/";

    // use dir() to list files
    $list = dir($dir);

    // store the next file name to $file. if $file is false, that's all -- end the loop.
    while(($file = $list->read()) !== false) {
        if($file === "." || $file === "..") continue;
        if(is_file($dir . $file)) {
            unlink($dir . $file);
            $count++;
        }
    }
}
if(file_exists("../temp")){
    borrarArchivosBuffer();

}

?>