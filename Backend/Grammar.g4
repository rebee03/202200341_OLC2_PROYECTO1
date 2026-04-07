grammar Grammar;

// ─────────────────────────────────────────
// REGLAS SINTÁCTICAS
// ─────────────────────────────────────────

program: declaration* EOF;

// Declaraciones de nivel superior (global)
declaration
    : varDecl
    | constDecl
    | functionDecl
    ;

// ── Variables ────────────────────────────
// var x int32 = 10
// var w, z int32 = 1, 2
varDecl
    : VAR identifierList type ('=' expressionList)? ';'?
    ;

// ── Constantes ───────────────────────────
// const max int32 = 100
constDecl
    : CONST ID type '=' expression ';'?
    ;

// ── Funciones ────────────────────────────
// func suma(a int32, b int32) int32 { ... }
// func dividir(a int32, b int32) (int32, bool) { ... }
functionDecl
    : FUNC ID '(' parameterList? ')' returnType? block
    ;

parameterList
    : parameter (',' parameter)*
    ;

// Parámetro normal o puntero: a int32 | a *int32 | a [5]int32
parameter
    : ID type
    ;

// Tipo de retorno simple o múltiple
returnType
    : type
    | '(' type (',' type)* ')'
    ;

// ── Tipos ────────────────────────────────
type
    : basicType                       // int32, float32, bool, rune, string
    | '*' type                        // *int32  (puntero)
    | '[' expression ']' type         // [5]int32 (arreglo)
    | '[' expression ']' '[' expression ']' type  // [2][3]int32 (2D)
    ;

basicType
    : INT32
    | FLOAT32
    | BOOL_TYPE
    | RUNE
    | STRING_TYPE
    ;

// ── Bloque ───────────────────────────────
block
    : '{' statement* '}'
    ;

// ── Sentencias ───────────────────────────
statement
    : varDecl
    | constDecl
    | simpleStmt ';'?
    | returnStmt ';'?
    | breakStmt ';'?
    | continueStmt ';'?
    | ifStmt
    | switchStmt
    | forStmt
    | block
    ;

// Sentencias simples
simpleStmt
    : shortVarDecl          // x, y := 1, 2
    | assignment            // x = 5  |  x += 2
    | incDecStmt            // i++  |  i--
    | expressionStmt        // llamada a función, etc.
    ;

// Declaración corta  x, y := expr, expr
shortVarDecl
    : identifierList ':=' expressionList
    ;

// Asignación simple o compuesta
assignment
    : expressionList assignOp expressionList
    ;

assignOp
    : '='
    | '+='
    | '-='
    | '*='
    | '/='
    ;

// Incremento / Decremento  i++  i--
incDecStmt
    : expression ('++' | '--')
    ;

// Expresión usada como sentencia (ej. llamada a función)
expressionStmt
    : expression
    ;

// ── Transferencia ────────────────────────
returnStmt
    : RETURN expressionList?
    ;

breakStmt
    : BREAK
    ;

continueStmt
    : CONTINUE
    ;

// ── If / Else ────────────────────────────
// if x > 0 { ... }
// if x > 0 { ... } else { ... }
// if x > 0 { ... } else if x == 0 { ... } else { ... }
ifStmt
    : IF expression block
    | IF expression block ELSE block
    | IF expression block ELSE ifStmt
    ;

// ── Switch ───────────────────────────────
// switch day { case 1: ... case 2,3: ... default: ... }
switchStmt
    : SWITCH expression? '{' caseClause* defaultClause? '}'
    ;

caseClause
    : CASE caseExprList ':' statement*
    ;

caseExprList
    : expression (PIPE expression)*
    ;

defaultClause
    : DEFAULT ':' statement*
    ;

// ── For ──────────────────────────────────
// Tres variantes:
//   for i := 0; i < 5; i++ { }          -> estilo C
//   for x > 0 { }                        -> estilo while
//   for { }                              -> infinito
forStmt
    : FOR forClause block           // estilo C
    | FOR expression block          // estilo while
    | FOR block                     // infinito
    ;

// Cláusula del for estilo C: init ; cond ; post
forClause
    : simpleStmt? ';' expression? ';' simpleStmt?
    ;

