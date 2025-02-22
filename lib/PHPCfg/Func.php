<?php

declare(strict_types=1);

/**
 * This file is part of PHP-CFG, a Control flow graph implementation for PHP
 *
 * @copyright 2015 Anthony Ferrara. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace PHPCfg;

use PHPCfg\Op\CallableOp;

class Func extends Op
{
    /* Constants for the $flags property.
     * The first six flags match PhpParser Class_ flags. */
    public const FLAG_PUBLIC = 0x01;

    public const FLAG_PROTECTED = 0x02;

    public const FLAG_PRIVATE = 0x04;

    public const FLAG_STATIC = 0x08;

    public const FLAG_ABSTRACT = 0x10;

    public const FLAG_FINAL = 0x20;

    public const FLAG_RETURNS_REF = 0x40;

    public const FLAG_CLOSURE = 0x80;

    /** @var string */
    public $name;

    /** @var int */
    public $flags;

    /** @var */
    public Op\Type $returnType;

    /** @var Operand\Literal */
    public $class;

    /** @var Op\Expr\Param[] */
    public $params;

    /** @var Block|null */
    public $cfg;

    /** @var CallableOp|null */
    public $callableOp;

    public function __construct(string $name, int $flags, Op\Type $returnType, ?Operand $class, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->name = $name;
        $this->flags = $flags;
        $this->returnType = $returnType;
        $this->class = $class;
        $this->params = [];
        $this->cfg = new Block();
    }

    public function getScopedName()
    {
        if (null !== $this->class) {
            return $this->class->value . '::' . $this->name;
        }

        return $this->name;
    }
}
