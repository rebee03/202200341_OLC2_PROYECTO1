<?php
// index.php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\BailErrorStrategy;
use Antlr\Antlr4\Runtime\Error\Exceptions\ParseCancellationException;
use Antlr\Antlr4\Runtime\Error\Exceptions\InputMismatchException;

// ── Estado inicial ───────────────────────────────────────────────
$input       = '';
$consoleOut  = '';        // texto para la consola de salida
$errors      = [];        // tabla de errores
$symbols     = [];        // tabla de símbolos
$hasRun      = false;

// ── Procesamiento POST ───────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'run';
    $input  = $_POST['code']   ?? '';

    if ($action === 'run' && !empty($input)) {
        $hasRun = true;
        try {
            // Lexer + Parser
            $inputStream = InputStream::fromString($input);
            $lexer       = new GrammarLexer($inputStream);
            $tokens      = new CommonTokenStream($lexer);
            $parser      = new GrammarParser($tokens);
            $parser->setErrorHandler(new BailErrorStrategy());

            // Regla inicial de tu gramática
            $tree = $parser->program();

            // Intérprete
            $interpreter = new Interpreter();
            $interpreter->visit($tree);

            // Recoger resultados
            $consoleOut = implode("\n", $interpreter->output);
            $errors     = $interpreter->errors;
            $symbols    = $interpreter->symbols;

        } catch (ParseCancellationException $e) {
            $cause = $e->getPrevious();
            if ($cause instanceof InputMismatchException) {
                $tok      = $cause->getOffendingToken();
                $found    = $tok ? $tok->getText() : 'EOF';
                $parserObj = $cause->getRecognizer();
                $vocab    = $parserObj->getVocabulary();
                $expected = [];
                foreach ($cause->getExpectedTokens()->toArray() as $t) {
                    $expected[] = $vocab->getDisplayName($t);
                }
                $errors[] = [
                    '#'           => 1,
                    'Tipo'        => 'Sintáctico',
                    'Descripción' => sprintf(
                        "Se esperaba %s y se encontró '%s'",
                        implode(' o ', $expected),
                        $found
                    ),
                    'Línea'   => $tok ? $tok->getLine() : 0,
                    'Columna' => $tok ? $tok->getCharPositionInLine() : 0,
                ];
                $consoleOut = "Error sintáctico — revisa el reporte de errores.";
            } else {
                $consoleOut = "Error de parseo: " . $e->getMessage();
            }
        } catch (Exception $e) {
            $consoleOut = "Error: " . $e->getMessage();
        }
    }

    // ── Descargas ────────────────────────────────────────────────
    if ($action === 'download_output') {
        $text = $_POST['console_content'] ?? '';
        header('Content-Type: text/plain; charset=utf-8');
        header('Content-Disposition: attachment; filename="resultado.txt"');
        echo $text;
        exit;
    }

    if ($action === 'download_errors') {
        $data = json_decode($_POST['errors_json'] ?? '[]', true);
        header('Content-Type: text/html; charset=utf-8');
        header('Content-Disposition: attachment; filename="errores.html"');
        echo buildTableHtml('Reporte de Errores', $data);
        exit;
    }

    if ($action === 'download_symbols') {
        $data = json_decode($_POST['symbols_json'] ?? '[]', true);
        header('Content-Type: text/html; charset=utf-8');
        header('Content-Disposition: attachment; filename="tabla_simbolos.html"');
        echo buildTableHtml('Tabla de Símbolos', $data);
        exit;
    }
}

