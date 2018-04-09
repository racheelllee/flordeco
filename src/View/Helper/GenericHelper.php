<?php

namespace App\View\Helper;

use Cake\View\Helper;

class GenericHelper extends Helper
{
	public function shortenText($text = '', $length = 80)
	{
		$delimiter = '|||||';
		$text = wordwrap($text, $length, $delimiter, true);
		return strlen($text) > $length ? explode($delimiter, $text)[0] . '...' : $text;
	}

	public function letterFromNumber($num) {
		$numeric = $num % 26;
		$letter = chr(65 + $numeric);
		$num2 = intval($num / 26);
		if ($num2 > 0) {
			return $this->letterFromNumber($num2 - 1) . $letter;
		} else {
			return $letter;
		}
	}
}