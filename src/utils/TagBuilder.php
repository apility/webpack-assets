<?php


namespace Apility\WebpackAssets\utils;


use Tightenco\Collect\Support\Collection;

class TagBuilder {
  /**
   * @param $tagName
   * @param Collection $attributes
   * @param string $content [optional]
   * @param string $closing [optional]
   * @return string
   */
  static function createTag($tagName, $attributes, $content = null, $closing = 'closing') {
    $openingTagStart = "<{$tagName}";

    $tagAttributes = $attributes->count() > 0
      ? " {$attributes->map(function ($value, $name) { return "{$name}=\"{$value}\""; })->join(' ')}"
      : "";

    $openingTagEnd = null;
    if ($closing === 'closing' || $closing === 'non-closing') {
      $openingTagEnd = '>';
    } else if ($closing === 'self-closing') {
      $openingTagEnd = '/>';
    }

    $tagContent = $closing === 'closing'
      ? $content
      : '';

    $closingTag = $closing === 'closing'
      ? "</{$tagName}>"
      : '';

    return $openingTagStart . $tagAttributes . $openingTagEnd . $tagContent . $closingTag;
  }
}
