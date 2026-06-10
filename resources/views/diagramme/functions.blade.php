@php
use App\Models\Materials;
use App\Models\Settings;

// This function calculates the number of materials in the database based on 3 parameters
function mattenDbNr($art, $color, $height) {
    if (!empty($art) && !empty($color) && !empty($height)) {

        $result = Materials::query();
        $result->select(Materials::raw('SUM(stück) as total_stueck'))
                ->where('material', $art)
                ->where('farbe', $color)
                ->where('höhe', $height);

        $result = $result->first();

        if ($result) {
            $total_stueck = $result->total_stueck;
            return $total_stueck;
        } else {
            return 0; // No matching records found
        }
    }
    return 0; // Assuming 0 should be returned when any parameter is empty
}

function bgColorOne($total_stueck, $color_id, $threshold_one = 10) {
    $defaultColor = '#d7d8dc';

    switch (true) {
        case $total_stueck <= $threshold_one && $total_stueck > 0:
            return '#ff3000';

        case $total_stueck > $threshold_one && $color_id == 7016:
            return '#4B5054';

        case $total_stueck > $threshold_one && $color_id == 6005:
            return '#345247';

        case $total_stueck > $threshold_one && $color_id == 0:
            return '#d7d8dc';

        case $total_stueck === null || $total_stueck === '':
            if ($color_id == 7016) {
                return '#4B5054';
            } elseif ($color_id == 6005) {
                return '#345247';
            } else {
                return $defaultColor;
            }
            break;  // Adding a break statement here

        default:
            return $defaultColor;
    }
}
function bgColorTwo($total_stueck, $color_id, $threshold_two = 10) {
    $defaultColor = '#d7d8dc';

    switch (true) {
        case $total_stueck <= $threshold_two && $total_stueck > 0:
            return '#ff3000';

        case $total_stueck > $threshold_two && $color_id == 7016:
            return '#4B5054';

        case $total_stueck > $threshold_two && $color_id == 6005:
            return '#345247';

        case $total_stueck > $threshold_two && $color_id == 0:
            return '#d7d8dc';

        case $total_stueck === null || $total_stueck === '':
            if ($color_id == 7016) {
                return '#4B5054';
            } elseif ($color_id == 6005) {
                return '#345247';
            } else {
                return $defaultColor;
            }
            break;  // Adding a break statement here

        default:
            return $defaultColor;
    }
}
function bgColorThree($total_stueck, $color_id, $threshold_three = 10) {
    $defaultColor = '#d7d8dc';

    switch (true) {
        case $total_stueck <= $threshold_three && $total_stueck > 0:
            return '#ff3000';

        case $total_stueck > $threshold_three && $color_id == 7016:
            return '#4B5054';

        case $total_stueck > $threshold_three && $color_id == 6005:
            return '#345247';

        case $total_stueck > $threshold_three && $color_id == 0:
            return '#d7d8dc';

        case $total_stueck === null || $total_stueck === '':
            if ($color_id == 7016) {
                return '#4B5054';
            } elseif ($color_id == 6005) {
                return '#345247';
            } else {
                return $defaultColor;
            }
            break;  // Adding a break statement here

        default:
            return $defaultColor;
    }
}

@endphp