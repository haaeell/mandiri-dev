<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;

class RichTextSanitizer
{
    private const ALLOWED_TAGS = [
        'a', 'b', 'blockquote', 'br', 'em', 'h2', 'h3', 'h4', 'i',
        'li', 'ol', 'p', 'strong', 'u', 'ul',
    ];

    private const REMOVE_WITH_CONTENT = [
        'embed', 'iframe', 'object', 'script', 'style',
    ];

    public function sanitize(string $html): string
    {
        if (trim($html) === '') {
            return '';
        }

        $document = new DOMDocument('1.0', 'UTF-8');
        $previousErrors = libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="utf-8" ?><div data-rich-root>'.$html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previousErrors);

        $root = $document->getElementsByTagName('div')->item(0);
        if (! $root) {
            return '';
        }

        $this->cleanChildren($root);

        return trim(implode('', array_map(
            fn (DOMNode $node) => $document->saveHTML($node),
            iterator_to_array($root->childNodes),
        )));
    }

    public function forDisplay(string $value): string
    {
        $sanitized = $this->sanitize($value);

        return $sanitized === strip_tags($sanitized)
            ? nl2br(e($sanitized))
            : $sanitized;
    }

    private function cleanChildren(DOMNode $parent): void
    {
        foreach (iterator_to_array($parent->childNodes) as $node) {
            if (! $node instanceof DOMElement) {
                continue;
            }

            $tag = strtolower($node->tagName);
            if (in_array($tag, self::REMOVE_WITH_CONTENT, true)) {
                $parent->removeChild($node);
                continue;
            }

            $this->cleanChildren($node);

            if (! in_array($tag, self::ALLOWED_TAGS, true)) {
                while ($node->firstChild) {
                    $parent->insertBefore($node->firstChild, $node);
                }

                $parent->removeChild($node);
                continue;
            }

            $href = $tag === 'a' ? trim($node->getAttribute('href')) : '';

            foreach (iterator_to_array($node->attributes) as $attribute) {
                $node->removeAttribute($attribute->name);
            }

            if ($tag === 'a') {
                if (preg_match('/^https?:\/\//i', $href)) {
                    $node->setAttribute('href', $href);
                    $node->setAttribute('target', '_blank');
                    $node->setAttribute('rel', 'noopener noreferrer');
                }
            }
        }
    }
}
