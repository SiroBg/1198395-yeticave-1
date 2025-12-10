<?php

$queryGetRecentLots =
    'SELECT lots.*, cats.name AS category '
    . 'FROM lots JOIN cats ON lots.cat_id = cats.id '
    . 'ORDER BY lots.created_at DESC LIMIT 6';

$queryGetCategories = 'SELECT * FROM cats';

return [
    'lots' => $queryGetRecentLots,
    'cats' => $queryGetCategories
];
