<?php

	/**
	 * This is class CTextFilter
	 *
	 */	
	class CTextFilter {
		
		public function doFilter($text, $filter) {
			if ($filter) {
				$valid=array(
					'bbcode'=>"bbcode2html",
					'link'=>"make_clickable",
					'markdown'=>"markdown",
					'nl2br'=>"nl2br"
					);
				$filters=preg_replace("/\s/", "", explode(",", $filter));
				foreach ($filters as $func) {
					if (isset($valid[$func])) {
						$text=self::$valid[$func]($text);
					} else {
						throw new Exception("Filtret ".$filter." är inte tillgängligt.");
					}
				}
			}
			return $text;
		}
		
		private function bbcode2html($text) {
			$search=array(
				'/\[b\](.*?)\[\/b\]/is',
				'/\[i\](.*?)\[\/i\]/is',
				'/\[u\](.*?)\[\/u\]/is',
				'/\[img\](https?.*?)\[\/img\]/is',
				'/\[url\](https?.*?)\[\/url\]/is',
				'/\[url=(https?.*?)\](.*?)\[\/url\]/is'
				);
			$replace=array(
				'<strong>$1</strong>',
				'<em>$1</em>',
				'<u>$1</u>',
				'<img src="$1" />',
				'<a href="$1">$1</a>',
				'<a href="$1">$2</a>'
				);     
			return preg_replace($search, $replace, $text);
		}

		private function make_clickable($text) {
			return preg_replace_callback(
				'#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
				create_function(
					'$matches',
					'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
					),
				$text
				);
		}

		private function markdown($text) {
			require_once(ANASSA_INSTALL_PATH."/src/php-markdown/Michelf/MarkdownInterface.php");
			require_once(ANASSA_INSTALL_PATH."/src/php-markdown/Michelf/Markdown.php");
			require_once(ANASSA_INSTALL_PATH."/src/php-markdown/Michelf/MarkdownExtra.php");
			return \Michelf\MarkdownExtra::defaultTransform($text);
		}

		private function nl2br($text) {
			return nl2br($text);
		}

	}

?>