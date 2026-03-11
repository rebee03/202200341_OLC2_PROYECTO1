grammar Grammar;

// Reglas sintácticas

program: declaration* EOF;

declaration: varDecl | constDecl | functionDecl;

varDecl: 'var' identifierList type ('=' expressionList)? ';';

constDecl: 'const' ID (type)? '=' expression ';';

functionDecl: 'func' ID '(' parameterList? ')' returnType? block;

parameterList: parameter (',' parameter)*;

parameter: ID type;

returnType: type | '(' type (',' type)* ')';

type: basicType | '*' type | '[' expression ']' type;

basicType: 'int32' | 'float32' | 'bool' | 'run' | 'string';

block: '{' statementList '}';

statementList: statement*;

statement:
    declaration
    | simpleStmt ';'
    | returnStmt ';'
    | breakStmt ';'
    | continueStmt ';'
    | ifStmt
    | switchStmt
    | forStmt
    | block
    ;

simpleStmt:
    shortVarDecl
    | assignment
    | expressionStmt
    ;

shortVarDecl: identifierList ':=' expressionList;

assignment: expressionList assignOp expressionList;

assignOp: '=' | '+=' | '-=' | '*=' | '/=';

expressionStmt: expression;

returnStmt: 'return' expressionList?;

breakStmt: 'break';

continueStmt: 'continue';

ifStmt: 'if' (simpleStmt ';')? expression block ('else' (ifStmt | block))?;

switchStmt: 'switch' (simpleStmt ';')? expression? '{' caseClause* defaultClause? '}';

caseClause: 'case' expressionList ':' statementList;

defaultClause: 'default' ':' statementList;

forStmt: 'for' (simpleStmt ';')? expression? (';' simpleStmt)? block;

expression:
    unaryExpr
    | expression binaryOp expression
    ;

unaryExpr:
    primaryExpr
    | unaryOp unaryExpr
    ;

binaryOp:
    '||'
    | '&&'
    | relOp
    | addOp
    | mulOp
    ;

relOp: '==' | '!=' | '<' | '<=' | '>' | '>=';

addOp: '+' | '-';

mulOp: '*' | '/' | '%';

unaryOp: '+' | '-' | '!' | '*' | '&';

primaryExpr:
    operand
    | primaryExpr actualArgs
    | primaryExpr '[' expression ']'
    ;

operand:
    literal
    | qualifiedIdent
    | '(' expression ')'
    ;

qualifiedIdent: ID ('.' ID)?;

actualArgs: '(' expressionList? ')';

literal:
    basicLiteral
    | arrayLiteral
    ;

basicLiteral: INT | FLOAT | STRING | RUNE | BOOLEAN | NIL;

arrayLiteral: '[' expression ']' type '{' expressionList? '}';

identifierList: ID (',' ID)*;

expressionList: expression (',' expression)*;

// Reglas léxicas

VAR: 'var';
CONST: 'const';
FUNC: 'func';
IF: 'if';
ELSE: 'else';
FOR: 'for';
SWITCH: 'switch';
CASE: 'case';
DEFAULT: 'default';
RETURN: 'return';
BREAK: 'break';
CONTINUE: 'continue';

ID: [a-zA-Z_][a-zA-Z0-9_]*;

INT: [0-9]+;
FLOAT: [0-9]+ '.' [0-9]+;
STRING: '"' ( '\\' . | ~[\\"\r\n] )* '"';
RUNE: '\'' ( '\\' . | ~[\\'] ) '\'';
BOOLEAN: 'true' | 'false';
NIL: 'nil';

COMMENT: '//' ~[\r\n]* -> skip;
BLOCK_COMMENT: '/*' .*? '*/' -> skip;

WS: [ \t\r\n]+ -> skip;