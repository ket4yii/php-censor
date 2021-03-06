<?php

/**
 * PHPCI - Continuous Integration for PHP
 *
 * @copyright    Copyright 2015, Block 8 Limited.
 * @license      https://github.com/Block8/PHPCI/blob/master/LICENSE.md
 * @link         https://www.phptesting.org/
 */

return function (PHPCensor\Plugin\Util\Factory $factory) {
    $factory->registerResource(
        // This function will be called when the resource is needed.
        function() {
            return [
                'bar' => "Hello",
            ];
        },
        "requiredArgument",
        null
    );
};
