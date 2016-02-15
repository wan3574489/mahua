<?php
if($_POST && isset($_POST['data'])){
    $filename = $_POST['filename'];
    $pathDir = __DIR__."/store/".$filename."/";
    $pathDataDir = __DIR__."/store/".$filename."/".date("Y-m-d")."/";
    if(!file_exists($pathDir)){
        if(!@mkdir($pathDir)){
            echo json_encode(array('status'=>0,'message'=>'新建目录错误!'));
            exit;
        }
    }

    if(!file_exists($pathDataDir)){
        if(!@mkdir($pathDataDir)){
            echo json_encode(array('status'=>0,'message'=>'新建目录错误!'));
            exit;
        }
    }

    date_default_timezone_set('Asia/Shanghai');
    @copy(__DIR__."/store/".$filename.".md",$pathDataDir.date("H_i_s").".md");

    if(file_put_contents(__DIR__."/store/".$filename.".md",$_POST['data'])){
        file_put_contents(__DIR__."/store/".$filename.".html",$_POST['parse_data']);

        echo json_encode(array('status'=>1));
        exit;
    }
    echo json_encode(array('status'=>0,'message'=>'数据添加错误'));
    exit;
}
$filename = $_GET['filename'];
$f = __DIR__."/store/".$filename.".md";
if($filename !== 'index'){
    if(!file_exists($f)){
        echo -1;
    };
}
echo @file_get_contents(__DIR__."/store/".$filename.".md");
?>