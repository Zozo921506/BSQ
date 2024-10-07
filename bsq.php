<?php

$file = file($argv[1]);
$tab = [];
foreach ($file as $line) 
{
    $line = trim($line);
    $line = str_replace(['o', '.'], [0, 1], $line);
    $array = str_split($line);
    $tab[] = $array;
}

$nb_line = array_shift($tab);
$nb_col = count($tab[0]);
$tmp = $tab;

$max_size = 0;
$max_row = 0;
$max_col = 0;

for ($j = 1; $j < count($tab); $j++) 
{
    for ($i = 1; $i < count($tab[$j]); $i++) 
    {
        if ($tab[$j][$i] != 0) 
        {
            $tmp[$j][$i] = min($tmp[$j-1][$i], $tmp[$j][$i-1], $tmp[$j-1][$i-1]) + 1;
            if ($tmp[$j][$i] > $max_size) 
            {
                $max_size = $tmp[$j][$i];
                $max_col = $j;
                $max_row = $i;
            }
        }
    }
}

for ($j = $max_col; $j > $max_col - $max_size; $j --) 
{
    for ($i = $max_row; $i > $max_row - $max_size; $i --) 
    {
        $tab[$j][$i] = 'x';
    }
}

foreach ($tab as $line) 
{
    $line = str_replace([0, 1], ['o', '.'], $line);
    echo implode('', $line) . "\n";
}
?>
