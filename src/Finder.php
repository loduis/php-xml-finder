<?php

namespace XML;

use DOMNode;
use DOMXPath;
use DOMDocument;
use SimpleXMLElement;

class Finder
{
    private $namespaces = [];

    private $xpath;

    private $node;

    public function __construct ($node, array $namespaces = [])
    {
        if (!($node instanceof DOMNode)) {
            $doc = new DOMDocument;
            $doc->loadXML($node);
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

    public function all(string $selector)
    {
        /*
        $entries = [];
        $namespaces = $this->namespaces;
        foreach (explode('/', $selector) as $part) {
            if (strpos($part, ':') !== false) {
                [$prefix, $name] = explode(':', $part);
                if ($nameUri = ($namespaces[$prefix] ?? false)) {
                    $part = "*[local-name(.)=\"$name\" and namespace-uri(.)=\"$nameUri\"]";
                }
            }
            $entries[] = $part;
        }
        $selector = implode('/', $entries);
        */
        $nodes = [];
        $result = $this->xpath->query($selector, $this->node);
        foreach ($result as $node) {
            $nodes[] = $node;
        }

        return $nodes;
    }

    public function number(string $selector): int
    {
        $value = $this->text($selector);
        if ($value !== null) {
            return (int) $value;
        }

        return null;
    }

    public function text(string $selector)
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

    public function bool (string $selector): ?bool
    {
      $value = $this->text($selector);
      if ($value !== null) {
        return $value === 'true' ? true : false;
      }

      return null;
    }

    public function first(string $selector)
    {
        return $this->all($selector)[0];
    }

    public function new ($node, $namespaces = []): Finder
    {
        if (is_string($node)) {
            $node = $this->first($node);
        }

        return Finder::create($node, $namespaces);
    }
}
