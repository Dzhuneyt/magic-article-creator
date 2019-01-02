# SEO content generator
A content creation tool that uses the Google RSS feeds to generate articles around given keywords.

# Example
```
<?php
include('lib.magicarticle.php');
$n = new MagicArticle;
$n->setKeyword('Nokia N95 8GB');
echo $n->grab();
?>
```
