<?php

function convert_to_ascii($str) {
	$convertTable = array (
		'á' => 'a', 'Á' => 'A', 'ä' => 'a', 'Ä' => 'A', 'č' => 'c',
		'Č' => 'C', 'ď' => 'd', 'Ď' => 'D', 'é' => 'e', 'É' => 'E',
		'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'í' => 'i',
		'Í' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ľ' => 'l', 'Ľ' => 'L',
		'ĺ' => 'l', 'Ĺ' => 'L', 'ň' => 'n', 'Ň' => 'N', 'ń' => 'n',
		'Ń' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ö' => 'o', 'Ö' => 'O',
		'ř' => 'r', 'Ř' => 'R', 'ŕ' => 'r', 'Ŕ' => 'R', 'š' => 's',
		'Š' => 'S', 'ś' => 's', 'Ś' => 'S', 'ť' => 't', 'Ť' => 'T',
		'ú' => 'u', 'Ú' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ü' => 'u',
		'Ü' => 'U', 'ý' => 'y', 'Ý' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y',
		'ž' => 'z', 'Ž' => 'Z', 'ź' => 'z', 'Ź' => 'Z',
	);
	
	return strtr($str, $convertTable);
}

function get_last_day_in_month($year, $month) {
	if (checkdate($month, 31, $year))
		return 31;
	else if (checkdate($month, 30, $year))
		return 30;
	else if (checkdate($month, 29, $year))
		return 29;
	else if (checkdate($month, 28, $year))
		return 28;
	else
		return 0;
}