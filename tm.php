<?php
Class TM {
	function __construct() {}
	static $states = array('HALT' => array(-1, 0, 'HALT'));
	static $q0 = 'HALT';
	static $tape = array('E', '0', '1', '_', '!', 'E');
	static $epsi = 'E';
	static $T = array('0', '1', '_', //2
			"<?php\ninclude './tm.php';\n", //3
			'TM::Q(\'', //4
			'\',\'', //5
			'\',',   //6
			',\'',   //7
			"\');\n", //8
			'?>', 'E', '!' //11
	);
	static function Q($name, $write_symbol, $move_tape, $next_state) {
		TM::$states[$name] = array($write_symbol, $move_tape, $next_state);
	}
	static function q0 ($name, $silent = false) {
		TM::$q0 = $name;
		TM::EXE($silent);
	}
	static function keycode($read) {
		foreach (TM::$T as $KEY_NUM => $SYMBOL) {
			if ($SYMBOL == $read) 
				return $KEY_NUM;
		}
		die ('KEY NOT FOUND: '.$read);
	}
	static function EXE($silent = false) {
		$state = TM::$q0.'_'.TM::keycode(TM::$tape[0]);
		$state_name = TM::$q0;
		$i = 0;
		while ($state_name != 'HALT') {
			TM::$tape[$i] = TM::$T[TM::$states[$state][0]];
			$j = $i + TM::$states[$state][1];
			if ($j == $i)
				die ('State '.$state.' halts TM unexpectinly.
		i = '.$i.'
		t = '.implode(TM::$tape))."\n";

			if ($j <= -1 || $j >= count(TM::$tape)) {
				if ($j == -1) {
					TM::$tape = array_reverse(TM::$tape);
					TM::$tape[] = TM::$epsi;
					TM::$tape = array_reverse(TM::$tape);
					$j = 0;
				} elseif ($j == count(TM::$tape)) {
					TM::$tape[] = TM::$epsi;
				} else {
					die ('State '.$state.' Too long step.
		i = '.$i.'
		t = '.TM::$tape);
				}
			}
			if (!$silent) {
				echo "STATE $state\n";
				echo "CARET $i\n";
				echo implode(TM::$tape)."\n";
			}
			$i = $j;
			$read = TM::$tape[$i];
			$knum = TM::keycode($read);
			$state = TM::$states[$state][2].'_'.$knum;
			$state_name = TM::$states[$state][2];
			if (!$silent) {
				echo implode(TM::$tape)."\n";
				echo "CARET $i\n\n";
			}
		}
			TM::$tape{$i} = TM::$T[TM::$states[$state][0]];
			if (!$silent) {
				echo "STATE $state\n";
				echo "CARET $i\n";
				echo implode(TM::$tape)."\n\n";
				echo "HALT\n";
			}
			return TM::$tape;
	}
}
?>
