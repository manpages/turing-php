<?php
	Class MP {
		//buffer of tm code
		static $b = "<?php\ninclude 'tm.php';\n";
		//current state number
		public static $i = "5000010004";
		static function p() {
			for($j = strlen(MP::$i) - 1; $j >= 0; --$j) {
				$v = MP::$i[$j];
				if ($v == '0') {
					MP::$i[$j] = '1';
					return MP::$i;
				} else {
					MP::$i[$j] = '0';
				}
			}
			die ('WTF OVERFLOW?');
		}
		static function n($n) {
			for($j = strlen($n) - 1; $j >= 0; --$j) {
				$v = $n[$j];
				if ($v == '0') {
					$n[$j] = '1';
					return $n;
				} else {
					$n[$j] = '0';
				}
			}
			die ('WTF OVERFLOW?');
		}
	}

?>
