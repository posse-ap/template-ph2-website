<?php
$name = "望月恵祐";
print "Hello, $name!";

$numbers = [1, 2, 3, 4, 5];
$sum = 0;
foreach ($numbers as $number) {
    $sum += $number;
}
print $sum;

$age = 25;
if ($age < 20) {
    print 'あなたは子どもです!';
} elseif ($age < 60) {
    print 'あなたは大人です!';
} else {
    print 'あなたは高齢者です!';
}
?>