# Manual de Usuario — Golampi Interpreter
**Organización de Lenguajes y Compiladores 2**  
**Universidad San Carlos de Guatemala — Facultad de Ingeniería**
**Curso: Organización de Lenguajes y Compiladores 2**
**Rebeca Ayline Torres Del Cid**
**Carnet: 202200341**

---

## Tabla de Contenidos

1. [Requisitos del Sistema](#1-requisitos-del-sistema)
2. [Instalación](#2-instalación)
3. [Iniciar el Servidor](#3-iniciar-el-servidor)
4. [Interfaz Gráfica](#4-interfaz-gráfica)
5. [Crear y Editar Código](#5-crear-y-editar-código)
6. [Ejecutar un Programa](#6-ejecutar-un-programa)
7. [Interpretar la Consola de Salida](#7-interpretar-la-consola-de-salida)
8. [Reportes](#8-reportes)
9. [Ejemplos de Uso](#9-ejemplos-de-uso)
10. [Errores Frecuentes](#10-errores-frecuentes)

---

## 1. Requisitos del Sistema

| Herramienta | Versión mínima | Verificar con |
|-------------|----------------|---------------|
| PHP | 8.1 o superior | `php --version` |
| Composer | 2.x | `composer --version` |
| Java (para ANTLR) | 11 o superior | `java -version` |
| ANTLR4 Tools | 4.13 | `antlr4 --version` |
| Git | cualquier versión | `git --version` |

---

## 2. Instalación

### Paso 1 — Clonar o descargar el proyecto

```bash
git clone <url-del-repositorio>
cd Proyecto1_OCL2_202200341/Backend
```

### Paso 2 — Instalar dependencias PHP

```bash
composer install
```

Si es la primera vez y no existe `vendor/`:

```bash
composer require antlr/antlr4-php-runtime
```

### Paso 3 — Generar el Lexer y Parser con ANTLR4

Desde la carpeta `Backend/`:

```bash
antlr4 -Dlanguage=PHP Grammar.g4 -visitor -no-listener -o ANTLRv4/
```

Esto genera en `ANTLRv4/`:
- `GrammarLexer.php`
- `GrammarParser.php`
- `GrammarVisitor.php`
- `GrammarBaseVisitor.php`

### Paso 4 — Verificar la estructura del proyecto

Luego de la instalación, la estructura debe verse así:

```
Backend/
├── ANTLRv4/
│   ├── GrammarLexer.php
│   ├── GrammarParser.php
│   ├── GrammarVisitor.php
│   └── GrammarBaseVisitor.php
├── src/
│   ├── Environment.php
│   ├── FlowTypes.php
│   ├── Natives.php
│   └── Interpreter.php
├── static/
│   ├── style.css
│   └── script.js
├── vendor/
├── Grammar.g4
├── bootstrap.php
├── composer.json
└── index.php
```

---

## 3. Iniciar el Servidor

Desde la carpeta `Backend/`, ejecutar:

```bash
php -S 127.0.0.1:8000
```

Luego abrir el navegador en:

```
http://127.0.0.1:8000
```

Para ver errores detallados durante el desarrollo:

```bash
php -S 127.0.0.1:8000 -d display_errors=1 -d error_reporting=E_ALL
```

Para detener el servidor: presionar `Ctrl + C` en la terminal.

---

## 4. Interfaz Gráfica

La interfaz está dividida en cuatro secciones principales:

```
┌──────────────────────────────────────────────────────────────┐
│  🦙 Golampi Interpreter  [Nuevo] [Cargar] [Guardar] [▶ Ejecutar] [✕ Limpiar]  │
├──────────────────────────────────────┬───────────────────────┤
│                                      │   Consola de Salida   │
│         Editor de Código             │                       │
│                                      │   (resultados aquí)   │
│   1 │ func main() {                  ├───────────────────────┤
│   2 │   fmt.Println("Hola")          │       Reportes        │
│   3 │ }                              │                       │
│                                      │  [📄 Descargar result]│
│                                      │  [⚠️ Descargar errores]│
│                                      │  [📊 Tabla símbolos]  │
└──────────────────────────────────────┴───────────────────────┘
```

### Barra de acciones

| Botón | Acción |
|-------|--------|
| 📄 **Nuevo** | Limpia el editor y la consola para empezar desde cero |
| 📂 **Cargar archivo** | Abre un archivo `.go`, `.glp` o `.txt` desde tu computadora |
| 💾 **Guardar código** | Descarga el contenido del editor como archivo `programa.glp` |
| ▶ **Ejecutar** | Envía el código al intérprete y muestra el resultado |
| ✕ **Limpiar consola** | Borra el contenido de la consola sin borrar el editor |

---

## 5. Crear y Editar Código

### Editor de código

- Soporta texto multilínea con numeración de líneas automática
- La tecla `Tab` inserta 4 espacios
- El scroll de las líneas se sincroniza con el editor

### Cargar un archivo existente

1. Hacer clic en **📂 Cargar archivo**
2. Seleccionar un archivo `.go`, `.glp` o `.txt`
3. El contenido se carga automáticamente en el editor

### Guardar el código actual

1. Hacer clic en **💾 Guardar código**
2. Se descarga el archivo como `programa.glp`

### Ejemplo de programa válido

```go
func main() {
    x := 10
    y := 20
    fmt.Println("La suma es:", x + y)
}
```

---

## 6. Ejecutar un Programa

1. Escribir o cargar el código en el editor
2. Hacer clic en **▶ Ejecutar**
3. El resultado aparece en la **Consola de Salida**
4. Los reportes se habilitan en el panel derecho

### Reglas importantes del lenguaje

- Todo programa debe tener exactamente **una función `main`**
- La función `main` no recibe parámetros ni retorna valores
- Las variables deben declararse antes de usarse
- Los identificadores son **sensibles a mayúsculas** (`x` ≠ `X`)

---

## 7. Interpretar la Consola de Salida

La consola muestra la salida generada por `fmt.Println` durante la ejecución.

### Salida normal

```
Hola Mundo
La suma es: 30
true
```

### Salida con error semántico

Si hay errores, la consola puede mostrar salida parcial (hasta donde llegó la ejecución) y el panel de reportes mostrará la tabla de errores.

---

## 8. Reportes

Los reportes se habilitan después de ejecutar el código. Están disponibles tres descargas:

### 8.1 Descargar Resultado

Exporta como archivo de texto todo lo que aparece en la consola de salida.

### 8.2 Descargar Errores

Genera un archivo HTML con la tabla de errores. Cada error incluye:

| Campo | Descripción |
|-------|-------------|
| `#` | Número de error |
| `Tipo` | `Léxico`, `Sintáctico` o `Semántico` |
| `Descripción` | Mensaje explicativo del error |
| `Línea` | Línea del código donde ocurrió |
| `Columna` | Columna del código donde ocurrió |

**Ejemplo de tabla de errores:**

| # | Tipo | Descripción | Línea | Columna |
|---|------|-------------|-------|---------|
| 1 | Semántico | Variable 'x' no declarada en el ámbito actual | 5 | 4 |
| 2 | Semántico | Identificador 'y' ya ha sido declarado | 8 | 2 |
| 3 | Sintáctico | Se esperaba '}' y se encontró 'EOF' | 12 | 0 |

### 8.3 Descargar Tabla de Símbolos

Genera un archivo HTML con todos los identificadores declarados durante la ejecución:

| Campo | Descripción |
|-------|-------------|
| `Identificador` | Nombre de la variable, constante o función |
| `Tipo` | Tipo de dato (`int32`, `float32`, `bool`, `string`, `rune`, `array`, `función`) |
| `Ámbito` | Contexto donde fue declarado (`global`, nombre de función) |
| `Valor` | Valor en el momento de la declaración |
| `Línea` | Línea del código fuente |
| `Columna` | Columna del código fuente |

**Ejemplo de tabla de símbolos:**

| Identificador | Tipo | Ámbito | Valor | Línea | Columna |
|---------------|------|--------|-------|-------|---------|
| `suma` | función | global | — | 1 | 1 |
| `a` | int32 | suma | 3 | 1 | 10 |
| `b` | int32 | suma | 4 | 1 | 18 |
| `resultado` | int32 | main | 7 | 5 | 4 |

---

## 9. Ejemplos de Uso

### Ejemplo 1 — Hola Mundo

```go
func main() {
    fmt.Println("Hola, Golampi!")
}
```

**Salida esperada:**
```
Hola, Golampi!
```

### Ejemplo 2 — Variables y operadores

```go
func main() {
    var x int32 = 10
    var y int32 = 3
    fmt.Println("Suma:", x + y)
    fmt.Println("Módulo:", x % y)
    fmt.Println("Mayor:", x > y)
}
```

**Salida esperada:**
```
Suma: 13
Módulo: 1
Mayor: true
```

### Ejemplo 3 — Función con retorno múltiple

```go
func dividir(a int32, b int32) (int32, bool) {
    if b == 0 {
        return 0, false
    }
    return a / b, true
}

func main() {
    resultado, ok := dividir(10, 2)
    if ok {
        fmt.Println("Resultado:", resultado)
    }
}
```

**Salida esperada:**
```
Resultado: 5
```

### Ejemplo 4 — Arreglos

```go
func main() {
    var nums [3]int32
    nums[0] = 10
    nums[1] = 20
    nums[2] = 30
    fmt.Println(nums[0], nums[1], nums[2])
}
```

**Salida esperada:**
```
10 20 30
```

### Ejemplo 5 — For con break

```go
func main() {
    for i := 0; i < 10; i++ {
        if i == 5 {
            break
        }
        fmt.Println(i)
    }
}
```

**Salida esperada:**
```
0
1
2
3
4
```

---

## 10. Errores Frecuentes

### La página no carga

**Causa:** El servidor no está corriendo o se inició desde la carpeta incorrecta.

**Solución:**
```bash
cd Backend/
php -S 127.0.0.1:8000
```

### Error: `No se encontró la función main`

**Causa:** El programa no tiene función `main` o está mal escrita.

**Solución:** Asegurarse de que el programa incluya exactamente:
```go
func main() {
    // código aquí
}
```

### Error sintáctico al ejecutar

**Causa:** El código tiene errores de sintaxis (llaves faltantes, punto y coma incorrecto, etc.).

**Solución:** Revisar la tabla de errores descargable — indica la línea y columna exacta del error.

### La consola aparece vacía

**Causa:** El programa no llama a `fmt.Println`, o hay un error semántico antes de cualquier impresión.

**Solución:** Revisar el reporte de errores para identificar el problema.

### Error: `Variable 'x' no declarada`

**Causa:** Se usa una variable sin haberla declarado previamente, o se usa fuera de su ámbito.

**Solución:** Declarar la variable antes de usarla:
```go
var x int32 = 10   // declaración explícita
// o
x := 10            // declaración corta (solo dentro de funciones)
```

### Error: `Identificador 'x' ya ha sido declarado`

**Causa:** Se intenta declarar una variable con un nombre que ya existe en el mismo ámbito.

**Solución:** Usar un nombre diferente, o usar `:=` solo cuando al menos una variable del lado izquierdo es nueva.

---

*Manual generado para el proyecto Golampi Interpreter — OLC2, 1S2026*
