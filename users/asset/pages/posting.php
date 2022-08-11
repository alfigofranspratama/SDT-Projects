<?php
session_start();
if (!isset($_SESSION["users"])) {
    header("Location: ../../../login.php");
    exit;
}

// <!-- cetak session login -->
if ($_SESSION['users']) {
    $login = $_SESSION['users'];
}

require '../../../admin/sistem/query.php';
require '../sistem/sis_posting.php';

$user = query("SELECT * FROM multi_user where id = $login")[0];

if (isset($_POST['posting'])) {
     //var_dump($_POST);exit;
    if (posting($_POST) > 0) {
        echo "
        <div class='alert alert-success' role='alert'>
        Posting Success!
        </div>
        <script>
          setTimeout(() => {
            window.location.href='../../'
          }, 2000)
        </script>
        ";
    } else {
        echo "
        <div class='alert alert-danger' role='alert'>
        Posting Error!
        </div>
        ";
    }
}

$allkategori  = query("SELECT * FROM kategori");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $user['username']; ?> | Posting</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" type="text/css" media="all" />
</head>

<body>
    <div class="container mt-3 shadow p-4">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label d-flex justify-content-around fs-4">Posting to <span><span class="text-primary">SDT</span><span class="text-secondary"> Projects</span></span></label>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" required name="title">
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label d-flex gap-2">
                  Kategori
                  <i id="btnCategory" class="fa fa-sliders"></i>
                 </label>
                <input type="text" value="" class="d-none form-control input-category" />
                <select class="form-select input-category" id="kategori" name="kategori">
                    <?php foreach ($allkategori as $kategori) : ?>
                        <option><?= $kategori['kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="linkdemo" class="form-label">link demo</label>
                <input type="text" class="form-control" id="linkdemo" required name="demo">
            </div>
            <div class="mb-3">
                <label for="linksource" class="form-label">link source code</label>
                <input type="text" class="form-control" id="linksource" required name="source">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Images priview</label>
                <input type="file" class="form-control" id="file" required name="images">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" value="<?= $user['username']; ?>" name="author">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                    echo  date("F j, Y, g:i a"); ?>" name="date">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="posting">Posting</button>
                <a href="../../index.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf-8">
      $("#btnCategory").on("click",function(){
        document.querySelectorAll(".input-category").forEach((e) => {
          if( $(e).attr("name") === "kategori" ){
            $(e).attr("name","");
            $(e).attr("id","");
          } else {
            $(e).attr("name","kategori");
            $(e).attr("id","kategori");
          }
        })
          $(".input-category").toggleClass("d-none");
        })
    </script>
</body>

</html>