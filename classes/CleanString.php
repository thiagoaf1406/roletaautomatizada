<?php
class CleanString {

	/**
	 * Array com os termos que serão substituidos
	 * @var array
	 */
	private static $removeArray = array(
			"a" => "a" ,
			"b" => "b" ,
			"c" => "c" ,
			"d" => "d" ,
			"e" => "e" ,
			"f" => "f" ,
			"g" => "g" ,
			"h" => "h" ,
			"i" => "i" ,
			"j" => "j" ,
			"k" => "k" ,
			"l" => "l" ,
			"m" => "m" ,
			"n" => "n" ,
			"o" => "o" ,
			"p" => "p" ,
			"q" => "q" ,
			"r" => "r" ,
			"s" => "s" ,
			"t" => "t" ,
			"u" => "u" ,
			"v" => "v" ,
			"x" => "x" ,
			"y" => "y" ,
			"z" => "z" ,
			"á" => "a" ,
			"é" => "e" ,
			"í" => "i" ,
			"ó" => "o" ,
			"ú" => "u" ,
			"à" => "a" ,
			"è" => "e" ,
			"ì" => "i" ,
			"ò" => "o" ,
			"ù" => "ù" ,
			"ã" => "a" ,
			"õ" => "o" ,
			"â" => "a" ,
			"ê" => "e" ,
			"î" => "i" ,
			"ô" => "o" ,
			"û" => "u" ,
			"," => ""  ,
			"!" => "" ,
			"#" => "" ,
			"%" => "",
			"¬" => "" ,
			"-" => "-" ,
			"{" => "" ,
			"}" => "" ,
			"^" => ""  ,
			"´" => "" ,
			"`" => "" ,
			"" => "" ,
			"/" => "" ,
			";" => "" ,
			":" => "" ,
			"?" => "" ,
			"¹" => "1" ,
			"²" => "2" ,
			"³" => "3" ,
			"ª" => "a" ,
			"º" => "o" ,
			"ç" => "c" ,
			"ü" => "u" ,
			"ä" => "a" ,
			"ï" => "i" ,
			"ö" => "o" ,
			"ë" => "e" ,
			"$" => "s" ,
			"ÿ" => "y" ,
			"w" => "w" ,
			"<" => "" ,
			">" => "" ,
			"[" => "" ,
			"]" => "" ,
			"&" => "e" ,
			" " => "-" , //aki transformamos os espaços
			"'" => '' ,
			'"' => ""  ,
			'1' => '1' ,
			'2' => '2' ,
			'3' => '3' ,
			'4' => '4' ,
			'5' => '5' ,
			'6' => '6' ,
			'7' => '7' ,
			'8' => '8' ,
			'9' => '9' ,
			'0' => '0'
					);

	private static $acentosArray = array(
			'á' => 'a' , 'Á' => 'A' ,
			'é' => 'e' , 'É' => 'E' ,
			'í' => 'i' , 'Í' => 'i' ,
			'ó' => 'o' , 'Ó' => 'O' ,
			'ú' => 'u' , 'Ú' => 'U' ,
			'â' => 'â' , 'â' => 'â' ,
			'ê' => 'ê' , 'Ê' => 'â' ,
			'ô' => 'ô' , 'Ô' => 'â' ,
			'à' => 'a' , 'À' => 'â' ,
			'ç' => 'c' , 'Ç' => 'C' ,
			'ã' => 'a' , 'Ã' => 'ã' ,
			'õ' => 'o' , 'Õ' => 'o'
	);

	/**
	 * Limpa uma string para ser usada como termo de uma URL
	 * @param string $string
	 * @return string
	*/
	public static function clean($string) {
		
		$finalString = "";
		$string = CleanString::retira_acentos($string);
		
		$string = str_replace("'", "", $string);
		$string = str_replace('"', "", $string);

		$string = strtolower(trim($string));

		$string = filter_var($string, FILTER_SANITIZE_STRING);
		
		foreach(str_split($string) as $str) {
			$finalString .= self::$removeArray[$str];
		}

		$finalString = str_replace("--", "-", $finalString);
		$finalString = str_replace("--", "-", $finalString);

		if(substr($finalString, -1, 1)=="-") {
			$finalString = substr($finalString, 0, -1);
		}

		return $finalString;
	}

	public static function retira_acentos($texto)
	{
		$array1 = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
				, "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
		$array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
				, "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );
		return str_replace( $array1, $array2, $texto);
	}


	/**
	 * Remove os acentos de uma string
	 *
	 * @param string $string
	 * @return string
	 */
	public static function removeAcento($string) {
		$finalString = "";
		$string = str_replace("'", "", $string);
		$string = str_replace('"', "", $string);
		$string = str_replace('&', "", $string);

		$string = trim($string);

		$string = filter_var($string, FILTER_SANITIZE_STRING);

		foreach(str_split($string) as $str) {
			if(key_exists($str, self::$acentosArray)) {
				$finalString .= self::$acentosArray[$str];
			} else {
				$finalString .= $str;
			}
		}

		if(substr($finalString, -1, 1)=="-") {
			$finalString = substr($finalString, 0, -1);
		}

		return $finalString;
	}

}
?>
