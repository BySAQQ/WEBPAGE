<?php



/*
 * Complete the 'restock' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER_ARRAY itemCount
 *  2. INTEGER target
 */

function restock($itemCount, $target)
{
    $purchases = 0;
    $x = 0;
    while ($purchases < $target && $x < count($itemCount)) {
        $purchases += $itemCount[$x];
        $x++;
    }
    if ($purchases > $target) {
        $resales = $purchases - $target;
        return $resales;
    } else {
        $additional = $target - $purchases;
        return $additional;
    }
};
$fptr = fopen(getenv("OUTPUT_PATH"), "w");


$itemCount_count = intval(trim(fgets(STDIN)));

$itemCount = array();

for ($i = 0; $i < $itemCount_count; $i++) {
    $itemCount_item = intval(trim(fgets(STDIN)));
    $itemCount[] = $itemCount_item;
}

$target = intval(trim(fgets(STDIN)));

$result = restock($itemCount, $target);

fwrite($fptr, $result . "\n");

fclose($fptr);

//code 2
function minTime($packages)
{
    $n = count($packages);
    $time = 0;

    $total = array_sum($packages);

    $prefix_sum = array_fill(0, $n, 0);
    $prefix_sum[0] = $packages[0];
    for ($i = 1; $i < $n; $i++) {
        $prefix_sum[$i] = $prefix_sum[$i - 1] + $packages[$i];
    }

   
    for ($i = 0; $i < $n - 1; $i++) {
        $distance = $prefix_sum[$n - 1] - $prefix_sum[$i];
        $time += $distance;

        $time += $prefix_sum[$i];

        $total -= $packages[$i];

        if ($total == 0) {
            return $time;
        }
    }

    $time += $prefix_sum[$n - 1];

    return $time;
}


//code 2.1

function min_Time($packages) {
    $n = count($packages);
    $prefixSum = array_fill(0, $n, 0); // initialize prefix sum array
    $suffixSum = array_fill(0, $n, 0); // initialize suffix sum array
    
    // calculate prefix sum and suffix sum
    for ($i = 0; $i < $n; $i++) {
        $prefixSum[$i] = ($i == 0) ? $packages[$i] : $prefixSum[$i-1] + $packages[$i];
        $suffixSum[$n-$i-1] = ($i == 0) ? $packages[$n-$i-1] : $suffixSum[$n-$i] + $packages[$n-$i-1];
    }
    
    $minTime = PHP_INT_MAX;
    
    // find the minimum time by checking each bin as a candidate endpoint
    for ($i = 0; $i < $n; $i++) {
        $time = 0;
        $load = 0;
        
        if ($i > 0) {
            $time += $i;
            $load += $prefixSum[$i-1];
        }
        
        if ($i < $n-1) {
            $time += $n-$i-1;
            $load += $suffixSum[$i+1];
        }
        
        $time += $load;
        
        $minTime = min($minTime, $time);
    }
    
    return $minTime;
}
