<?php

declare(strict_types=1);

namespace PhpStubs\WordPress\Core;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Function_;
use StubsGenerator\NodeVisitor;

class ConstantsExtractor {
    /** @var array<string> */
    private array $functionsWithConstants = [
        'wp_initial_constants',
    ];

    private NodeVisitor $visitor;

    public function __construct(NodeVisitor $visitor)
    {
        $this->visitor = $visitor;
    }

    public function addFunctionWithConstants(string $functionName): void
    {
        if (in_array($functionName, $this->functionsWithConstants, true)) {
            return;
        }

        $this->functionsWithConstants[] = $functionName;
    }

    public function processNode(Node $node): void
    {
        if (! ($node instanceof Function_)) {
            return;
        }

        if (! in_array($node->name->toString(), $this->functionsWithConstants, true)) {
            return;
        }

        foreach ($node->stmts as $stmt) {
            if (! $this->isDefineStatement($stmt)) {
                continue;
            }

            $this->visitor->addNodeToGlobalNamespace($stmt);
        }

        $node->stmts = [];
    }

    private function isDefineStatement(Node $stmt): bool
    {
        return $stmt instanceof Expression &&
            $stmt->expr instanceof FuncCall &&
            $stmt->expr->name instanceof Name &&
            $stmt->expr->name->toString() === 'define';
    }
}
