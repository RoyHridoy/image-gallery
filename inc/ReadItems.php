<?php

// Load selected files from specific folder
class ReadItems implements IteratorAggregate {
    private $images, $path, $allowedFileType;
    function __construct( $path, array $allowedFileType = ['jpg', 'png', 'jpeg', 'gif'] ) {
        $this->path            = rtrim( $path, "/" );
        $this->allowedFileType = $allowedFileType;
        $this->readFiles();
    }

    // read files from specified directory
    private function readFiles() {
        $pattern      = join( ",*.", $this->allowedFileType ); // jpg,*.png,*.jpeg,*.gif
        $this->images = glob( $this->path . DIRECTORY_SEPARATOR . "{*.{$pattern}}", GLOB_BRACE ); // {*.jpg,*.png,*.jpeg,*.gif}
        if ( !$this->images ) {
            throw new Exception( "No files uploaded. Please Upload files." );
        }
    }

    // to return all files name as an array
    function getIterator(): Traversable {
        return new ArrayIterator( $this->images );
    }
}