// static/script.js

const editor      = document.getElementById('editor');
const lineNumbers = document.getElementById('lineNumbers');

function updateLineNumbers() {
    if (!editor || !lineNumbers) return;
    const lines = editor.value.split('\n').length;
    lineNumbers.textContent = Array.from({length: lines}, (_, i) => i + 1).join('\n');
}

if (editor) {
    // Sincronizar scroll
    editor.addEventListener('scroll', () => {
        lineNumbers.scrollTop = editor.scrollTop;
    });

    // Actualizar números al escribir
    editor.addEventListener('input', updateLineNumbers);

    // Tab → 4 espacios
    editor.addEventListener('keydown', e => {
        if (e.key === 'Tab') {
            e.preventDefault();
            const start = editor.selectionStart;
            const end   = editor.selectionEnd;
            editor.value = editor.value.substring(0, start) + '    '
                         + editor.value.substring(end);
            editor.selectionStart = editor.selectionEnd = start + 4;
            updateLineNumbers();
        }
    });

    // Inicializar al cargar
    updateLineNumbers();
}