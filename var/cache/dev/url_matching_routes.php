<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/lucky/number/([^/]++)(*:29)'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:64)'
                .'|/hash/([^/]++)(*:85)'
                .'|/api/([^/]++)/([^/]++)(*:114)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        29 => [[['_route' => 'app_lucky_number', '_controller' => 'App\\Controller\\HashStringController::process'], ['max'], null, null, false, true, null]],
        64 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        85 => [[['_route' => 'api_post_show', '_controller' => 'App\\Controller\\HashStringController::hash_string'], ['inicial'], ['GET' => 0, 'HEAD' => 1], null, true, true, null]],
        114 => [
            [['_route' => 'api_post_api', '_controller' => 'App\\Controller\\HashStringController::hash_string'], ['inicial', 'json'], ['GET' => 0, 'HEAD' => 1], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
