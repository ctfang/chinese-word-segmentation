中文分词
========
中文分词-原生php库,可以自定义中文词典



原生php保存整个词典太消耗内存了;
为了把整个词典保存成<a href="https://baike.baidu.com/item/%E6%9C%89%E5%90%91%E6%97%A0%E7%8E%AF%E5%9B%BE/10972513?fr=aladdin">有向无环图</a>结构,
整整消耗了150多MB内存

todo 正在试验如何使用更低的内存保存词典结构

自定义
========
耗时和内存都在加载词典上,大量分词的场景只适合cli模式运行;

例如是分析电商评价的好坏情景,最好是自己设计词典:dict.txt内文示例(词频,词性定义不是必须的)

    很好 1000 l
    太好了 3 l
    很实用 12 l
    ....
简单过滤词性,计算分词的Tf-idf值,就可以得到需要的内容

示例
========
    require_once '../vendor/autoload.php';
    
    ini_set('memory_limit','1024M');
    
    echo "初始: ".(memory_get_usage()/1024/1024)."MB\n";
    
    $dict = new \ChineseWordSegmentation\TrieTree();
    $dict->load();
    
    echo "使用: ".(memory_get_usage()/1024/1024)."MB\n";
    echo "峰值: ".(memory_get_peak_usage()/1024/1024)."MB\n";
    
    $str = "我爱北京天安门";
    $tags = $dict->extract($str);
    
    
    echo "语句:".$str."\n得到分词(词频 词性):\n";
    print_r($tags);

结果

    初始: 0.89760589599609MB
    使用: 161.15187835693MB
    峰值: 161.16103363037MB
    语句:我爱北京天安门
    得到分词(词频 词性):
    Array
    (
        [我] => 328841 r
        [爱] => 14878 v
        [北] => 17860 ns
        [北京] => 34488 ns
        [京] => 6583 ns
        [天] => 35979 q
        [天安] => 273 nz
        [天安门] => 34010 ns
        [安] => 8837 v
        [门] => 39823 n
    )


其他选择 

<a href="https://github.com/hightman/scws/">php扩展scws</a> 但是定制词典麻烦

<a href="https://github.com/fxsjy/jieba">python结巴</a> 本库/dict/dict.txt 也是使用这个库的词典

    