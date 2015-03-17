A simple script to compile snippets of text from Blogsearch RSS feeds into a single article.

In its most simple form it is used as this:
```
<?php
include('lib.magicarticle.php');
$n = new MagicArticle;
$n->setKeyword('Nokia N95 8GB');
echo $n->grab();
?>
```