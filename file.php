<?php
if($_POST && isset($_POST['data'])){
    $filename = $_POST['filename'];
    @copy(__DIR__."/store/".$filename.".md",__DIR__."/store/".$filename.".md.back");
    if(file_put_contents(__DIR__."/store/".$filename.".md",$_POST['data'])){
        echo json_encode(array('status'=>1));
        exit;
    }
    echo json_encode(array('status'=>0));
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