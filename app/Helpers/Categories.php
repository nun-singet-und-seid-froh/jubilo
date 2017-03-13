<?php

function listAllCategories() {
  $categories = [
    'Piece',
    'Composer',
    'Lyricist',
    'Instrumentation',
    'Difficulty',
    'Language',
    'Year',
    'Epoque',
    'Cantus',
    'Pretext',
    'Opus',
    'Compilation',
  ];
 
  return $categories;
}

function listShowCategories() {
  $exclude = [
    'Year',
  ];
 
  $categories = array_diff(listAllCategories(), $exclude);
  return $categories;
}


function listDownloadCategories() {
    $categories = [
      'pdf',
      'midifiles',
      'recording',
  ];
 
  return $categories;
}
