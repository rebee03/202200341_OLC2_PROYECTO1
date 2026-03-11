<?php
require_once 'vendor/autoload.php';
use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener; // Para errores sintácticos

require_once 'GrammarLexer.php';
require_once 'GrammarParser.php';
require_once 'InterpreterVisitor.php';

function interpretCode($code) {
    $input = InputStream::fromString($code);
    $lexer = new GrammarLexer($input);
    $tokens = new CommonTokenStream($lexer);
    $parser = new GrammarParser($tokens);
    $parser->addErrorListener(new DiagnosticErrorListener()); // Captura errores sintácticos
    $tree = $parser->program();

    $visitor = new InterpreterVisitor();
    $visitor->visit($tree);
    return $visitor->getResult();
}

// Prueba
$code = 'func main() { x := 10; fmt.Println(x); }';
$result = interpretCode($code);
echo $result['output']; // 10
print_r($result['errors']);
print_r($result['symbols']);
?>