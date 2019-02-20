<?php

class NumberTowords{
	private static $space = ' ';
	private static $dash  = '-';
	private static $unit  = array(
		3  => 'thousand',
		6  => 'million',
		9  => 'billion',
		12 => 'trillion',
		15 => 'quadrillion',
		18 => 'quintillion',
		21 => 'sextillion',
		24 => 'septillion',
		27 => 'octillion',
		30 => 'nonillion',
		33 => 'decillion',
		36 => 'undecillion',
		39 => 'duodecillion',
		42 => 'tredecillion',
		45 => 'quattuordecillion',
		48 => 'quindecillion',
		51 => 'sexdecillion',
		54 => 'septendecillion',
		57 => 'octadecillion',
		60 => 'novemdecillion',
		63 => 'vigintillion',
		66 => 'unvigintillion',
		69 => 'duovigintillion',
		72 => 'trevigintillion',
		75 => 'quattuorvigintillion',
		78 => 'quinvigintillion',
		81 => 'sexvigintillion',
		84 => 'septenvigintillion',
		87 => 'octavigintillion',
		90 => 'novemvigintillion',
		93 => 'trigintillion',
		96 => 'untrigintillion',
		99 => 'duotrigintillion',
	);
	private static $word = array(
		0   => 'zero',
		1   => 'one',
		2   => 'two',
		3   => 'three',
		4   => 'four',
		5   => 'five',
		6   => 'six',
		7   => 'seven',
		8   => 'eight',
		9   => 'nine',
		10  => 'ten',
		11  => 'eleven',
		12  => 'twelve',
		13  => 'thirteen',
		14  => 'fourteen',
		15  => 'fifteen',
		16  => 'sixteen',
		17  => 'seventeen',
		18  => 'eighteen',
		19  => 'nineteen',
		20  => 'twenty',
		30  => 'thirty',
		40  => 'fourty',
		50  => 'fifty',
		60  => 'sixty',
		70  => 'seventy',
		80  => 'eighty',
		90  => 'ninety',
		100 => 'hundred'
	);
	
	public static function convert($number){
	    $output="";
		if(!is_numeric($number)) throw new Exception("Not a valid number.", 1);
		
		$number=str_replace('+', '', $number);
		$number=str_replace('-', '', $number);
		$number=str_replace('.', '', $number);
		$len=strlen($number);
		if($len>99) throw new Exception("Too big number, maximum string length is 99", 1);
		
		for($i=$len;$i>0;$i-=3){
			$pos=3*((int)($len/3)-(int)($i/3));
			$start=$i-3;
			$stop=3;
			if($start<0){
				$stop=3+$start;
				$start=0;
			}
			$temp=static::loop(substr($number,$start,$stop)).static::$space;
			if($i!=$len) $temp.=static::$unit[$pos].static::$space;
			$output=$temp.$output;
		}
		return $output;
	}
	private static function loop($number){
		$number=(int)$number;
	    $output="";
	    if($number<=20){
			$output=static::$word[$number];
		}elseif($number<=99){
			$base=10;
			$main=$number/$base;
			$rest=$number%$base;
			$output=static::$word[(int)$main*$base];
			if($rest) $output.=static::$dash.static::$word[$rest];
		}else{
			$base=100;
			$main=$number/$base;
			$rest=$number%$base;
			$output=static::loop((int)$main).static::$space.static::$word[$base];
			if($rest) $output.=static::$space.static::loop($rest);
		}
		return $output;
	}
}
?>