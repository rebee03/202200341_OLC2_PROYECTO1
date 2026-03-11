#!/bin/sh

cd "$(dirname "$0")"

antlr4 -Dlanguage=PHP Grammar.g4 -visitor