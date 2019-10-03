<?php
$head = new SplQueue();
$head->enqueue('a');
$head->enqueue('b');
echo $head->dequeue();
echo $head->dequeue();
var_dump($head);