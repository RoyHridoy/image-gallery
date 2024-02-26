<?php
class DeleteItem {
    private $path;
    function __construct( $path ) {
        $this->path = rtrim( $path, "/" );
    }

    // Delete single file
    function delete( $fileName ) {
        if(!file_exists($this->path .DIRECTORY_SEPARATOR. "{$fileName}")) {
            throw new Exception( "File Doesn't exists! Don't provide wrong filename from console or url." );
        }
        unlink( $this->path . DIRECTORY_SEPARATOR . $fileName );
    }
}