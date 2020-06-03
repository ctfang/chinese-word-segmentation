<?php

require_once '../vendor/autoload.php';

ini_set('memory_limit','1024M');

echo "初始: ".(memory_get_usage()/1024/1024)."MB\n";

$dict = new \ChineseWordSegmentation\TrieTree();
$dict->load();

echo "使用: ".(memory_get_usage()/1024/1024)."MB\n";
echo "峰值: ".(memory_get_peak_usage()/1024/1024)."MB\n";

$str = "太好了,我爱北京天安门";
$tags = $dict->extract($str);


echo "语句:".$str."\n得到分词(词频 词性):\n";
print_r($tags);