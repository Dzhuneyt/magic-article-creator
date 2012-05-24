<?php
class MagicArticle{
    public $keyword;
    public $lang = 'en'; // Language in which to scrape results (e.g. es for Spanish, de for Deutsch, etc)
    public $amount = 10; // Maximum 10, limited by the Blogsearch RSS feed
    public $separator = ' '; // What should separate the lines
    
    public function setKeyword($keyword){
        $this->keyword = $keyword;
    }
    public function setAmount($amount){
        $this->amount = (int)$amount;
    }
    public function setLang($lang){
        $this->lang = $lang;
    }
    public function setSeparator($separator){
        $this->separator = $separator;
    }
    
    public function grab(){
        return $this->_get_data($this->keyword, $this->amount, $this->lang, $this->separator);
    }
  
    
    public function _get_data($keyword, $maxresults, $lang, $separator){
	// RSS feed download
        $ch = curl_init();
	$timeout = 5;
        $mainrss = "http://www.google.com/search?q=".urlencode($keyword)."&hl=".$lang."&tbm=blg&output=rss";
	curl_setopt($ch,CURLOPT_URL, $mainrss);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
        
        // Getting all results in an array via regular expressions
        $results = array();
        preg_match_all("~<description>(.*)</description>~i", $data, $results);
        $results = $results[1];
        
        // Get only first N results
        $results = array_slice($results, 0, $maxresults+1);
        array_shift($results);// Remove redundant first result
        $results = implode($separator, $results); // Join the array into a string (text block)
        $results = html_entity_decode($results); // Convert encoded tags to real HTML code
        
        // Some additional cleaning up
        $results = str_ireplace('...', '', $results);
        $results = str_ireplace('. . .', '. ', $results);
        
        // Return the text
	return $results;
    }
    
}
?>