<?php 
header("Content-type:text/html;charset=utf-8");
// 打印函数 人性化
function p($data){
    echo "<pre style='margin-top:50px;margin: 44px 0 0 0; display:block; color:red; padding:9.5px;font-size:13px;line-height:1.42857;word-break: break-all;word-wrap:break-word;background-color:#F5F5F5;border: 1px solid #CCC;border-radius:4px;' >";
    print_r($data);
    echo "</pre>";
}


 ?>