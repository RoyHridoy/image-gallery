<?php
// autoload class files - className and FileName must be same
spl_autoload_register( function ( $name ) {
    require_once "inc/{$name}.php";
} );

// Providing Error Message
$errorMsg = null;

try {
    // Image Uploads
    if ( isset( $_FILES['images'] ) ) {
        new FileUpload( $_FILES['images'], 'assets/img' );
        header("Location: index.php");
    }

    // Delete Images
    if (  ( isset( $_GET['task'] ) == "delete" ) && isset( $_GET['name'] ) && $_GET['name'] != '' ) {
        $fileName = htmlspecialchars( $_GET['name'] );
        $files    = new DeleteItem( 'assets/img' );
        $files->delete( $fileName );
        header("Location: index.php");
    }

    // Display Images - return all images into an array
    $images = new ReadItems( "assets/img/" );
} catch ( Throwable $th ) {
    $errorMsg = $th->getMessage();
}
include_once "./inc/templates/header.php";
?>
    <!-- main gallery start -->
    <?php if ( !$errorMsg ): ?>
    <div class="container grid grid-cols-1 gap-10 mx-auto md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <?php foreach ( $images as $img ): ?>
        <div class="overflow-hidden text-center transition duration-300 rounded shadow-primary hover:shadow-secondary bg-slate-50">
            <img src="<?php echo $img; ?>" alt="Image 1" class="object-cover w-full h-80">
            <a href="?task=delete&name=<?php echo substr( $img, strrpos( $img, "/" ) + 1 ); ?>" class="delete inline-block px-4 py-1.5 my-2 transition capitalize font-montserrat hover:bg-red-500 hover:text-white text-red-600 border border-red-600 rounded">delete</a>
        </div>
        <?php endforeach;?>
    </div>
    <!-- main gallery end -->

    <!-- Display Errors -->
    <?php else: ?>
        <div class="container mx-auto text-center">
            <p class="mb-5"><?php echo $errorMsg; ?></p>
            <a href="" class="px-5 py-2 font-medium text-white capitalize transition duration-300 rounded bg-slate-700 hover:bg-slate-800 font-montserrat">Go to Homepage</a>
        </div>
    <?php endif;?>
