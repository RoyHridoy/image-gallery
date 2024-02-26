<?php
class FileUpload {
    private $files, $allowedFileType, $path;
    function __construct( array $files, string $path, array $allowedFileType = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'] ) {
        $this->setUploadFiles( $files );
        $this->setPath( $path );
        $this->setAllowFileType( $allowedFileType );
        $this->uploads();
    }
    // set where to upload files
    public function setPath( string $path ) {
        $this->path = rtrim( $path, "/" );
    }
    // Set which type of files you want to upload
    public function setAllowFileType( array $allowedFileType ) {
        $this->allowedFileType = $allowedFileType;
    }
    // Provide files array to upload
    public function setUploadFiles( array $files ) {
        $this->files = $files;
    }

    // Main functionality to upload files
    private function uploads() {
        // 1) Check if folder is writeable
        if ( !is_writable( $this->path ) ) {
            throw new Exception( "Permission Denied. Provide Writing Permission to the uploaded folder." );
        }

        // 2) Count total uploadable files
        $totalFiles = count( $this->files['name'] );
        // 3) one by one upload file
        for ( $i = 0; $i < $totalFiles; $i++ ) {
            // 3.1) create unique upload file name
            $fileName = uniqid() . "." . pathinfo( $this->files['name'][$i], PATHINFO_EXTENSION );

            // 3.2) If fileType matched to the allowed file type and file size is less than 5MB then upload
            if ( in_array( $this->files['type'][$i], $this->allowedFileType ) && $this->files['size'][$i] < 5 * 1024 * 1024 ) {
                move_uploaded_file( $this->files['tmp_name'][$i], $this->path . DIRECTORY_SEPARATOR . $fileName );
            } else {
                $errorMsg = "You have only allowed <code class='font-montserrat font-semibold'>" . join( ', ', $this->allowedFileType ) . "</code> type files and maximum filesize is <span class='font-montserrat font-semibold'>5MB</span>";
                throw new Exception( " {$errorMsg}" );
            }
        }
    }
}
