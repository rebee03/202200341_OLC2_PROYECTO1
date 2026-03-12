<?php
// bootstrap.php

// ── Clases generadas por ANTLR ──────────────────────────────────
// (Se generan con: antlr4 -Dlanguage=PHP Grammar.g4 -visitor -o ANTLRv4/)
require_once __DIR__ . '/ANTLRv4/GrammarLexer.php';
require_once __DIR__ . '/ANTLRv4/GrammarParser.php';
require_once __DIR__ . '/ANTLRv4/GrammarVisitor.php';
require_once __DIR__ . '/ANTLRv4/GrammarBaseVisitor.php';

// ── Clases del intérprete ────────────────────────────────────────
require_once __DIR__ . '/src/Environment.php';
require_once __DIR__ . '/src/FlowTypes.php';
require_once __DIR__ . '/src/Natives.php';
require_once __DIR__ . '/src/Interpreter.php';