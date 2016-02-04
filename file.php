<?php
if($_POST && isset($_POST['data'])){
    @copy(__DIR__."/store/1.md",__DIR__."/store/1.md.back");
    if(file_put_contents(__DIR__."/store/1.md",$_POST['data'])){
        echo json_encode(array('status'=>1));
        exit;
    }
    echo json_encode(array('status'=>0));
    exit;
}
echo file_get_contents(__DIR__."/store/1.md");
?>