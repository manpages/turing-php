<?php
Class B {
	function __construct () {}
	static function Move ($dir, $n, $cb) {
		$y = MP::p();
		if ($n == 1) {
			foreach (TM::$T as $code => $alpha) {
				MP::$b .= 'TM::Q(\''.$y.'_'.$code.'\','.$code.','.$dir.',\''.$cb.'\');'."\n";
			}
			return $y;
		}
		foreach (TM::$T as $code => $alpha) {
			MP::$b .= 'TM::Q(\''.$y.'_'.$code.'\','.$code.','.$dir.',\''.MP::n($y).'\');'."\n";
		}
		B::Move($dir, $n-1, $cb);
		return $y;
	}

	static function SeekForChar ($dir, $n, $char, $cb) {
		$y = MP::p();
		if ($n == 1) {
			$mv = MP::n($y);
			foreach (TM::$T as $code => $alpha) {
				if ($char != $alpha || $alpha != TM::$epsi) {
					MP::$b .="TM::Q('$y".'_'."$code',$code,$dir,'$y');\n";
				} else {
					MP::$b .="TM::Q('$y".'_'."$code',$code,$dir,'$mv');\n";
				}
			}
			B::Move($dir*(-1),1,$cb);
			return $y;
		}
		foreach (TM::$T as $code => $alpha) {
			if ($char != $alpha || $alpha != TM::$epsi) {
				MP::$b .="TM::Q('$y".'_'."$code',$code,$dir,'".$y."');\n";
			} elseif ($char == $alpha) {
				MP::$b .="TM::Q('$y".'_'."$code',$code,$dir,'".MP::n($y)."');\n";
			} else {
				MP::$b .="TM::Q('$y".'_'."$code',$code,(-1)*$dir,'".MP::n($y)."');\n";
			}
			B::SeekForChar($dir, $n-1, $char, $cb);
			return $y;
		}
	}
}
