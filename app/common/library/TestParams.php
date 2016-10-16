<?php
/**
 * Created by PhpStorm.
 * User: SONY
 * Date: 16-10-2016
 * Time: 10:35 AM
 */
namespace Webxucxich\Common\Library;

use Webxucxich\Common\Library\RemoveUnicode;

class UtilsTest
{
    public static function CreateSlug($text)
    {
        $text = RemoveUnicode::SpaceUnicode($text);
        $text = \preg_replace('/[^A-Za-z0-9\-]/', " ", $text);
        $text = \str_replace(" ", "-", $text);
        return $text;
    }
}