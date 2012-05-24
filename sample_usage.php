<?php
include('lib.magicarticle.php');
$n = new MagicArticle;
$n->setKeyword('Nokia N95 8GB');
$article = $n->grab();
echo $article;
?>