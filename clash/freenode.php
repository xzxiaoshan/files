<?php

/**
 * 通过CURL进行GET请求
 */ 
function curl_get($url) {
	$header = array();
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_HEADER, 1)#我不需要获取头部啊;

    //设置头
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_USERAGENT,  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.98 Safari/537.36');
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 16);
    curl_setopt($ch, CURLOPT_TIMEOUT, 300);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $output = curl_exec($ch);
    curl_close($ch);
    return  $output;
}
function outYaml($fileName,$content){
    header('Content-Description: File Transfer');

    header('Content-Type: application/octet-stream');
    //文件名
    header('Content-Disposition: attachment; filename='.basename($fileName));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    //文件大小
    header('Content-Length: '.strlen($content));
    //文件内容
    echo $content;
}

/******************************************************************************************/

//1.获取freenode最新的免费节点帖子
//站点地址：https://clashnode.com/f/freenode
$freenode_html = curl_get("https://clashnode.com/f/freenode");

$doc = new DOMDocument();
$doc->loadHTML($freenode_html);
$xpath = new DOMXPath($doc);

$query = '//h2[@cp-post-title]';
$firstTitleUrl=$xpath->query($query)[0]->getElementsByTagName("a")[0]->getAttribute("href");

//2.从帖子中获取clash节点的url
$first_html = curl_get($firstTitleUrl);

$doc->loadHTML($first_html);
$xpath = new DOMXPath($doc);

//从参数中获取类型(默认为clash，可以选v2ray)
$type=$_GET["type"];

$query = '//strong[contains(text(),"clash订阅链接")]/parent::p/following-sibling:: *[position() = 1]';
$res_file_name="clash-freenode.yaml";
if($type == 'v2ray'){
    $query = '//strong[contains(text(),"v2ray订阅链接")]/parent::p/following-sibling:: *[position() = 1]';
    $res_file_name="v2ray-freenode.txt";
}
$subscribeUrl=$xpath->query($query)[0]->nodeValue;

//3.请求获取yaml文件内容
$file_content = curl_get($subscribeUrl);

//4.输出yaml文件内容

// print($subscribeUrl);
outYaml($res_file_name, $file_content);
// print($file_content);

?>
