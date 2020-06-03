<?php
/**
 * Created by PhpStorm.
 * User: ctfang
 * Date: 2020-06-02
 * Time: 11:21
 */

namespace ChineseWordSegmentation;

/**
 * Class TrieTree
 * @package ChineseWordSegmentation
 */
class TrieTree
{
    public $map;

    /**
     * 构建有向无环图
     *
     * @param string $file
     */
    public function load(string $file = null)
    {
        if (!$file) {
            $file = __DIR__.'/../dict/dict.txt';
        }

        $fileFD = fopen($file, "r");
        $this->map = new WordDict();
        while (!feof($fileFD)) {
            $item = trim(fgets($fileFD));
            $arr = explode(' ', $item);

            $paramMap = $this->map;
            foreach (Str::toArray($arr[0]) as $word) {
                if (!isset($paramMap[$word])) {
                    $paramMap[$word] = new WordDict();
                }
                $paramMap = $paramMap[$word];
            }
            $paramMap->isEnd = true;
            if (isset($arr[2])) {
                $paramMap->tf = $arr[1].' '.$arr[2];
            } elseif (isset($arr[1])) {
                $paramMap->tf = $arr[1];
            }
        }
        fclose($fileFD);
    }

    /**
     * 所有分词
     *
     * @param string $str
     * @return array
     */
    public function extract(string $str): array
    {
        $tags = [];

        foreach (Str::toArray($str) as $i => $word) {
            $tags = array_merge($tags, $this->getMapWord($this->map, mb_substr($str, $i), ''));
        }

        return $tags;
    }

    /**
     * 所有分词
     *
     * @param WordDict $nextMap
     * @param $str
     * @param $tagStr
     * @return array
     */
    private function getMapWord($nextMap, $str, $tagStr)
    {
        $tags = [];

        foreach (Str::toArray($str) as $i => $word) {
            if (isset($nextMap[$word])) {
                $tagStr .= $word;
                $nextMap = $nextMap[$word];
                if ($nextMap->isEnd === true) {
                    $tags[$tagStr] = $nextMap->tf;
                }
            } else {
                return $tags;
            }
        }

        return $tags;
    }
}