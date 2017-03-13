<?php
/*
$filters = [
    'published' => true/false,
    'title' => '',
    'composer_id' => '',
    'epoque_id'
    'language_id' => '',
    'cantus_id' => '',
    'text_id' => '',
    'instrumentation_id' => '',
    'gender' =>'',
    'difficulty_id' => '',    
];
*/

/*
function filterPieces($filters) {
    
    //remove all null entries of $filters
    $filters = $filters->filter($filters);
    
    // fetch pieces from database
    if ($filters['published']) {
        $pieces = Piece::
            where('EditionNumer','>',0)->all();
    } else {
        $pieces = Piece::
            where('EditionNumber',0)->all();
    }
    
    foreach $filters as filter {
        $pieces = $pieces->filter(function($filtervalue, $filterkey) {
            
            
            
        })->all();
    }

    return $pieces;
}
*/
