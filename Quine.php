<?php
include 'tm.php';
include 'Utils/MetaProcessor.php';
include 'Algorithms/Base.php';

/* Surely, this piece of code is not a complete quine in PHP Turing Machine Code Generator.
   I guess that I got my grade by simply explaining how this thing works, thus lost the interest
   (because, well, it really works, which is amusing). But now that I shed a manly tear, I want
   to finish this quine meta-programm as a hat-tip to the school days. */

$seek = B::SeekForChar(-1, 1, '!', 'HALT');
$move = B::Move(1, 11, $seek);

//

$start = "TM::q0('$move');\n";
file_put_contents('Quine.tm.php', MP::$b."$start?>");
?>
