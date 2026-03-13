# Documentación Técnica — Golampi Interpreter
**Organización de Lenguajes y Compiladores 2**  
**Universidad San Carlos de Guatemala — Facultad de Ingeniería**  
**Curso: Organización de Lenguajes y Compiladores 2**

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
┌─────────────────────────────────────────────────────────────────┐
│                        index.php                                 │
│  ┌──────────────┐   ┌──────────────┐   ┌──────────────────────┐ │
│  │ GrammarLexer │──▶│ GrammarParser│──▶│  Interpreter         │ │
│  │  (ANTLR4)    │   │  (ANTLR4)    │   │  + visitProgram()    │ │
│  └──────────────┘   └──────────────┘   │  + execBlock()       │ │
│                            │            │  + execStatement()   │ │
│                            │ AST        │  + evalExpr()        │ │
│                            ▼            │  + evalPrimary()     │ │
│                     ┌────────────┐      │  + evalCall()        │ │
│                     │ ParseTree  │      │  + callFunction()    │ │
│                     └────────────┘      └──────────┬───────────┘ │
└─────────────────────────────────────────────────────┼───────────┘
                                                       │ usa
              ┌────────────────────────────────────────┼──────────┐
              │                                        │          │
              ▼                                        ▼          ▼
┌─────────────────────┐              ┌──────────────────┐  ┌────────────┐
│    Environment      │              │   FlowTypes      │  │  Natives   │
│─────────────────────│              │──────────────────│  │────────────│
│ - values: array     │              │ + BreakSignal    │  │ + fmtPrintln│
│ - parent: ?self     │              │ + ContinueSignal │  │ + len()    │
│─────────────────────│              │ + ReturnSignal   │  │ + now()    │
│ + declare()         │              │   - value: mixed │  │ + substr() │
│ + get()             │              └──────────────────┘  │ + typeOf() │
│ + assign()          │                                     └────────────┘
│ + getType()         │
│ + exists()          │
│ + existsLocal()     │
│ + getAll()          │
└─────────────────────┘
         ▲
         │ parent →
┌─────────────────────┐
│  Environment (local)│  ← scope de función/bloque
│  parent = global    │
└─────────────────────┘
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
┌─────────────────────────────────────────────────────────────────┐
│                    INICIO: visitProgram()                        │
└──────────────────────────────┬──────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────┐
│              FASE 1: HOISTING DE FUNCIONES                       │
│  Para cada functionDecl en el programa:                          │
│    → Registrar nombre en $this->functions[]                      │
│    → addSymbol(nombre, 'función', 'global', '—', línea, col)     │
└──────────────────────────────┬──────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────┐
│           FASE 2: DECLARACIONES GLOBALES                         │
│  Para cada varDecl / constDecl global:                           │
│    → Evaluar expresión de inicialización                         │
│    → Environment::declare(nombre, valor, tipo)                   │
│    → addSymbol(nombre, tipo, 'global', valor, línea, col)        │
└──────────────────────────────┬──────────────────────────────────┘
                               │
                               ▼
               ┌───────────────────────────────┐
               │   ¿Existe función 'main'?      │
               └───────────┬───────────────────┘
                    NO ▼   │ SÍ
          ┌────────────┐   │
          │addError()  │   ▼
          │"No existe  │  callFunction('main', [])
          │ main"      │        │
          └────────────┘        │
                                ▼
┌─────────────────────────────────────────────────────────────────┐
│                EJECUCIÓN DE FUNCIÓN                              │
│  1. Crear Environment local (parent = global)                    │
│  2. Para cada parámetro:                                         │
│     → local::declare(nombre, valor_arg, tipo)                    │
│     → addSymbol(nombre, tipo, nombre_función, valor, l, c)       │
│  3. execBlock(block, local, nombre_función)                      │
└──────────────────────────────┬──────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────┐
│                 EJECUCIÓN DE SENTENCIAS                          │
│                                                                  │
│  varDecl local:                                                  │
│    → env::declare(nombre, valor, tipo)                           │
│    → addSymbol(nombre, tipo, scope, valor, l, c)                 │
│                                                                  │
│  shortVarDecl (:=):                                              │
│    → inferType() desde el nodo de expresión                      │
│    → env::declare() o env::assign()                              │
│    → addSymbol(nombre, tipo_inferido, scope, valor, l, c)        │
│                                                                  │
│  assignment (=, +=, etc.):                                       │
│    → env::get() para obtener valor actual                        │
│    → applyAssignOp()                                             │
│    → env::assign() — NO agrega a tabla de símbolos              │
└──────────────────────────────┬──────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────┐
│               RESOLUCIÓN DE SCOPES                               │
│                                                                  │
│  Environment::get(nombre):                                       │
│    → ¿Existe en scope actual?  → retornar valor                  │
│    → ¿Tiene parent?            → buscar en parent               │
│    → No encontrado             → RuntimeException               │
│                                                                  │
│  Environment::assign(nombre):                                    │
│    → ¿Existe en scope actual?  → actualizar aquí                 │
│    → ¿Tiene parent?            → actualizar en parent           │
│    → No encontrado             → RuntimeException               │
└──────────────────────────────┬──────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────┐
│                    RESULTADO FINAL                                │
│                                                                  │
│  $interpreter->symbols[]  → Tabla de símbolos completa          │
│  $interpreter->errors[]   → Tabla de errores                    │
│  $interpreter->output[]   → Salida de consola                   │
└─────────────────────────────────────────────────────────────────┘
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
Código fuente (.go)
       │
       ▼
┌─────────────────┐
│  GrammarLexer   │  Análisis léxico — genera tokens
│  (ANTLRv4/PHP)  │  Detecta errores léxicos
└────────┬────────┘
         │ TokenStream
         ▼
┌─────────────────┐
│  GrammarParser  │  Análisis sintáctico — genera AST
│  (ANTLRv4/PHP)  │  Detecta errores sintácticos
└────────┬────────┘
         │ ParseTree (AST)
         ▼
┌─────────────────┐
│  Interpreter    │  Análisis semántico + Ejecución
│  (Visitor PHP)  │  Valida tipos, scopes, operaciones
│                 │  Ejecuta sentencias y expresiones
└────────┬────────┘
         │
    ┌────┴────┐
    ▼         ▼
 output[]   errors[]   symbols[]
 (consola)  (errores)  (tabla de símbolos)
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
