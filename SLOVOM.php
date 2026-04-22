<?php
/***************************************************************************
 *                                slovom.php
 *                            -------------------
 *   
 *   author               : Ljubomir Ljubenov
 *   author web sait      : http://www.ljube.com
 *   e-mail               : ljube@ljube.com
 *   slovom URL           : http://ljube.com/33
 *   Version              : 0.4
 *
 *   Released under the terms and conditions of the
 *   GNU General Public License (http://gnu.org).
 *
***************************************************************************/

/**** neno 10.12.2008 **********************
$write_number = '999999';
$after_point = '99';
$curr = ' лева и ';
$curr_sents = 'ст.';

echo slovom($write_number,$curr,$after_point,$curr_sents);

function slovom($write_number,$curr,$after_point,$curr_sents)
{
********************************************/

/**** neno 10.12.2008 **********************/
function slovom($write_number,$after_point,$prime_cur = ' евро и ',$second_cur = ' евроцента')
{
$curr = $prime_cur;
$curr_sents = $second_cur;
/*******************************************/

	$digits = array("",
	"един",
	"два",
	"три",
	"четири",
	"пет",
	"шест",
	"седем",
	"осем",
	"девет",
	);				
	
	if (strlen($write_number) == 1) 
	{
		$word = single($write_number,$digits); 
	}
	elseif (strlen($write_number) == 2)
	{
		$word = decimal($write_number,$digits);
	}
	elseif (strlen($write_number) == 3)
	{
		$word = hundred($write_number,$digits);
	}
	elseif (strlen($write_number) >= 4 && strlen($write_number) <= 6)
	{
		$word = thousand($write_number,$digits);
	}
	$word = $word.$curr.$after_point.$curr_sents;
	return $word;
}

function single($s,$digits)
{
	$word = $digits[$s];
	return $word;
}

function decimal($s,$digits)
{
		if($s == '10')
		{
			$word = "десет";
		}
		elseif($s{0} == '1')
		{
			$word = ($digits[$s{1}] == "един" ? "еди" : $digits[$s{1}] )."надесет";
		}
		elseif(($s{0} != 1) && ($s{1} == '0'))
		{
			$word = $digits[$s{0}]."десет";
		}
		elseif(($s{0} != 1) && ($s{1} != '0'))
		{
			$word = $digits[$s{0}]."десет и ".$digits[$s{1}];
		}
	return $word;
}

function hundred_round($s,$digits)
{
		if($s == '000')
		{
			$word = "";
		}
		elseif($s == '100')
		{
			$word = "сто";
		}
		elseif($s{1} == '0' && $s{2} == '0' && $s != '100')
		{
			if($digits[$s{0}] == 'два')
			{
				$word = "двеста";
			}
			elseif($digits[$s{0}] == 'три')
			{
				$word = "триста";
			}
			else
			{
				$word = $digits[$s{0}]."стотин";
			}
		}
	return $word;
}

function hundred($s,$digits)
{
		if($s{1} == '0' && $s{2} == '0')
		{
			$word = hundred_round($s,$digits);
		}
		elseif($s{1} == '0' && $s{2} != '0')
		{
			$s_round = substr($s,0,2).'0';
			$word = hundred_round($s_round,$digits)." и ".$digits[$s{2}];
		}
		elseif($s{1} != '0' && $s{2} == '0')
		{	
			$s_round = substr($s,0,1).'00';
			$s_decimal = substr($s,1,2);
			$word = hundred_round($s_round,$digits)." и ".decimal($s_decimal,$digits);
		}
		elseif($s{1} != '1' && $s{2} != '0')
		{
			$s_round = substr($s,0,1).'00';
			$s_decimal = substr($s,1,2);
			$word = hundred_round($s_round,$digits)." ".decimal($s_decimal,$digits);
		}
		elseif($s{1} == '1' && $s{2} != '0')
		{
			$s_round = substr($s,0,1).'00';
			$s_decimal = substr($s,1,2);
			$word = hundred_round($s_round,$digits)." и ".decimal($s_decimal,$digits);
		}
	return $word;
}

function thousand($s,$digits)
{
		if(strlen($s) == 4)
		{
			if($s{0} == '1')
			{		
				$s_hundred = substr($s,1,3);
				$word = "хиляда ".hundred($s_hundred,$digits);
			}
			else
			{
				$s_hundred = substr($s,1,3);
				$word = $digits[$s{0}]." хиляди ".hundred($s_hundred,$digits);
					if (substr($word,0,3) == "два")
					{
						$w_p = explode(" ",$word);
						$w_p[0] = str_replace("два", "две", $w_p[0]);
						$word = implode($w_p, " ");
					}
				$word = str_replace("  ", " ", $word);
			}
		}
		elseif(strlen($s) == 5)
		{
			$s_decimal = substr($s,0,2);
			$s_hundred = substr($s,2,3);
			$word = decimal($s_decimal,$digits)." хиляди ".hundred($s_hundred,$digits);
			$word = str_replace("  ", " ", $word);
		}
		elseif(strlen($s) == 6) /* from Krasi */
		{
			$s_decimal = substr($s,0,3);
			$s_hundred = substr($s,3,3);
			$word = hundred($s_decimal,$digits)." хиляди ".hundred($s_hundred,$digits);
			$word = str_replace(" ", " ", $word);
		}
	return $word;
}

?>