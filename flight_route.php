<?php

function findRoute($startDest, $endDest, $boardingPasses){

    // Create array to store ordered results
    $flightRoute = array();

    // Set first search criteria to starting destination
    $passCurrent = $startDest;

    do{

        // Match current destination to index key in boardingPasses array
        $pass = array_search($passCurrent, array_column($boardingPasses, 'Source'));

        // Add result to returned array
        array_push($flightRoute, $boardingPasses[$pass]);

        // Update passCurrent (search criteria) to match Destination of previous pass to source of next pass
        $passCurrent = $boardingPasses[$pass]['Dest'];

    } 
    while (count($flightRoute) < count($boardingPasses));

    return($flightRoute);
}

// Target data
$startDest = "SFO";
$endDest   = "NRT";
$boardingPasses = array(
    [
        "Source" => "LAX",
        "Dest"   => "HNL"
    ],
    [
        "Source" => "SFO", 
        "Dest"   => "LAX"
    ],

    [
        "Source" => "HNL",
        "Dest"   => "NRT"
    ]
);

// Call function
$route = findRoute($startDest, $endDest, $boardingPasses);


// Return results
foreach ($route as $airport){

    echo($airport["Source"]."\n");
}

// Retrieves final destination airport
echo($endDest."\n");

?>