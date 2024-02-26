<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Image Gallery</title>
    <script type="module" crossorigin src="assets/index-69ab6aaa.js"></script>
    <link rel="stylesheet" href="assets/index-b38f7228.css">
  </head>
  <body>
    <section class="min-h-screen pt-10 pb-20 bg-slate-100">
        <!-- upload section start -->
        <div class="container flex flex-col items-center justify-between pb-5 mx-auto mb-10 border-b md:flex-row border-slate-300">
          <a href="index.php"><h2 class="mb-5 text-4xl font-semibold md:mb-0 font-montserrat">Image <span class="px-5 py-2 text-3xl rounded bg-slate-700 text-slate-50">Gallery</span></h2></a>
          <form action="" method="post" enctype="multipart/form-data">
            <label for="image" class="inline-block mb-1 font-semibold font-montserrat">Upload Images</label><br>
            <input type="file" name="images[]" id="image" multiple required>
            <button class="px-5 py-2 font-medium text-white capitalize transition duration-300 rounded bg-slate-700 hover:bg-slate-800 font-montserrat">upload</button>
          </form>
        </div>
        <!-- upload section end -->