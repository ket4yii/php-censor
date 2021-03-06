<?php

/**
 * PHPCI - Continuous Integration for PHP
 *
 * @copyright    Copyright 2015, Block 8 Limited.
 * @license      https://github.com/Block8/PHPCI/blob/master/LICENSE.md
 * @link         https://www.phptesting.org/
 */

namespace Tests\PHPCensor\Helper;

use PHPCensor\Helper\AnsiConverter;
use PHPUnit_Framework_TestCase;

class AnsiConverterTest extends PHPUnit_Framework_TestCase
{
    public function testConvert_convertToHtml()
    {
        $input          = "\e[31mThis is red !\e[0m";
        $expectedOutput = '<span class="ansi_color_bg_black ansi_color_fg_red">This is red !</span>';
        $actualOutput   = AnsiConverter::convert($input);

        $this->assertEquals($expectedOutput, $actualOutput);
    }
}
