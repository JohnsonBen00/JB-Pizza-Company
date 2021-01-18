<?php
$urls = ["./pizzas/CH", "./pizzas/PP", "./pizzas/SG", "./pizzas/HA", "./pizzas/CB"];
$arr = [];
$index = $_GET['index'];
for ($i = 0; $i < count($urls); $i++) {
	array_push( $arr, $urls[$i] . '/cover.jpg ');
}
if ($index >= 0) {
	$arr2 = [];
	$arr3 = [];
	array_push( $arr2, $urls[$index] . '/cover.jpg ');
	$file = $urls[$index] . '/info.txt';
	$file_open = fopen($file, 'r');
	while(!feof($file_open)) {
		array_push( $arr2, fgets($file_open));
	}
	$file = $urls[$index] . '/ingredients.txt';
	$file_open = fopen($file, 'r');
	while(!feof($file_open)) {
		array_push( $arr2, fgets($file_open));
	}
	for ($j = 0; $j < count($arr2); $j++) {
		if ($arr2[$j] != false) {
			if ($arr2[$j] != "\n")
				array_push($arr3, $arr2[$j]);
		}
	}
	echo json_encode($arr3);
}
else {
	echo json_encode($arr);
}
?>