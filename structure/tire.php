<?php

// 一、Trie 树的基本性质
//  根节点不包含字符，除根节点外每一个节点都只包含一个字符。
//  从根节点到某一节点，路径上经过的字符连接起来，为该节点对应的字符串。
//  每个节点的所有子节点包含的字符都不相同。

class Node
{
    public $isEnd = false;
    public $child = [];
}

class Trie
{
    private $root;

    public function __construct()
    {
        // 根节点不保存任何数据
        $this->root = new Node();
    }

    /**
     * 获取树
     *
     * @return Node
     */
    public function getRoot(): Node
    {
        return $this->root;
    }

    /**
     * 向树插入节点
     *
     * @param string $str
     */
    public function insert(string $str): void
    {
        $node = $this->root;
        for ($i = 0, $len = mb_strlen($str); $i < $len; $i++) {
            $index = mb_substr($str, $i, 1);
            if (!isset($node->child[$index])) {
                $node->child[$index] = new Node();
            }
            $node = $node->child[$index];
            if ($i === $len - 1) {
                $node->isEnd = true;
            }
        }
    }

    /**
     * 查找字符串是否在树中
     *
     * @param string $str
     * @return bool
     */
    public function find(string $str): bool
    {
        $node = $this->root;

        if (!$node->child) {
            return false;
        }

        for ($i = 0, $len = mb_strlen($str); $i < $len; $i++) {
            $index = mb_substr($str, $i, 1);
            if (empty($node->child[$index])) {
                return false;
            }
            $node = $node->child[$index];
        }

        return $node->isEnd;
    }
}

$trie = new Trie();
$arr = ['abc', 'ab', 'bc'];

foreach ($arr as $str) {
    $trie->insert($str);
}

if ($trie->find('bc')) {
    print "Contains this string\n";
} else {
    print "Does not contain this string\n";
}

print_r($trie->getRoot());