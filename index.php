<?php
    if(isset($_GET['style'])){
        $style_vari = $_GET['style'];
    }
    else{
        $style_vari = 'html';
    }
    if(isset($_GET['language'])){
        $lang_vari = $_GET['language'];
        if($lang_vari == "vi"){
            $data_vi = file_get_contents('vie.json');
            $array_json_vi = json_decode($data_vi, true);
        }
        else{
            $data_en = file_get_contents('enl.json');
            $array_json_en = json_decode($data_en, true);
        }
    }
    $data_book = file_get_contents('data.json');
    $arr_book = json_decode($data_book, true);
    if(isset($_POST['submit_modal'])){
        if(isset($_POST['name_book']) && isset($_FILES['file_upload'])){
            //$file = $_FILES['file_upload'];
            $name_doc = $_POST['name_book'];
            // echo "<pre>";
            // print_r($file);
            // echo "</pre>";
            $file_name_upload = $_FILES['file_upload']['name'];
            $file_tmp_name = $_FILES['file_upload']['tmp_name'];
            $file_error = $_FILES['file_upload']['error'];
            $file_size = $_FILES['file_upload']['size'];
            if($file_error > 0){
                echo "upload fail";
            }
            else{
                move_uploaded_file($file_tmp_name, 'upload/'.$file_name_upload);
                $arr_book[$name_doc] = $file_name_upload;
                $json_put = json_encode($arr_book, JSON_UNESCAPED_UNICODE);
                file_put_contents('data.json', $json_put);
            }  
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/<?php echo $style_vari; ?>.css">
    <!-- <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/javascript.css">
    <link rel="stylesheet" href="css/php.css"> -->
    <!-- <link href="css/fontawesome.min.css" rel="stylesheet"> -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Bookstore Webdevelop</title>
</head>
<body>
    <!--header-->
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="logo col-lg-3 col-md-6 col-sm-12">
                    <h1><a href="index.php">Bookstore</a></h1>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 docInfo">
                    <a href="index.php?style=html">html</a> |
                    <a href="index.php?style=css">css</a> |
                    <a href="index.php?style=javascript">javascipt</a> |
                    <a href="index.php?style=php">php</a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 myModal">
                    <a data-toggle="modal" data-target="#myModal" href="#">
                        <?php
                            if(isset($lang_vari)){
                                if($lang_vari == "vi"){
                                    echo $array_json_vi["add"];
                                }
                                elseif($lang_vari == "en"){
                                    echo $array_json_en["add"];
                                }
                            }
                            else{
                                echo "+ Thêm sách vào thư viện";
                            }
                        ?>
                    </a>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 lang">
                    <a href="index.php?language=vi">Việt Nam</a> |
                    <a href="index.php?language=en">English</a>
                </div>
            </div>
        </div>
    </div>

    <!--main-->
    <div id="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>
                        <?php
                            if(isset($lang_vari)){
                                if($lang_vari == "vi"){
                                    echo $array_json_vi["title"];
                                }
                                elseif($lang_vari == "en"){
                                    echo $array_json_en["title"];
                                }
                            }
                            else{
                                echo "Thư viện sách ONLINE";
                            }
                        ?>
                    </h2>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <small>
                        <?php
                            if(isset($lang_vari)){
                                if($lang_vari == "vi"){
                                    echo $array_json_vi["description"];
                                }
                                elseif($lang_vari == "en"){
                                    echo $array_json_en["description"];
                                }
                            }
                            else{
                                echo "Một ứng dụng nhỏ trong lộ trình khóa học Full Stack PHP.";
                            }
                        ?>
                    </small>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">
                                    <?php
                                        if(isset($lang_vari)){
                                            if($lang_vari == "vi"){
                                                echo $array_json_vi["name"];
                                            }
                                            elseif($lang_vari == "en"){
                                                echo $array_json_en["name"];
                                            }
                                        }
                                        else{
                                            echo "Tên sách";
                                        }
                                    ?>
                                </th>
                                <th scope="col">
                                    <?php
                                        if(isset($lang_vari)){
                                            if($lang_vari == "vi"){
                                                echo $array_json_vi["preview"];
                                            }
                                            elseif($lang_vari == "en"){
                                                echo $array_json_en["preview"];
                                            }
                                        }
                                        else {
                                            echo "Đọc thử";
                                        }
                                    ?>
                                </th>
                                <th scope="col">
                                    <?php
                                        if(isset($lang_vari)){
                                            if($lang_vari == "vi"){
                                                echo $array_json_vi["download"];
                                            }
                                            elseif($lang_vari == "en"){
                                                echo $array_json_en["download"];
                                            }
                                        }
                                        else {
                                            echo "Tải về";
                                        }
                                    ?> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach($arr_book as $doc => $detail){
                            ?>        
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?php echo $doc; ?></td>
                                <td><a href="read.php?fie_upload=<?php echo $file_name_upload; ?>"><i class="fas fa-eye"></i></a></td>
                                <td><a href="download.php?file_upload=<?php echo $file_name_upload; ?>"><i class="fas fa-download"></i></a></td>
                            </tr>
                            <?php 
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--footer-->
    <div id="footer">
        <div class="container text-center">
            <p><i class="far fa-copyright"></i> 2019 <a href="https://vietpro.edu.vn/">Vietpro Academy.</a> <b>Version:</b> 4.0</p>
        </div>
    </div>

    <!--modal form-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">
                        <?php
                            if(isset($lang_vari)){
                                if($lang_vari == "vi"){
                                    echo $array_json_vi["title_modal"];
                                }
                                elseif($lang_vari == "en"){
                                    echo $array_json_en["title_modal"];
                                }
                            }
                            else {
                                echo "Thêm sách vào thư viện";
                            }
                        ?> 
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-5">
                            <i class="fas fa-plus mb-3"> Tên sách</i>
                            <input type="text" class="form-control" name="name_book" placeholder="your book">
                        </div>
                        <div class="mb-4">
                            <i class="fas fa-file-upload mb-3"> Tải sách</i>
                            <input type="file" name="file_upload" class="form-control-file border">
                        </div>
                        <button type="submit" class="btn btn-outline-primary" name="submit_modal">Thêm sách</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>