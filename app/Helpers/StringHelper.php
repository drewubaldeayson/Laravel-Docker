<?php

namespace App\Helpers;

class StringHelper
{
	public static function random_string($length = 16, $specialCharacters = 0)
	{

		$pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$temp = substr(str_shuffle(str_repeat($pool, 5)), 0, ($length - $specialCharacters));
		if($specialCharacters > 0)
		{
			$SCPool = '!"#$%&()*+,-./:;<=>?@[\]^_`{|}~';
			$temp .= substr(str_shuffle(str_repeat($SCPool, 5)), 0, $specialCharacters);
		}

    	// return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    	return str_shuffle($temp);
	}

	public static function random_num($length = 16)
	{

		$pool = '0123456789';

    	return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}

	public static function check_time_exceeded($from, $interval, $to = null)
	{

		$from = strtotime($interval, strtotime($from));
		$to = ($to == null) ? strtotime(date('Y-m-d H:i:s')) : strotime($to);

		if($from > $to )
			return true;
		else
			return false;

	}

	public static function check_date_if_between($from, $to, $now = null)
	{
		if($now == null)
			$now = date('Y-m-d H:i:s');

		$from = strtotime($from);
		$to = strtotime($to);
		$now = strtotime($now);

		if(($now > $from) && ($now < $to))
			return 'On-Going';
		elseif($now < $from)
			return 'Pending';
		else
			return 'Done';
	}
}

?>