// ─────────────────────────────────────────
// EXPRESIONES
// ─────────────────────────────────────────

expression
    : unaryExpr
    | expression binaryOp expression
    ;

unaryExpr
    : primaryExpr
    | unaryOp unaryExpr
    ;

binaryOp
    : '||'
    | '&&'
    | XOR
    | relOp
    | addOp
    | mulOp
    ;

relOp  : '==' | '!=' | '<' | '<=' | '>' | '>=' ;
addOp  : '+' | '-' ;
mulOp  : '*' | '/' | '%' ;
unaryOp: '+' | '-' | '!' | '*' | '&' ;

// Expresiones primarias
primaryExpr
    : operand                                   // literal, variable, (expr)
    | primaryExpr '[' expression ']'            // acceso a arreglo  a[0]
    | primaryExpr '[' expression ']' '[' expression ']'  // 2D  m[i][j]
    | primaryExpr '(' expressionList? ')'       // llamada  suma(3, 4)
    | basicType '(' expression ')'              // type cast  float32(5)
    ;

operand
    : literal
    | qualifiedIdent                            // ID  o  fmt.Println
    | '(' expression ')'
    ;

// Identificador simple o calificado (fmt.Println, fmt.Print, etc.)
qualifiedIdent
    : ID ('.' ID)*
    ;

literal
    : basicLiteral
    | arrayLiteral
    ;

basicLiteral
    : INT_LIT
    | FLOAT_LIT
    | STRING_LIT
    | RUNE_LIT
    | BOOL_LIT
    | NIL
    ;

// Literales de arreglo:
//   [3]int32{1, 2, 3}
//   [2][2]int32{{1,2},{3,4}}
arrayLiteral
    : '[' expression ']' type '{' arrayElements '}'
    ;

arrayElements
    : arrayElement (',' arrayElement)* ','?
    |               // vacío
    ;

arrayElement
    : '{' arrayElements '}'      // fila de arreglo 2D  {1, 2}
    | expression
    ;

identifierList
    : ID (',' ID)*
    ;

expressionList
    : expression (',' expression)*
    ;

// ─────────────────────────────────────────
// TOKENS — PALABRAS RESERVADAS
// ─────────────────────────────────────────

VAR      : 'var' ;
CONST    : 'const' ;
FUNC     : 'func' ;
IF       : 'if' ;
ELSE     : 'else' ;
FOR      : 'for' ;
SWITCH   : 'switch' ;
CASE     : 'case' ;
DEFAULT  : 'default' ;
RETURN   : 'return' ;
BREAK    : 'break' ;
CONTINUE : 'continue' ;
NIL      : 'nil' ;

// Tipos como tokens (para type casting y basicType)
INT32      : 'int32' ;
FLOAT32    : 'float32' ;
BOOL_TYPE  : 'bool' ;
RUNE       : 'rune' ;
STRING_TYPE: 'string' ;

// Literales booleanos
BOOL_LIT : 'true' | 'false' ;

// ─────────────────────────────────────────
// TOKENS — LITERALES
// ─────────────────────────────────────────

// Entero: 0, 123, 9999
INT_LIT  : [0-9]+ ;

// Float: 3.14, 0.5
FLOAT_LIT: [0-9]+ '.' [0-9]+ ;

// String entre comillas dobles, con escapes
STRING_LIT: '"' ( '\\' . | ~[\\"\r\n] )* '"' ;

// Rune entre comillas simples: 'a', '\n', '\u0041'
RUNE_LIT : '\'' ( '\\' . | ~[\\'\r\n] ) '\'' ;

// ─────────────────────────────────────────
// TOKENS — IDENTIFICADORES Y ESPACIOS
// ─────────────────────────────────────────

// Identificador: empieza con letra o _, seguido de letras/dígitos/_

XOR : '^^' ;

PIPE : '|' ;

ID : [a-zA-Z_][a-zA-Z0-9_]* ;

// Comentarios (ignorados)
LINE_COMMENT  : '//' ~[\r\n]*        -> skip ;
BLOCK_COMMENT : '/*' .*? '*/'        -> skip ;

// Espacios en blanco (ignorados)
WS : [ \t\r\n]+ -> skip ;