// ── Helper para generar HTML de tabla descargable ────────────────
function buildTableHtml(string $title, array $rows): string {
    if (empty($rows)) {
        return "<html><body><h2>$title</h2><p>Sin datos.</p></body></html>";
    }
    $headers = array_keys($rows[0]);
    $th = implode('', array_map(fn($h) => "<th>$h</th>", $headers));
    $tbody = '';
    foreach ($rows as $row) {
        $td = implode('', array_map(
            fn($v) => '<td>' . htmlspecialchars((string)$v) . '</td>',
            array_values($row)
        ));
        $tbody .= "<tr>$td</tr>";
    }
    return <<<HTML
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8">
<title>$title</title>
<style>
  body { font-family: sans-serif; padding: 20px; }
  table { border-collapse: collapse; width: 100%; }
  th { background: #1e3a5f; color: white; padding: 8px 12px; }
  td { border: 1px solid #ccc; padding: 6px 12px; }
  tr:nth-child(even) { background: #f5f5f5; }
</style></head><body>
<h2>$title</h2>
<table><thead><tr>$th</tr></thead><tbody>$tbody</tbody></table>
</body></html>
HTML;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golampi Interpreter — OLC2</title>
    <link rel="stylesheet" href="/static/style.css">
</head>
<body>

<!-- ══════════════════════════════════════════════
     BARRA DE ACCIONES
══════════════════════════════════════════════ -->
<header class="toolbar">
    <span class="toolbar-title">🦙 Golampi Interpreter</span>
    <div class="toolbar-actions">
        <button type="button" onclick="newFile()"       class="btn btn-secondary">📄 Nuevo</button>
        <button type="button" onclick="loadFile()"      class="btn btn-secondary">📂 Cargar archivo</button>
        <input  type="file"   id="fileInput" accept=".go,.glp,.txt" style="display:none"
                onchange="handleFileLoad(event)">
        <button type="button" onclick="saveFile()"      class="btn btn-secondary">💾 Guardar código</button>
        <button type="button" onclick="submitRun()"     class="btn btn-primary">▶ Ejecutar</button>
        <button type="button" onclick="clearConsole()"  class="btn btn-danger">✕ Limpiar consola</button>
    </div>
</header>

<!-- ══════════════════════════════════════════════
     CUERPO PRINCIPAL
══════════════════════════════════════════════ -->
<main class="workspace">

    <!-- Editor de código -->
    <section class="editor-panel">
        <div class="panel-header">Editor de Código</div>
        <div class="editor-wrapper">
            <div class="line-numbers" id="lineNumbers">1</div>
            <textarea id="editor" name="code" spellcheck="false"
                placeholder="// Escribe tu código Golampi aquí..."
            ><?php echo htmlspecialchars($input); ?></textarea>
        </div>
    </section>

    <!-- Panel derecho: consola + reportes -->
    <aside class="right-panel">

        <!-- Consola de salida -->
        <section class="console-panel">
            <div class="panel-header">Consola de Salida</div>
            <pre class="console" id="consoleOutput"><?php
                echo htmlspecialchars($consoleOut);
            ?></pre>
        </section>

        <!-- Panel de reportes -->
        <section class="reports-panel">
            <div class="panel-header">Reportes</div>
            <div class="report-buttons">

                <!-- Descargar resultado -->
                <form method="post">
                    <input type="hidden" name="action" value="download_output">
                    <input type="hidden" name="console_content"
                           id="downloadOutputContent"
                           value="<?php echo htmlspecialchars($consoleOut); ?>">
                    <button type="submit" class="btn btn-report"
                        <?php echo !$hasRun ? 'disabled' : ''; ?>>
                        📄 Descargar resultado
                    </button>
                </form>

                <!-- Descargar errores -->
                <form method="post">
                    <input type="hidden" name="action" value="download_errors">
                    <input type="hidden" name="errors_json"
                           value="<?php echo htmlspecialchars(json_encode($errors)); ?>">
                    <button type="submit" class="btn btn-report"
                        <?php echo !$hasRun ? 'disabled' : ''; ?>>
                        ⚠️ Descargar errores
                    </button>
                </form>

                <!-- Descargar tabla de símbolos -->
                <form method="post">
                    <input type="hidden" name="action" value="download_symbols">
                    <input type="hidden" name="symbols_json"
                           value="<?php echo htmlspecialchars(json_encode($symbols)); ?>">
                    <button type="submit" class="btn btn-report"
                        <?php echo !$hasRun ? 'disabled' : ''; ?>>
                        📊 Descargar tabla de símbolos
                    </button>
                </form>
            </div>

            <!-- Vista previa de errores en pantalla -->
            <?php if ($hasRun && !empty($errors)): ?>
            <div class="error-preview">
                <p class="error-count">⚠️ <?php echo count($errors); ?> error(es) encontrado(s)</p>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>#</th><th>Tipo</th><th>Descripción</th>
                            <th>Línea</th><th>Columna</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($errors as $err): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string)$err['#']); ?></td>
                            <td><?php echo htmlspecialchars($err['Tipo']); ?></td>
                            <td><?php echo htmlspecialchars($err['Descripción']); ?></td>
                            <td><?php echo htmlspecialchars((string)$err['Línea']); ?></td>
                            <td><?php echo htmlspecialchars((string)$err['Columna']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

        </section>
    </aside>
</main>

<!-- Formulario oculto para envío del código -->
<form id="runForm" method="post" style="display:none">
    <input type="hidden" name="action" value="run">
    <textarea name="code" id="runCode"></textarea>
</form>

<script src="/static/script.js"></script>
<script>
// ── Funciones de la barra de acciones ──────────────────────────
function newFile() {
    if (confirm('¿Limpiar el editor y la consola?')) {
        document.getElementById('editor').value = '';
        document.getElementById('consoleOutput').textContent = '';
        updateLineNumbers();
    }
}

function loadFile() {
    document.getElementById('fileInput').click();
}

function handleFileLoad(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('editor').value = e.target.result;
        updateLineNumbers();
    };
    reader.readAsText(file);
}

function saveFile() {
    const code = document.getElementById('editor').value;
    const blob = new Blob([code], { type: 'text/plain' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'programa.glp';
    a.click();
}

function submitRun() {
    const code = document.getElementById('editor').value;
    document.getElementById('runCode').value = code;
    document.getElementById('runForm').submit();
}

function clearConsole() {
    document.getElementById('consoleOutput').textContent = '';
}
</script>
</body>
</html>