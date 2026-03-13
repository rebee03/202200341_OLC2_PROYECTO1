# Documentación Técnica — Golampi Interpreter
**Organización de Lenguajes y Compiladores 2**  
**Universidad San Carlos de Guatemala — Facultad de Ingeniería**  
**Curso: Organización de Lenguajes y Compiladores 2**
**Rebeca Ayline Torres Del Cid**
**Carnet: 202200341**

---

## Tabla de Contenidos

1. [Descripción General](#1-descripción-general)
2. [Gramática Formal de Golampi](#2-gramática-formal-de-golampi)
3. [Diagrama de Clases](#3-diagrama-de-clases)
4. [Diagrama de Flujo — Tabla de Símbolos](#4-diagrama-de-flujo--tabla-de-símbolos)
5. [Arquitectura del Sistema](#5-arquitectura-del-sistema)
6. [Descripción de Módulos](#6-descripción-de-módulos)

---

## 1. Descripción General

El **Golampi Interpreter** es un intérprete funcional para el lenguaje académico **Golampi**, inspirado en la sintaxis y semántica de Golang. Implementa las tres fases fundamentales del procesamiento de lenguajes:

- **Análisis léxico** — tokenización mediante ANTLRv4
- **Análisis sintáctico** — generación del AST mediante ANTLRv4
- **Análisis semántico** — recorrido del AST con el patrón Visitor en PHP

El sistema ejecuta programas escritos en Golampi a partir de la función `main`, soportando variables, constantes, arreglos, funciones con múltiples retornos, estructuras de control y funciones embebidas.

---

## 2. Gramática Formal de Golampi

La gramática está escrita en formato **ANTLR4** (Extended BNF). Los terminales aparecen en `MAYÚSCULAS` o entre comillas, los no terminales en `camelCase`.

### 2.1 Programa y Declaraciones

```antlr
program         : declaration* EOF ;

declaration     : varDecl
                | constDecl
                | functionDecl
                ;

varDecl         : VAR identifierList type ('=' expressionList)? ';'? ;

constDecl       : CONST ID type '=' expression ';'? ;

functionDecl    : FUNC ID '(' parameterList? ')' returnType? block ;

parameterList   : parameter (',' parameter)* ;

parameter       : ID type ;

returnType      : type
                | '(' type (',' type)* ')'
                ;
```

### 2.2 Tipos

```antlr
type            : basicType
                | '*' type
                | '[' expression ']' type
                | '[' expression ']' '[' expression ']' type
                ;

basicType       : INT32
                | FLOAT32
                | BOOL_TYPE
                | RUNE
                | STRING_TYPE
                ;
```

| Tipo | Descripción | Valor por defecto |
|------|-------------|-------------------|
| `int32` | Entero con signo de 32 bits | `0` |
| `float32` | Punto flotante IEEE-754 | `0.0` |
| `bool` | Valor lógico | `false` |
| `rune` | Carácter Unicode (alias int32) | `'\u0000'` |
| `string` | Cadena de texto Unicode | `""` |

### 2.3 Bloque y Sentencias

```antlr
block           : '{' statement* '}' ;

statement       : varDecl
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

simpleStmt      : shortVarDecl
                | assignment
                | incDecStmt
                | expressionStmt
                ;

shortVarDecl    : identifierList ':=' expressionList ;

assignment      : expressionList assignOp expressionList ;

assignOp        : '=' | '+=' | '-=' | '*=' | '/=' ;

incDecStmt      : expression ('++' | '--') ;

expressionStmt  : expression ;
```

### 2.4 Sentencias de Transferencia

```antlr
returnStmt      : RETURN expressionList? ;
breakStmt       : BREAK ;
continueStmt    : CONTINUE ;
```

### 2.5 Estructuras de Control

```antlr
ifStmt          : IF expression block
                | IF expression block ELSE block
                | IF expression block ELSE ifStmt
                ;

switchStmt      : SWITCH expression? '{' caseClause* defaultClause? '}' ;

caseClause      : CASE expressionList ':' statement* ;
defaultClause   : DEFAULT ':' statement* ;

forStmt         : FOR forClause block
                | FOR expression block
                | FOR block
                ;

forClause       : simpleStmt? ';' expression? ';' simpleStmt? ;
```

### 2.6 Expresiones

```antlr
expression      : unaryExpr
                | expression binaryOp expression
                ;

unaryExpr       : primaryExpr
                | unaryOp unaryExpr
                ;

binaryOp        : '||' | '&&' | relOp | addOp | mulOp ;

relOp           : '==' | '!=' | '<' | '<=' | '>' | '>=' ;
addOp           : '+' | '-' ;
mulOp           : '*' | '/' | '%' ;
unaryOp         : '+' | '-' | '!' | '*' | '&' ;

primaryExpr     : operand
                | primaryExpr '[' expression ']'
                | primaryExpr '[' expression ']' '[' expression ']'
                | primaryExpr '(' expressionList? ')'
                | basicType '(' expression ')'
                ;

operand         : literal
                | qualifiedIdent
                | '(' expression ')'
                ;

qualifiedIdent  : ID ('.' ID)* ;
```

### 2.7 Literales

```antlr
literal         : basicLiteral | arrayLiteral ;

basicLiteral    : INT_LIT | FLOAT_LIT | STRING_LIT
                | RUNE_LIT | BOOL_LIT | NIL
                ;

arrayLiteral    : '[' expression ']' type '{' arrayElements '}' ;

arrayElements   : arrayElement (',' arrayElement)* ','?
                |
                ;

arrayElement    : '{' arrayElements '}'
                | expression
                ;
```

### 2.8 Tokens Léxicos

```antlr
-- Palabras reservadas --
VAR      : 'var' ;        CONST    : 'const' ;
FUNC     : 'func' ;       IF       : 'if' ;
ELSE     : 'else' ;       FOR      : 'for' ;
SWITCH   : 'switch' ;     CASE     : 'case' ;
DEFAULT  : 'default' ;    RETURN   : 'return' ;
BREAK    : 'break' ;      CONTINUE : 'continue' ;
NIL      : 'nil' ;

-- Tipos --
INT32       : 'int32' ;   FLOAT32    : 'float32' ;
BOOL_TYPE   : 'bool' ;    RUNE       : 'rune' ;
STRING_TYPE : 'string' ;

-- Literales --
BOOL_LIT  : 'true' | 'false' ;
INT_LIT   : [0-9]+ ;
FLOAT_LIT : [0-9]+ '.' [0-9]+ ;
STRING_LIT: '"' ( '\\' . | ~[\\"\r\n] )* '"' ;
RUNE_LIT  : '\'' ( '\\' . | ~[\\'\r\n] ) '\'' ;
ID        : [a-zA-Z_][a-zA-Z0-9_]* ;

-- Ignorados --
LINE_COMMENT  : '//' ~[\r\n]* -> skip ;
BLOCK_COMMENT : '/*' .*? '*/' -> skip ;
WS            : [ \t\r\n]+ -> skip ;
```

### 2.9 Funciones Embebidas

| Función | Firma | Descripción |
|---------|-------|-------------|
| `fmt.Println` | `fmt.Println(args...)` | Imprime valores separados por espacio + `\n` |
| `len` | `len(s\|arr) int32` | Longitud de string o arreglo |
| `now` | `now() string` | Fecha y hora actual `YYYY-MM-DD HH:MM:SS` |
| `substr` | `substr(s, inicio, longitud) string` | Extrae subcadena |
| `typeOf` | `typeOf(v) string` | Tipo de una variable como string |

---

## 3. Diagrama de Clases

```
classDiagram

class index_php {
    Entry Point
}

class GrammarLexer {
    <<ANTLR4>>
}

class GrammarParser {
    <<ANTLR4>>
}

class ParseTree

class Interpreter {
    +visitProgram()
    +execBlock()
    +execStatement()
    +evalExpr()
    +evalPrimary()
    +evalCall()
    +callFunction()
}

class Environment {
    -values : array
    -parent : Environment
    +declare()
    +get()
    +assign()
    +getType()
    +exists()
    +existsLocal()
    +getAll()
}

class FlowTypes {
    +BreakSignal
    +ContinueSignal
    +ReturnSignal
    -value : mixed
}

class Natives {
    +fmtPrintln()
    +len()
    +now()
    +substr()
    +typeOf()
}

index_php --> GrammarLexer
index_php --> GrammarParser
GrammarParser --> ParseTree
ParseTree --> Interpreter

Interpreter --> Environment : uses
Interpreter --> FlowTypes : control
Interpreter --> Natives : builtins

Environment --> Environment : parent scope
```

### Relaciones entre clases

| Clase | Responsabilidad | Depende de |
|-------|----------------|------------|
| `Interpreter` | Recorre el AST y ejecuta el programa | `Environment`, `FlowTypes`, `Natives` |
| `Environment` | Almacena variables y maneja scopes anidados | — |
| `FlowTypes` | Señales de control de flujo (`break`, `continue`, `return`) | — |
| `Natives` | Implementa funciones embebidas del lenguaje | — |
| `GrammarLexer` | Tokeniza el código fuente (generado por ANTLR4) | ANTLR4 Runtime |
| `GrammarParser` | Genera el AST (generado por ANTLR4) | ANTLR4 Runtime |

---

## 4. Diagrama de Flujo — Tabla de Símbolos

El siguiente diagrama muestra cómo se construye y consulta la tabla de símbolos durante la ejecución:

```
flowchart TD

A["Inicio: visitProgram()"]

A --> B["FASE 1: Hoisting de funciones<br/>Registrar funciones en functions[]<br/>addSymbol(nombre,'función','global')"]

B --> C["FASE 2: Declaraciones globales<br/>Evaluar expresión<br/>Environment::declare()<br/>addSymbol()"]

C --> D{"¿Existe función main?"}

D -- No --> E["addError(): No existe main"]

D -- Sí --> F["callFunction('main', [])"]

F --> G["Crear Environment local<br/>parent = global"]

G --> H["Registrar parámetros<br/>local::declare()<br/>addSymbol()"]

H --> I["execBlock()"]

I --> J["Ejecución de sentencias"]

J --> K["varDecl local<br/>env::declare()<br/>addSymbol()"]

J --> L["shortVarDecl :=<br/>inferType()<br/>declare/assign<br/>addSymbol()"]

J --> M["assignment (=, +=, etc.)<br/>env::get()<br/>applyAssignOp()<br/>env::assign()"]

K --> N["Resolución de scopes"]
L --> N
M --> N

N --> O["Environment::get()<br/>Busca en scope actual<br/>Luego parent<br/>Si no existe → error"]

O --> P["Environment::assign()<br/>Actualiza en scope actual<br/>o en parent"]

P --> Q["Resultado final<br/>symbols[]<br/>errors[]<br/>output[]"]
```

### Estructura de un símbolo en la tabla

```
[
  'Identificador' => 'x',
  'Tipo'          => 'int32',
  'Ámbito'        => 'main',
  'Valor'         => '10',
  'Línea'         => 5,
  'Columna'       => 4,
]
```

### Reglas de ámbito (Scope)

| Situación | Ámbito registrado |
|-----------|------------------|
| Variable global (`var` fuera de función) | `'global'` |
| Función declarada | `'global'` |
| Parámetro de función | nombre de la función |
| Variable local dentro de función | nombre de la función |
| Variable en bloque anidado (`if`, `for`) | nombre de la función contenedora |

---

## 5. Arquitectura del Sistema

```
flowchart TD

A["Código fuente (.go)"]

A --> B["GrammarLexer<br/>ANTLRv4 PHP<br/>Análisis léxico<br/>Genera tokens"]

B --> C["GrammarParser<br/>ANTLRv4 PHP<br/>Análisis sintáctico<br/>Genera AST"]

C --> D["Interpreter<br/>Visitor PHP<br/>Análisis semántico<br/>Ejecución"]

D --> E["output[]<br/>Salida de consola"]
D --> F["errors[]<br/>Tabla de errores"]
D --> G["symbols[]<br/>Tabla de símbolos"]
```

---

## 6. Descripción de Módulos

### `Grammar.g4`
Define la gramática completa del lenguaje Golampi. Se compila con ANTLRv4 para generar el lexer y parser en PHP.

### `ANTLRv4/`
Archivos generados automáticamente por ANTLRv4:
- `GrammarLexer.php` — analizador léxico
- `GrammarParser.php` — analizador sintáctico  
- `GrammarVisitor.php` — interfaz del visitor
- `GrammarBaseVisitor.php` — implementación base del visitor

### `src/Environment.php`
Implementa la tabla de símbolos con scopes anidados mediante una lista enlazada de entornos (cada entorno apunta a su padre). Soporta `declare`, `get`, `assign`, `exists` y `existsLocal`.

### `src/FlowTypes.php`
Define tres clases señal para el control de flujo: `BreakSignal`, `ContinueSignal` y `ReturnSignal`. El intérprete propaga estas señales hacia arriba en la pila de llamadas.

### `src/Natives.php`
Implementa las funciones embebidas del lenguaje: `fmt.Println`, `len`, `now`, `substr` y `typeOf`.

### `src/Interpreter.php`
Clase principal que extiende `GrammarBaseVisitor`. Implementa el patrón Visitor para recorrer el AST y ejecutar el programa. Contiene los métodos `execBlock`, `execStatement`, `evalExpr`, `evalPrimary`, `evalCall` y todos los métodos de ejecución de sentencias.

### `index.php`
Punto de entrada web. Recibe el código fuente por POST, invoca el lexer/parser/intérprete y devuelve los resultados al frontend.

### `bootstrap.php`
Carga todos los archivos de clases necesarios para el proyecto.
