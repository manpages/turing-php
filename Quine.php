<?php
include 'tm.php';
include 'Utils/MetaProcessor.php';
include 'Algorithms/Base.php';

/*B::SeekForChar(-1, 1, '!', 
	B::Move(1, 11, 
		'HALT'
	)
);*/
$seek = B::SeekForChar(-1, 1, '!', 'HALT');
$move = B::Move(1, 11, $seek);

//

$start = "TM::q0('$move');\n";
file_put_contents('Quine.tm.php', MP::$b."$start?>");
?>
