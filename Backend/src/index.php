<?php

require __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/GrammarLexer.php';
require_once __DIR__ . '/GrammarParser.php';
require_once __DIR__ . '/GrammarVisitor.php';
require_once __DIR__ . '/GrammarBaseVisitor.php';
require_once __DIR__ . '/Interpreter.php';

require_once __DIR__ . '/Value.php';
require_once __DIR__ . '/Environment.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;

$input = InputStream::fromString('15 - 3 / 4 + (2 * 5)');

// Código de prueba de Golampi
$inputString = '
var saludo string = "Hola Mundo";
var edad int32 = 25;
fmt.Println(saludo, edad);
';

$input = InputStream::fromString($inputString);
$lexer = new GrammarLexer($input);
$tokens = new CommonTokenStream($lexer);
$parser = new GrammarParser($tokens);

//$tree = $parser->l();

$tree = $parser->start(); // Empezamos desde la regla 'start'

$interpreter = new Interpreter();
$result = $interpreter->visit($tree);
//echo "Result: " . $result . PHP_EOL;