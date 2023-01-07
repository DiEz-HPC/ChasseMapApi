<?php

namespace App\Doctrine;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class MySqlDistanceFunction extends FunctionNode
{
    public $firstArg;
    public $secondArg;

    public function getSql(SqlWalker $sqlWalker)
    {
        return 'ST_Distance_Sphere(' .
            $this->firstArg->dispatch($sqlWalker) . ', ' .
            $this->secondArg->dispatch($sqlWalker) .
        ')';
    }

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->firstArg = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secondArg = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
