<?php

namespace XML;

use DOMNode;
use DOMXPath;
use DOMDocument;

class Finder
{
    private $xpath;

    private $node;

    public function __construct($node, array $namespaces = [])
    {
        if (!($node instanceof DOMNode)) {
            $doc = new DOMDocument;
            if (stripos($node, '</html>') !== false) {
                $doc->loadHTML($node);
            } else {
                $doc->loadXML($node);
            }
            $node = $doc;
        }
        $doc = $node;
        if (!($node instanceof DOMDocument)) {
            $this->node = $node;
            $doc = $node->ownerDocument;
        }
        $this->xpath = new DOMXPath($doc);
        foreach ($namespaces as $prefix => $uri) {
            $this->xpath->registerNamespace($prefix, $uri);
        }
    }

    public static function create($node, array $namespaces = []): Finder
    {
        return new Finder($node, $namespaces);
    }

    public function all(string $selector): iterable
    {
        $nodes = [];
        $result = $this->xpath->query($selector, $this->node);
        foreach ($result as $node) {
            $nodes[] = $node;
        }

        return $nodes;
    }

    public function number(string $selector): ?int
    {
        $value = $this->text($selector);

        return $value === null ? null : (int) $value;
    }

    public function int(string $selector): ?int
    {
        $value = $this->text($selector);

        return $value === null ? null : (int) $value;
    }

    public function float(string $selector): ?float
    {
        $value = $this->text($selector);

        return $value === null ? null : (float) $value;
    }

    public function text(string $selector): ?string
    {
        if (strpos($selector, '@') === false) {
            $selector .= '/text()';
        }
        $node = $this->all($selector);
        if (count($node) === 1) {
            return $node[0]->nodeValue;
        }

        return null;
    }

    public function bool(string $selector): ?bool
    {
      $value = $this->text($selector);

      return $value === null ? null : ($value === 'true' ? true : false);
    }

    public function first(string $selector): ?DOMNode
    {
        return $this->all($selector)[0] ?? null;
    }

    public function c14n(string $selector, ...$options): ?string
    {
        $node = $this->first($selector);

        return $node === null ? null : $node->C14N(...$options);
    }

    public function new($node, $namespaces = []): ?Finder
    {
        if (is_string($node)) {
            $node = $this->first($node);
        }

        return $node === null ? null : Finder::create($node, $namespaces);
    }
}
