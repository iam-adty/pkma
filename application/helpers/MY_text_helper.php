<?php defined('BASEPATH') OR die('No direct script access allowed!');

if(!function_exists('close_html_tag'))
{
	function close_html_tag($string)
	{
	    // coded by Constantin Gross <connum at googlemail dot com> / 3rd of June, 2006
	    // (Tiny little change by Sarre a.k.a. Thijsvdv)
	    $donotclose=array('br','img','input');
	    $tagstoclose='';
	    $tags=array();
	    preg_match_all("/<(([A-Z]|[a-z]).*)(( )|(>))/isU",$string,$result);
	    $openedtags=$result[1];
	    preg_match_all("/<\/(([A-Z]|[a-z]).*)(( )|(>))/isU",$string,$result2);
	    $closedtags=$result2[1];

	    for ($i=0;$i<count($openedtags);$i++) {
	       if (in_array($openedtags[$i],$closedtags)) { unset($closedtags[array_search($openedtags[$i],$closedtags)]); }
	           else array_push($tags, $openedtags[$i]);
	    }

	    $tags=array_reverse($tags);

	    for($x=0;$x<count($tags);$x++) {
		    $add=strtolower(trim($tags[$x]));
		    if(!in_array($add,$donotclose)) $tagstoclose.='</'.$add.'>';
		}

		return $string . $tagstoclose;
	}
}

if(!function_exists('rich_text_limiter'))
{
	function rich_text_limiter($text = '', $limit = 100, $word = TRUE)
	{
		if($word)
			return close_html_tag(word_limiter(preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', strip_tags($text, '<p>')), $limit));
		else
			return close_html_tag(character_limiter(preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', strip_tags($text, '<p>')), $limit));
	}
}