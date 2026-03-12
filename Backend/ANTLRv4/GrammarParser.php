<?php

/*
 * Generated from Grammar.g4 by ANTLR 4.13.2
 */

namespace {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class GrammarParser extends Parser
	{
		public const T__0 = 1, T__1 = 2, T__2 = 3, T__3 = 4, T__4 = 5, T__5 = 6, 
               T__6 = 7, T__7 = 8, T__8 = 9, T__9 = 10, T__10 = 11, T__11 = 12, 
               T__12 = 13, T__13 = 14, T__14 = 15, T__15 = 16, T__16 = 17, 
               T__17 = 18, T__18 = 19, T__19 = 20, T__20 = 21, T__21 = 22, 
               T__22 = 23, T__23 = 24, T__24 = 25, T__25 = 26, T__26 = 27, 
               T__27 = 28, T__28 = 29, T__29 = 30, T__30 = 31, T__31 = 32, 
               T__32 = 33, VAR = 34, CONST = 35, FUNC = 36, IF = 37, ELSE = 38, 
               FOR = 39, SWITCH = 40, CASE = 41, DEFAULT = 42, RETURN = 43, 
               BREAK = 44, CONTINUE = 45, NIL = 46, INT32 = 47, FLOAT32 = 48, 
               BOOL_TYPE = 49, RUNE = 50, STRING_TYPE = 51, BOOL_LIT = 52, 
               INT_LIT = 53, FLOAT_LIT = 54, STRING_LIT = 55, RUNE_LIT = 56, 
               ID = 57, LINE_COMMENT = 58, BLOCK_COMMENT = 59, WS = 60;

		public const RULE_program = 0, RULE_declaration = 1, RULE_varDecl = 2, 
               RULE_constDecl = 3, RULE_functionDecl = 4, RULE_parameterList = 5, 
               RULE_parameter = 6, RULE_returnType = 7, RULE_type = 8, RULE_basicType = 9, 
               RULE_block = 10, RULE_statement = 11, RULE_simpleStmt = 12, 
               RULE_shortVarDecl = 13, RULE_assignment = 14, RULE_assignOp = 15, 
               RULE_incDecStmt = 16, RULE_expressionStmt = 17, RULE_returnStmt = 18, 
               RULE_breakStmt = 19, RULE_continueStmt = 20, RULE_ifStmt = 21, 
               RULE_switchStmt = 22, RULE_caseClause = 23, RULE_defaultClause = 24, 
               RULE_forStmt = 25, RULE_forClause = 26, RULE_expression = 27, 
               RULE_unaryExpr = 28, RULE_binaryOp = 29, RULE_relOp = 30, 
               RULE_addOp = 31, RULE_mulOp = 32, RULE_unaryOp = 33, RULE_primaryExpr = 34, 
               RULE_operand = 35, RULE_qualifiedIdent = 36, RULE_literal = 37, 
               RULE_basicLiteral = 38, RULE_arrayLiteral = 39, RULE_arrayElements = 40, 
               RULE_arrayElement = 41, RULE_identifierList = 42, RULE_expressionList = 43;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'program', 'declaration', 'varDecl', 'constDecl', 'functionDecl', 'parameterList', 
			'parameter', 'returnType', 'type', 'basicType', 'block', 'statement', 
			'simpleStmt', 'shortVarDecl', 'assignment', 'assignOp', 'incDecStmt', 
			'expressionStmt', 'returnStmt', 'breakStmt', 'continueStmt', 'ifStmt', 
			'switchStmt', 'caseClause', 'defaultClause', 'forStmt', 'forClause', 
			'expression', 'unaryExpr', 'binaryOp', 'relOp', 'addOp', 'mulOp', 'unaryOp', 
			'primaryExpr', 'operand', 'qualifiedIdent', 'literal', 'basicLiteral', 
			'arrayLiteral', 'arrayElements', 'arrayElement', 'identifierList', 'expressionList'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'='", "';'", "'('", "')'", "','", "'*'", "'['", "']'", "'{'", 
		    "'}'", "':='", "'+='", "'-='", "'*='", "'/='", "'++'", "'--'", "':'", 
		    "'||'", "'&&'", "'=='", "'!='", "'<'", "'<='", "'>'", "'>='", "'+'", 
		    "'-'", "'/'", "'%'", "'!'", "'&'", "'.'", "'var'", "'const'", "'func'", 
		    "'if'", "'else'", "'for'", "'switch'", "'case'", "'default'", "'return'", 
		    "'break'", "'continue'", "'nil'", "'int32'", "'float32'", "'bool'", 
		    "'rune'", "'string'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, "VAR", "CONST", "FUNC", "IF", "ELSE", "FOR", "SWITCH", "CASE", 
		    "DEFAULT", "RETURN", "BREAK", "CONTINUE", "NIL", "INT32", "FLOAT32", 
		    "BOOL_TYPE", "RUNE", "STRING_TYPE", "BOOL_LIT", "INT_LIT", "FLOAT_LIT", 
		    "STRING_LIT", "RUNE_LIT", "ID", "LINE_COMMENT", "BLOCK_COMMENT", "WS"
		];

		private const SERIALIZED_ATN =
			[4, 1, 60, 446, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 2, 31, 7, 31, 2, 32, 7, 32, 2, 33, 7, 
		    33, 2, 34, 7, 34, 2, 35, 7, 35, 2, 36, 7, 36, 2, 37, 7, 37, 2, 38, 
		    7, 38, 2, 39, 7, 39, 2, 40, 7, 40, 2, 41, 7, 41, 2, 42, 7, 42, 2, 
		    43, 7, 43, 1, 0, 5, 0, 90, 8, 0, 10, 0, 12, 0, 93, 9, 0, 1, 0, 1, 
		    0, 1, 1, 1, 1, 1, 1, 3, 1, 100, 8, 1, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 
		    3, 2, 107, 8, 2, 1, 2, 3, 2, 110, 8, 2, 1, 3, 1, 3, 1, 3, 1, 3, 1, 
		    3, 1, 3, 3, 3, 118, 8, 3, 1, 4, 1, 4, 1, 4, 1, 4, 3, 4, 124, 8, 4, 
		    1, 4, 1, 4, 3, 4, 128, 8, 4, 1, 4, 1, 4, 1, 5, 1, 5, 1, 5, 5, 5, 135, 
		    8, 5, 10, 5, 12, 5, 138, 9, 5, 1, 6, 1, 6, 1, 6, 1, 7, 1, 7, 1, 7, 
		    1, 7, 1, 7, 5, 7, 148, 8, 7, 10, 7, 12, 7, 151, 9, 7, 1, 7, 1, 7, 
		    3, 7, 155, 8, 7, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 
		    8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 3, 8, 173, 8, 8, 1, 9, 
		    1, 9, 1, 10, 1, 10, 5, 10, 179, 8, 10, 10, 10, 12, 10, 182, 9, 10, 
		    1, 10, 1, 10, 1, 11, 1, 11, 1, 11, 1, 11, 3, 11, 190, 8, 11, 1, 11, 
		    1, 11, 3, 11, 194, 8, 11, 1, 11, 1, 11, 3, 11, 198, 8, 11, 1, 11, 
		    1, 11, 3, 11, 202, 8, 11, 1, 11, 1, 11, 1, 11, 1, 11, 3, 11, 208, 
		    8, 11, 1, 12, 1, 12, 1, 12, 1, 12, 3, 12, 214, 8, 12, 1, 13, 1, 13, 
		    1, 13, 1, 13, 1, 14, 1, 14, 1, 14, 1, 14, 1, 15, 1, 15, 1, 16, 1, 
		    16, 1, 16, 1, 17, 1, 17, 1, 18, 1, 18, 3, 18, 233, 8, 18, 1, 19, 1, 
		    19, 1, 20, 1, 20, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 
		    1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 3, 
		    21, 255, 8, 21, 1, 22, 1, 22, 3, 22, 259, 8, 22, 1, 22, 1, 22, 5, 
		    22, 263, 8, 22, 10, 22, 12, 22, 266, 9, 22, 1, 22, 3, 22, 269, 8, 
		    22, 1, 22, 1, 22, 1, 23, 1, 23, 1, 23, 1, 23, 5, 23, 277, 8, 23, 10, 
		    23, 12, 23, 280, 9, 23, 1, 24, 1, 24, 1, 24, 5, 24, 285, 8, 24, 10, 
		    24, 12, 24, 288, 9, 24, 1, 25, 1, 25, 1, 25, 1, 25, 1, 25, 1, 25, 
		    1, 25, 1, 25, 1, 25, 1, 25, 3, 25, 300, 8, 25, 1, 26, 3, 26, 303, 
		    8, 26, 1, 26, 1, 26, 3, 26, 307, 8, 26, 1, 26, 1, 26, 3, 26, 311, 
		    8, 26, 1, 27, 1, 27, 1, 27, 1, 27, 1, 27, 1, 27, 1, 27, 5, 27, 320, 
		    8, 27, 10, 27, 12, 27, 323, 9, 27, 1, 28, 1, 28, 1, 28, 1, 28, 3, 
		    28, 329, 8, 28, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 3, 29, 336, 8, 
		    29, 1, 30, 1, 30, 1, 31, 1, 31, 1, 32, 1, 32, 1, 33, 1, 33, 1, 34, 
		    1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 3, 34, 353, 8, 34, 1, 34, 
		    1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 
		    34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 3, 34, 371, 8, 34, 1, 34, 5, 
		    34, 374, 8, 34, 10, 34, 12, 34, 377, 9, 34, 1, 35, 1, 35, 1, 35, 1, 
		    35, 1, 35, 1, 35, 3, 35, 385, 8, 35, 1, 36, 1, 36, 1, 36, 5, 36, 390, 
		    8, 36, 10, 36, 12, 36, 393, 9, 36, 1, 37, 1, 37, 3, 37, 397, 8, 37, 
		    1, 38, 1, 38, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 39, 1, 
		    39, 1, 40, 1, 40, 1, 40, 5, 40, 412, 8, 40, 10, 40, 12, 40, 415, 9, 
		    40, 1, 40, 3, 40, 418, 8, 40, 1, 40, 3, 40, 421, 8, 40, 1, 41, 1, 
		    41, 1, 41, 1, 41, 1, 41, 3, 41, 428, 8, 41, 1, 42, 1, 42, 1, 42, 5, 
		    42, 433, 8, 42, 10, 42, 12, 42, 436, 9, 42, 1, 43, 1, 43, 1, 43, 5, 
		    43, 441, 8, 43, 10, 43, 12, 43, 444, 9, 43, 1, 43, 0, 2, 54, 68, 44, 
		    0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 
		    36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 64, 66, 68, 
		    70, 72, 74, 76, 78, 80, 82, 84, 86, 0, 8, 1, 0, 47, 51, 2, 0, 1, 1, 
		    12, 15, 1, 0, 16, 17, 1, 0, 21, 26, 1, 0, 27, 28, 2, 0, 6, 6, 29, 
		    30, 3, 0, 6, 6, 27, 28, 31, 32, 2, 0, 46, 46, 52, 56, 466, 0, 91, 
		    1, 0, 0, 0, 2, 99, 1, 0, 0, 0, 4, 101, 1, 0, 0, 0, 6, 111, 1, 0, 0, 
		    0, 8, 119, 1, 0, 0, 0, 10, 131, 1, 0, 0, 0, 12, 139, 1, 0, 0, 0, 14, 
		    154, 1, 0, 0, 0, 16, 172, 1, 0, 0, 0, 18, 174, 1, 0, 0, 0, 20, 176, 
		    1, 0, 0, 0, 22, 207, 1, 0, 0, 0, 24, 213, 1, 0, 0, 0, 26, 215, 1, 
		    0, 0, 0, 28, 219, 1, 0, 0, 0, 30, 223, 1, 0, 0, 0, 32, 225, 1, 0, 
		    0, 0, 34, 228, 1, 0, 0, 0, 36, 230, 1, 0, 0, 0, 38, 234, 1, 0, 0, 
		    0, 40, 236, 1, 0, 0, 0, 42, 254, 1, 0, 0, 0, 44, 256, 1, 0, 0, 0, 
		    46, 272, 1, 0, 0, 0, 48, 281, 1, 0, 0, 0, 50, 299, 1, 0, 0, 0, 52, 
		    302, 1, 0, 0, 0, 54, 312, 1, 0, 0, 0, 56, 328, 1, 0, 0, 0, 58, 335, 
		    1, 0, 0, 0, 60, 337, 1, 0, 0, 0, 62, 339, 1, 0, 0, 0, 64, 341, 1, 
		    0, 0, 0, 66, 343, 1, 0, 0, 0, 68, 352, 1, 0, 0, 0, 70, 384, 1, 0, 
		    0, 0, 72, 386, 1, 0, 0, 0, 74, 396, 1, 0, 0, 0, 76, 398, 1, 0, 0, 
		    0, 78, 400, 1, 0, 0, 0, 80, 420, 1, 0, 0, 0, 82, 427, 1, 0, 0, 0, 
		    84, 429, 1, 0, 0, 0, 86, 437, 1, 0, 0, 0, 88, 90, 3, 2, 1, 0, 89, 
		    88, 1, 0, 0, 0, 90, 93, 1, 0, 0, 0, 91, 89, 1, 0, 0, 0, 91, 92, 1, 
		    0, 0, 0, 92, 94, 1, 0, 0, 0, 93, 91, 1, 0, 0, 0, 94, 95, 5, 0, 0, 
		    1, 95, 1, 1, 0, 0, 0, 96, 100, 3, 4, 2, 0, 97, 100, 3, 6, 3, 0, 98, 
		    100, 3, 8, 4, 0, 99, 96, 1, 0, 0, 0, 99, 97, 1, 0, 0, 0, 99, 98, 1, 
		    0, 0, 0, 100, 3, 1, 0, 0, 0, 101, 102, 5, 34, 0, 0, 102, 103, 3, 84, 
		    42, 0, 103, 106, 3, 16, 8, 0, 104, 105, 5, 1, 0, 0, 105, 107, 3, 86, 
		    43, 0, 106, 104, 1, 0, 0, 0, 106, 107, 1, 0, 0, 0, 107, 109, 1, 0, 
		    0, 0, 108, 110, 5, 2, 0, 0, 109, 108, 1, 0, 0, 0, 109, 110, 1, 0, 
		    0, 0, 110, 5, 1, 0, 0, 0, 111, 112, 5, 35, 0, 0, 112, 113, 5, 57, 
		    0, 0, 113, 114, 3, 16, 8, 0, 114, 115, 5, 1, 0, 0, 115, 117, 3, 54, 
		    27, 0, 116, 118, 5, 2, 0, 0, 117, 116, 1, 0, 0, 0, 117, 118, 1, 0, 
		    0, 0, 118, 7, 1, 0, 0, 0, 119, 120, 5, 36, 0, 0, 120, 121, 5, 57, 
		    0, 0, 121, 123, 5, 3, 0, 0, 122, 124, 3, 10, 5, 0, 123, 122, 1, 0, 
		    0, 0, 123, 124, 1, 0, 0, 0, 124, 125, 1, 0, 0, 0, 125, 127, 5, 4, 
		    0, 0, 126, 128, 3, 14, 7, 0, 127, 126, 1, 0, 0, 0, 127, 128, 1, 0, 
		    0, 0, 128, 129, 1, 0, 0, 0, 129, 130, 3, 20, 10, 0, 130, 9, 1, 0, 
		    0, 0, 131, 136, 3, 12, 6, 0, 132, 133, 5, 5, 0, 0, 133, 135, 3, 12, 
		    6, 0, 134, 132, 1, 0, 0, 0, 135, 138, 1, 0, 0, 0, 136, 134, 1, 0, 
		    0, 0, 136, 137, 1, 0, 0, 0, 137, 11, 1, 0, 0, 0, 138, 136, 1, 0, 0, 
		    0, 139, 140, 5, 57, 0, 0, 140, 141, 3, 16, 8, 0, 141, 13, 1, 0, 0, 
		    0, 142, 155, 3, 16, 8, 0, 143, 144, 5, 3, 0, 0, 144, 149, 3, 16, 8, 
		    0, 145, 146, 5, 5, 0, 0, 146, 148, 3, 16, 8, 0, 147, 145, 1, 0, 0, 
		    0, 148, 151, 1, 0, 0, 0, 149, 147, 1, 0, 0, 0, 149, 150, 1, 0, 0, 
		    0, 150, 152, 1, 0, 0, 0, 151, 149, 1, 0, 0, 0, 152, 153, 5, 4, 0, 
		    0, 153, 155, 1, 0, 0, 0, 154, 142, 1, 0, 0, 0, 154, 143, 1, 0, 0, 
		    0, 155, 15, 1, 0, 0, 0, 156, 173, 3, 18, 9, 0, 157, 158, 5, 6, 0, 
		    0, 158, 173, 3, 16, 8, 0, 159, 160, 5, 7, 0, 0, 160, 161, 3, 54, 27, 
		    0, 161, 162, 5, 8, 0, 0, 162, 163, 3, 16, 8, 0, 163, 173, 1, 0, 0, 
		    0, 164, 165, 5, 7, 0, 0, 165, 166, 3, 54, 27, 0, 166, 167, 5, 8, 0, 
		    0, 167, 168, 5, 7, 0, 0, 168, 169, 3, 54, 27, 0, 169, 170, 5, 8, 0, 
		    0, 170, 171, 3, 16, 8, 0, 171, 173, 1, 0, 0, 0, 172, 156, 1, 0, 0, 
		    0, 172, 157, 1, 0, 0, 0, 172, 159, 1, 0, 0, 0, 172, 164, 1, 0, 0, 
		    0, 173, 17, 1, 0, 0, 0, 174, 175, 7, 0, 0, 0, 175, 19, 1, 0, 0, 0, 
		    176, 180, 5, 9, 0, 0, 177, 179, 3, 22, 11, 0, 178, 177, 1, 0, 0, 0, 
		    179, 182, 1, 0, 0, 0, 180, 178, 1, 0, 0, 0, 180, 181, 1, 0, 0, 0, 
		    181, 183, 1, 0, 0, 0, 182, 180, 1, 0, 0, 0, 183, 184, 5, 10, 0, 0, 
		    184, 21, 1, 0, 0, 0, 185, 208, 3, 4, 2, 0, 186, 208, 3, 6, 3, 0, 187, 
		    189, 3, 24, 12, 0, 188, 190, 5, 2, 0, 0, 189, 188, 1, 0, 0, 0, 189, 
		    190, 1, 0, 0, 0, 190, 208, 1, 0, 0, 0, 191, 193, 3, 36, 18, 0, 192, 
		    194, 5, 2, 0, 0, 193, 192, 1, 0, 0, 0, 193, 194, 1, 0, 0, 0, 194, 
		    208, 1, 0, 0, 0, 195, 197, 3, 38, 19, 0, 196, 198, 5, 2, 0, 0, 197, 
		    196, 1, 0, 0, 0, 197, 198, 1, 0, 0, 0, 198, 208, 1, 0, 0, 0, 199, 
		    201, 3, 40, 20, 0, 200, 202, 5, 2, 0, 0, 201, 200, 1, 0, 0, 0, 201, 
		    202, 1, 0, 0, 0, 202, 208, 1, 0, 0, 0, 203, 208, 3, 42, 21, 0, 204, 
		    208, 3, 44, 22, 0, 205, 208, 3, 50, 25, 0, 206, 208, 3, 20, 10, 0, 
		    207, 185, 1, 0, 0, 0, 207, 186, 1, 0, 0, 0, 207, 187, 1, 0, 0, 0, 
		    207, 191, 1, 0, 0, 0, 207, 195, 1, 0, 0, 0, 207, 199, 1, 0, 0, 0, 
		    207, 203, 1, 0, 0, 0, 207, 204, 1, 0, 0, 0, 207, 205, 1, 0, 0, 0, 
		    207, 206, 1, 0, 0, 0, 208, 23, 1, 0, 0, 0, 209, 214, 3, 26, 13, 0, 
		    210, 214, 3, 28, 14, 0, 211, 214, 3, 32, 16, 0, 212, 214, 3, 34, 17, 
		    0, 213, 209, 1, 0, 0, 0, 213, 210, 1, 0, 0, 0, 213, 211, 1, 0, 0, 
		    0, 213, 212, 1, 0, 0, 0, 214, 25, 1, 0, 0, 0, 215, 216, 3, 84, 42, 
		    0, 216, 217, 5, 11, 0, 0, 217, 218, 3, 86, 43, 0, 218, 27, 1, 0, 0, 
		    0, 219, 220, 3, 86, 43, 0, 220, 221, 3, 30, 15, 0, 221, 222, 3, 86, 
		    43, 0, 222, 29, 1, 0, 0, 0, 223, 224, 7, 1, 0, 0, 224, 31, 1, 0, 0, 
		    0, 225, 226, 3, 54, 27, 0, 226, 227, 7, 2, 0, 0, 227, 33, 1, 0, 0, 
		    0, 228, 229, 3, 54, 27, 0, 229, 35, 1, 0, 0, 0, 230, 232, 5, 43, 0, 
		    0, 231, 233, 3, 86, 43, 0, 232, 231, 1, 0, 0, 0, 232, 233, 1, 0, 0, 
		    0, 233, 37, 1, 0, 0, 0, 234, 235, 5, 44, 0, 0, 235, 39, 1, 0, 0, 0, 
		    236, 237, 5, 45, 0, 0, 237, 41, 1, 0, 0, 0, 238, 239, 5, 37, 0, 0, 
		    239, 240, 3, 54, 27, 0, 240, 241, 3, 20, 10, 0, 241, 255, 1, 0, 0, 
		    0, 242, 243, 5, 37, 0, 0, 243, 244, 3, 54, 27, 0, 244, 245, 3, 20, 
		    10, 0, 245, 246, 5, 38, 0, 0, 246, 247, 3, 20, 10, 0, 247, 255, 1, 
		    0, 0, 0, 248, 249, 5, 37, 0, 0, 249, 250, 3, 54, 27, 0, 250, 251, 
		    3, 20, 10, 0, 251, 252, 5, 38, 0, 0, 252, 253, 3, 42, 21, 0, 253, 
		    255, 1, 0, 0, 0, 254, 238, 1, 0, 0, 0, 254, 242, 1, 0, 0, 0, 254, 
		    248, 1, 0, 0, 0, 255, 43, 1, 0, 0, 0, 256, 258, 5, 40, 0, 0, 257, 
		    259, 3, 54, 27, 0, 258, 257, 1, 0, 0, 0, 258, 259, 1, 0, 0, 0, 259, 
		    260, 1, 0, 0, 0, 260, 264, 5, 9, 0, 0, 261, 263, 3, 46, 23, 0, 262, 
		    261, 1, 0, 0, 0, 263, 266, 1, 0, 0, 0, 264, 262, 1, 0, 0, 0, 264, 
		    265, 1, 0, 0, 0, 265, 268, 1, 0, 0, 0, 266, 264, 1, 0, 0, 0, 267, 
		    269, 3, 48, 24, 0, 268, 267, 1, 0, 0, 0, 268, 269, 1, 0, 0, 0, 269, 
		    270, 1, 0, 0, 0, 270, 271, 5, 10, 0, 0, 271, 45, 1, 0, 0, 0, 272, 
		    273, 5, 41, 0, 0, 273, 274, 3, 86, 43, 0, 274, 278, 5, 18, 0, 0, 275, 
		    277, 3, 22, 11, 0, 276, 275, 1, 0, 0, 0, 277, 280, 1, 0, 0, 0, 278, 
		    276, 1, 0, 0, 0, 278, 279, 1, 0, 0, 0, 279, 47, 1, 0, 0, 0, 280, 278, 
		    1, 0, 0, 0, 281, 282, 5, 42, 0, 0, 282, 286, 5, 18, 0, 0, 283, 285, 
		    3, 22, 11, 0, 284, 283, 1, 0, 0, 0, 285, 288, 1, 0, 0, 0, 286, 284, 
		    1, 0, 0, 0, 286, 287, 1, 0, 0, 0, 287, 49, 1, 0, 0, 0, 288, 286, 1, 
		    0, 0, 0, 289, 290, 5, 39, 0, 0, 290, 291, 3, 52, 26, 0, 291, 292, 
		    3, 20, 10, 0, 292, 300, 1, 0, 0, 0, 293, 294, 5, 39, 0, 0, 294, 295, 
		    3, 54, 27, 0, 295, 296, 3, 20, 10, 0, 296, 300, 1, 0, 0, 0, 297, 298, 
		    5, 39, 0, 0, 298, 300, 3, 20, 10, 0, 299, 289, 1, 0, 0, 0, 299, 293, 
		    1, 0, 0, 0, 299, 297, 1, 0, 0, 0, 300, 51, 1, 0, 0, 0, 301, 303, 3, 
		    24, 12, 0, 302, 301, 1, 0, 0, 0, 302, 303, 1, 0, 0, 0, 303, 304, 1, 
		    0, 0, 0, 304, 306, 5, 2, 0, 0, 305, 307, 3, 54, 27, 0, 306, 305, 1, 
		    0, 0, 0, 306, 307, 1, 0, 0, 0, 307, 308, 1, 0, 0, 0, 308, 310, 5, 
		    2, 0, 0, 309, 311, 3, 24, 12, 0, 310, 309, 1, 0, 0, 0, 310, 311, 1, 
		    0, 0, 0, 311, 53, 1, 0, 0, 0, 312, 313, 6, 27, -1, 0, 313, 314, 3, 
		    56, 28, 0, 314, 321, 1, 0, 0, 0, 315, 316, 10, 1, 0, 0, 316, 317, 
		    3, 58, 29, 0, 317, 318, 3, 54, 27, 2, 318, 320, 1, 0, 0, 0, 319, 315, 
		    1, 0, 0, 0, 320, 323, 1, 0, 0, 0, 321, 319, 1, 0, 0, 0, 321, 322, 
		    1, 0, 0, 0, 322, 55, 1, 0, 0, 0, 323, 321, 1, 0, 0, 0, 324, 329, 3, 
		    68, 34, 0, 325, 326, 3, 66, 33, 0, 326, 327, 3, 56, 28, 0, 327, 329, 
		    1, 0, 0, 0, 328, 324, 1, 0, 0, 0, 328, 325, 1, 0, 0, 0, 329, 57, 1, 
		    0, 0, 0, 330, 336, 5, 19, 0, 0, 331, 336, 5, 20, 0, 0, 332, 336, 3, 
		    60, 30, 0, 333, 336, 3, 62, 31, 0, 334, 336, 3, 64, 32, 0, 335, 330, 
		    1, 0, 0, 0, 335, 331, 1, 0, 0, 0, 335, 332, 1, 0, 0, 0, 335, 333, 
		    1, 0, 0, 0, 335, 334, 1, 0, 0, 0, 336, 59, 1, 0, 0, 0, 337, 338, 7, 
		    3, 0, 0, 338, 61, 1, 0, 0, 0, 339, 340, 7, 4, 0, 0, 340, 63, 1, 0, 
		    0, 0, 341, 342, 7, 5, 0, 0, 342, 65, 1, 0, 0, 0, 343, 344, 7, 6, 0, 
		    0, 344, 67, 1, 0, 0, 0, 345, 346, 6, 34, -1, 0, 346, 353, 3, 70, 35, 
		    0, 347, 348, 3, 18, 9, 0, 348, 349, 5, 3, 0, 0, 349, 350, 3, 54, 27, 
		    0, 350, 351, 5, 4, 0, 0, 351, 353, 1, 0, 0, 0, 352, 345, 1, 0, 0, 
		    0, 352, 347, 1, 0, 0, 0, 353, 375, 1, 0, 0, 0, 354, 355, 10, 4, 0, 
		    0, 355, 356, 5, 7, 0, 0, 356, 357, 3, 54, 27, 0, 357, 358, 5, 8, 0, 
		    0, 358, 374, 1, 0, 0, 0, 359, 360, 10, 3, 0, 0, 360, 361, 5, 7, 0, 
		    0, 361, 362, 3, 54, 27, 0, 362, 363, 5, 8, 0, 0, 363, 364, 5, 7, 0, 
		    0, 364, 365, 3, 54, 27, 0, 365, 366, 5, 8, 0, 0, 366, 374, 1, 0, 0, 
		    0, 367, 368, 10, 2, 0, 0, 368, 370, 5, 3, 0, 0, 369, 371, 3, 86, 43, 
		    0, 370, 369, 1, 0, 0, 0, 370, 371, 1, 0, 0, 0, 371, 372, 1, 0, 0, 
		    0, 372, 374, 5, 4, 0, 0, 373, 354, 1, 0, 0, 0, 373, 359, 1, 0, 0, 
		    0, 373, 367, 1, 0, 0, 0, 374, 377, 1, 0, 0, 0, 375, 373, 1, 0, 0, 
		    0, 375, 376, 1, 0, 0, 0, 376, 69, 1, 0, 0, 0, 377, 375, 1, 0, 0, 0, 
		    378, 385, 3, 74, 37, 0, 379, 385, 3, 72, 36, 0, 380, 381, 5, 3, 0, 
		    0, 381, 382, 3, 54, 27, 0, 382, 383, 5, 4, 0, 0, 383, 385, 1, 0, 0, 
		    0, 384, 378, 1, 0, 0, 0, 384, 379, 1, 0, 0, 0, 384, 380, 1, 0, 0, 
		    0, 385, 71, 1, 0, 0, 0, 386, 391, 5, 57, 0, 0, 387, 388, 5, 33, 0, 
		    0, 388, 390, 5, 57, 0, 0, 389, 387, 1, 0, 0, 0, 390, 393, 1, 0, 0, 
		    0, 391, 389, 1, 0, 0, 0, 391, 392, 1, 0, 0, 0, 392, 73, 1, 0, 0, 0, 
		    393, 391, 1, 0, 0, 0, 394, 397, 3, 76, 38, 0, 395, 397, 3, 78, 39, 
		    0, 396, 394, 1, 0, 0, 0, 396, 395, 1, 0, 0, 0, 397, 75, 1, 0, 0, 0, 
		    398, 399, 7, 7, 0, 0, 399, 77, 1, 0, 0, 0, 400, 401, 5, 7, 0, 0, 401, 
		    402, 3, 54, 27, 0, 402, 403, 5, 8, 0, 0, 403, 404, 3, 16, 8, 0, 404, 
		    405, 5, 9, 0, 0, 405, 406, 3, 80, 40, 0, 406, 407, 5, 10, 0, 0, 407, 
		    79, 1, 0, 0, 0, 408, 413, 3, 82, 41, 0, 409, 410, 5, 5, 0, 0, 410, 
		    412, 3, 82, 41, 0, 411, 409, 1, 0, 0, 0, 412, 415, 1, 0, 0, 0, 413, 
		    411, 1, 0, 0, 0, 413, 414, 1, 0, 0, 0, 414, 417, 1, 0, 0, 0, 415, 
		    413, 1, 0, 0, 0, 416, 418, 5, 5, 0, 0, 417, 416, 1, 0, 0, 0, 417, 
		    418, 1, 0, 0, 0, 418, 421, 1, 0, 0, 0, 419, 421, 1, 0, 0, 0, 420, 
		    408, 1, 0, 0, 0, 420, 419, 1, 0, 0, 0, 421, 81, 1, 0, 0, 0, 422, 423, 
		    5, 9, 0, 0, 423, 424, 3, 80, 40, 0, 424, 425, 5, 10, 0, 0, 425, 428, 
		    1, 0, 0, 0, 426, 428, 3, 54, 27, 0, 427, 422, 1, 0, 0, 0, 427, 426, 
		    1, 0, 0, 0, 428, 83, 1, 0, 0, 0, 429, 434, 5, 57, 0, 0, 430, 431, 
		    5, 5, 0, 0, 431, 433, 5, 57, 0, 0, 432, 430, 1, 0, 0, 0, 433, 436, 
		    1, 0, 0, 0, 434, 432, 1, 0, 0, 0, 434, 435, 1, 0, 0, 0, 435, 85, 1, 
		    0, 0, 0, 436, 434, 1, 0, 0, 0, 437, 442, 3, 54, 27, 0, 438, 439, 5, 
		    5, 0, 0, 439, 441, 3, 54, 27, 0, 440, 438, 1, 0, 0, 0, 441, 444, 1, 
		    0, 0, 0, 442, 440, 1, 0, 0, 0, 442, 443, 1, 0, 0, 0, 443, 87, 1, 0, 
		    0, 0, 444, 442, 1, 0, 0, 0, 45, 91, 99, 106, 109, 117, 123, 127, 136, 
		    149, 154, 172, 180, 189, 193, 197, 201, 207, 213, 232, 254, 258, 264, 
		    268, 278, 286, 299, 302, 306, 310, 321, 328, 335, 352, 370, 373, 375, 
		    384, 391, 396, 413, 417, 420, 427, 434, 442];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.2', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "Grammar.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function program(): Context\ProgramContext
		{
		    $localContext = new Context\ProgramContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_program);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(91);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 120259084288) !== 0)) {
		        	$this->setState(88);
		        	$this->declaration();
		        	$this->setState(93);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(94);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaration(): Context\DeclarationContext
		{
		    $localContext = new Context\DeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_declaration);

		    try {
		        $this->setState(99);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::VAR:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(96);
		            	$this->varDecl();
		            	break;

		            case self::CONST:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(97);
		            	$this->constDecl();
		            	break;

		            case self::FUNC:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(98);
		            	$this->functionDecl();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varDecl(): Context\VarDeclContext
		{
		    $localContext = new Context\VarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_varDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(101);
		        $this->match(self::VAR);
		        $this->setState(102);
		        $this->identifierList();
		        $this->setState(103);
		        $this->type();
		        $this->setState(106);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__0) {
		        	$this->setState(104);
		        	$this->match(self::T__0);
		        	$this->setState(105);
		        	$this->expressionList();
		        }
		        $this->setState(109);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__1) {
		        	$this->setState(108);
		        	$this->match(self::T__1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function constDecl(): Context\ConstDeclContext
		{
		    $localContext = new Context\ConstDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_constDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(111);
		        $this->match(self::CONST);
		        $this->setState(112);
		        $this->match(self::ID);
		        $this->setState(113);
		        $this->type();
		        $this->setState(114);
		        $this->match(self::T__0);
		        $this->setState(115);
		        $this->recursiveExpression(0);
		        $this->setState(117);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__1) {
		        	$this->setState(116);
		        	$this->match(self::T__1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionDecl(): Context\FunctionDeclContext
		{
		    $localContext = new Context\FunctionDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_functionDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(119);
		        $this->match(self::FUNC);
		        $this->setState(120);
		        $this->match(self::ID);
		        $this->setState(121);
		        $this->match(self::T__2);
		        $this->setState(123);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ID) {
		        	$this->setState(122);
		        	$this->parameterList();
		        }
		        $this->setState(125);
		        $this->match(self::T__3);
		        $this->setState(127);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4362862139015368) !== 0)) {
		        	$this->setState(126);
		        	$this->returnType();
		        }
		        $this->setState(129);
		        $this->block();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameterList(): Context\ParameterListContext
		{
		    $localContext = new Context\ParameterListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_parameterList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(131);
		        $this->parameter();
		        $this->setState(136);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__4) {
		        	$this->setState(132);
		        	$this->match(self::T__4);
		        	$this->setState(133);
		        	$this->parameter();
		        	$this->setState(138);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameter(): Context\ParameterContext
		{
		    $localContext = new Context\ParameterContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_parameter);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(139);
		        $this->match(self::ID);
		        $this->setState(140);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnType(): Context\ReturnTypeContext
		{
		    $localContext = new Context\ReturnTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_returnType);

		    try {
		        $this->setState(154);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__5:
		            case self::T__6:
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL_TYPE:
		            case self::RUNE:
		            case self::STRING_TYPE:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(142);
		            	$this->type();
		            	break;

		            case self::T__2:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(143);
		            	$this->match(self::T__2);
		            	$this->setState(144);
		            	$this->type();
		            	$this->setState(149);
		            	$this->errorHandler->sync($this);

		            	$_la = $this->input->LA(1);
		            	while ($_la === self::T__4) {
		            		$this->setState(145);
		            		$this->match(self::T__4);
		            		$this->setState(146);
		            		$this->type();
		            		$this->setState(151);
		            		$this->errorHandler->sync($this);
		            		$_la = $this->input->LA(1);
		            	}
		            	$this->setState(152);
		            	$this->match(self::T__3);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type(): Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_type);

		    try {
		        $this->setState(172);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 10, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(156);
		        	    $this->basicType();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(157);
		        	    $this->match(self::T__5);
		        	    $this->setState(158);
		        	    $this->type();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(159);
		        	    $this->match(self::T__6);
		        	    $this->setState(160);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(161);
		        	    $this->match(self::T__7);
		        	    $this->setState(162);
		        	    $this->type();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(164);
		        	    $this->match(self::T__6);
		        	    $this->setState(165);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(166);
		        	    $this->match(self::T__7);
		        	    $this->setState(167);
		        	    $this->match(self::T__6);
		        	    $this->setState(168);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(169);
		        	    $this->match(self::T__7);
		        	    $this->setState(170);
		        	    $this->type();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function basicType(): Context\BasicTypeContext
		{
		    $localContext = new Context\BasicTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_basicType);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(174);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4362862139015168) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block(): Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(176);
		        $this->match(self::T__8);
		        $this->setState(180);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 288223425149797064) !== 0)) {
		        	$this->setState(177);
		        	$this->statement();
		        	$this->setState(182);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(183);
		        $this->match(self::T__9);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statement(): Context\StatementContext
		{
		    $localContext = new Context\StatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_statement);

		    try {
		        $this->setState(207);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::VAR:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(185);
		            	$this->varDecl();
		            	break;

		            case self::CONST:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(186);
		            	$this->constDecl();
		            	break;

		            case self::T__2:
		            case self::T__5:
		            case self::T__6:
		            case self::T__26:
		            case self::T__27:
		            case self::T__30:
		            case self::T__31:
		            case self::NIL:
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL_TYPE:
		            case self::RUNE:
		            case self::STRING_TYPE:
		            case self::BOOL_LIT:
		            case self::INT_LIT:
		            case self::FLOAT_LIT:
		            case self::STRING_LIT:
		            case self::RUNE_LIT:
		            case self::ID:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(187);
		            	$this->simpleStmt();
		            	$this->setState(189);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__1) {
		            		$this->setState(188);
		            		$this->match(self::T__1);
		            	}
		            	break;

		            case self::RETURN:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(191);
		            	$this->returnStmt();
		            	$this->setState(193);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__1) {
		            		$this->setState(192);
		            		$this->match(self::T__1);
		            	}
		            	break;

		            case self::BREAK:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(195);
		            	$this->breakStmt();
		            	$this->setState(197);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__1) {
		            		$this->setState(196);
		            		$this->match(self::T__1);
		            	}
		            	break;

		            case self::CONTINUE:
		            	$this->enterOuterAlt($localContext, 6);
		            	$this->setState(199);
		            	$this->continueStmt();
		            	$this->setState(201);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__1) {
		            		$this->setState(200);
		            		$this->match(self::T__1);
		            	}
		            	break;

		            case self::IF:
		            	$this->enterOuterAlt($localContext, 7);
		            	$this->setState(203);
		            	$this->ifStmt();
		            	break;

		            case self::SWITCH:
		            	$this->enterOuterAlt($localContext, 8);
		            	$this->setState(204);
		            	$this->switchStmt();
		            	break;

		            case self::FOR:
		            	$this->enterOuterAlt($localContext, 9);
		            	$this->setState(205);
		            	$this->forStmt();
		            	break;

		            case self::T__8:
		            	$this->enterOuterAlt($localContext, 10);
		            	$this->setState(206);
		            	$this->block();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function simpleStmt(): Context\SimpleStmtContext
		{
		    $localContext = new Context\SimpleStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_simpleStmt);

		    try {
		        $this->setState(213);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 17, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(209);
		        	    $this->shortVarDecl();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(210);
		        	    $this->assignment();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(211);
		        	    $this->incDecStmt();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(212);
		        	    $this->expressionStmt();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function shortVarDecl(): Context\ShortVarDeclContext
		{
		    $localContext = new Context\ShortVarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_shortVarDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(215);
		        $this->identifierList();
		        $this->setState(216);
		        $this->match(self::T__10);
		        $this->setState(217);
		        $this->expressionList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignment(): Context\AssignmentContext
		{
		    $localContext = new Context\AssignmentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_assignment);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(219);
		        $this->expressionList();
		        $this->setState(220);
		        $this->assignOp();
		        $this->setState(221);
		        $this->expressionList();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignOp(): Context\AssignOpContext
		{
		    $localContext = new Context\AssignOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_assignOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(223);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 61442) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function incDecStmt(): Context\IncDecStmtContext
		{
		    $localContext = new Context\IncDecStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_incDecStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(225);
		        $this->recursiveExpression(0);
		        $this->setState(226);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::T__15 || $_la === self::T__16)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expressionStmt(): Context\ExpressionStmtContext
		{
		    $localContext = new Context\ExpressionStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_expressionStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(228);
		        $this->recursiveExpression(0);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnStmt(): Context\ReturnStmtContext
		{
		    $localContext = new Context\ReturnStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(230);
		        $this->match(self::RETURN);
		        $this->setState(232);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx)) {
		            case 1:
		        	    $this->setState(231);
		        	    $this->expressionList();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function breakStmt(): Context\BreakStmtContext
		{
		    $localContext = new Context\BreakStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(234);
		        $this->match(self::BREAK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function continueStmt(): Context\ContinueStmtContext
		{
		    $localContext = new Context\ContinueStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(236);
		        $this->match(self::CONTINUE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStmt(): Context\IfStmtContext
		{
		    $localContext = new Context\IfStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_ifStmt);

		    try {
		        $this->setState(254);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 19, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(238);
		        	    $this->match(self::IF);
		        	    $this->setState(239);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(240);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(242);
		        	    $this->match(self::IF);
		        	    $this->setState(243);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(244);
		        	    $this->block();
		        	    $this->setState(245);
		        	    $this->match(self::ELSE);
		        	    $this->setState(246);
		        	    $this->block();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(248);
		        	    $this->match(self::IF);
		        	    $this->setState(249);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(250);
		        	    $this->block();
		        	    $this->setState(251);
		        	    $this->match(self::ELSE);
		        	    $this->setState(252);
		        	    $this->ifStmt();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchStmt(): Context\SwitchStmtContext
		{
		    $localContext = new Context\SwitchStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_switchStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(256);
		        $this->match(self::SWITCH);
		        $this->setState(258);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 288160014252638408) !== 0)) {
		        	$this->setState(257);
		        	$this->recursiveExpression(0);
		        }
		        $this->setState(260);
		        $this->match(self::T__8);
		        $this->setState(264);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE) {
		        	$this->setState(261);
		        	$this->caseClause();
		        	$this->setState(266);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(268);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DEFAULT) {
		        	$this->setState(267);
		        	$this->defaultClause();
		        }
		        $this->setState(270);
		        $this->match(self::T__9);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caseClause(): Context\CaseClauseContext
		{
		    $localContext = new Context\CaseClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_caseClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(272);
		        $this->match(self::CASE);
		        $this->setState(273);
		        $this->expressionList();
		        $this->setState(274);
		        $this->match(self::T__17);
		        $this->setState(278);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 288223425149797064) !== 0)) {
		        	$this->setState(275);
		        	$this->statement();
		        	$this->setState(280);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function defaultClause(): Context\DefaultClauseContext
		{
		    $localContext = new Context\DefaultClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_defaultClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(281);
		        $this->match(self::DEFAULT);
		        $this->setState(282);
		        $this->match(self::T__17);
		        $this->setState(286);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 288223425149797064) !== 0)) {
		        	$this->setState(283);
		        	$this->statement();
		        	$this->setState(288);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forStmt(): Context\ForStmtContext
		{
		    $localContext = new Context\ForStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_forStmt);

		    try {
		        $this->setState(299);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 25, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(289);
		        	    $this->match(self::FOR);
		        	    $this->setState(290);
		        	    $this->forClause();
		        	    $this->setState(291);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(293);
		        	    $this->match(self::FOR);
		        	    $this->setState(294);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(295);
		        	    $this->block();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(297);
		        	    $this->match(self::FOR);
		        	    $this->setState(298);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forClause(): Context\ForClauseContext
		{
		    $localContext = new Context\ForClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_forClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(302);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 288160014252638408) !== 0)) {
		        	$this->setState(301);
		        	$this->simpleStmt();
		        }
		        $this->setState(304);
		        $this->match(self::T__1);
		        $this->setState(306);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 288160014252638408) !== 0)) {
		        	$this->setState(305);
		        	$this->recursiveExpression(0);
		        }
		        $this->setState(308);
		        $this->match(self::T__1);
		        $this->setState(310);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 288160014252638408) !== 0)) {
		        	$this->setState(309);
		        	$this->simpleStmt();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expression(): Context\ExpressionContext
		{
			return $this->recursiveExpression(0);
		}

		/**
		 * @throws RecognitionException
		 */
		private function recursiveExpression(int $precedence): Context\ExpressionContext
		{
			$parentContext = $this->ctx;
			$parentState = $this->getState();
			$localContext = new Context\ExpressionContext($this->ctx, $parentState);
			$previousContext = $localContext;
			$startState = 54;
			$this->enterRecursionRule($localContext, 54, self::RULE_expression, $precedence);

			try {
				$this->enterOuterAlt($localContext, 1);
				$this->setState(313);
				$this->unaryExpr();
				$this->ctx->stop = $this->input->LT(-1);
				$this->setState(321);
				$this->errorHandler->sync($this);

				$alt = $this->getInterpreter()->adaptivePredict($this->input, 29, $this->ctx);

				while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					if ($alt === 1) {
						if ($this->getParseListeners() !== null) {
						    $this->triggerExitRuleEvent();
						}

						$previousContext = $localContext;
						$localContext = new Context\ExpressionContext($parentContext, $parentState);
						$this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
						$this->setState(315);

						if (!($this->precpred($this->ctx, 1))) {
						    throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 1)");
						}
						$this->setState(316);
						$this->binaryOp();
						$this->setState(317);
						$this->recursiveExpression(2); 
					}

					$this->setState(323);
					$this->errorHandler->sync($this);

					$alt = $this->getInterpreter()->adaptivePredict($this->input, 29, $this->ctx);
				}
			} catch (RecognitionException $exception) {
				$localContext->exception = $exception;
				$this->errorHandler->reportError($this, $exception);
				$this->errorHandler->recover($this, $exception);
			} finally {
				$this->unrollRecursionContexts($parentContext);
			}

			return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function unaryExpr(): Context\UnaryExprContext
		{
		    $localContext = new Context\UnaryExprContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_unaryExpr);

		    try {
		        $this->setState(328);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__2:
		            case self::T__6:
		            case self::NIL:
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL_TYPE:
		            case self::RUNE:
		            case self::STRING_TYPE:
		            case self::BOOL_LIT:
		            case self::INT_LIT:
		            case self::FLOAT_LIT:
		            case self::STRING_LIT:
		            case self::RUNE_LIT:
		            case self::ID:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(324);
		            	$this->recursivePrimaryExpr(0);
		            	break;

		            case self::T__5:
		            case self::T__26:
		            case self::T__27:
		            case self::T__30:
		            case self::T__31:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(325);
		            	$this->unaryOp();
		            	$this->setState(326);
		            	$this->unaryExpr();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function binaryOp(): Context\BinaryOpContext
		{
		    $localContext = new Context\BinaryOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 58, self::RULE_binaryOp);

		    try {
		        $this->setState(335);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__18:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(330);
		            	$this->match(self::T__18);
		            	break;

		            case self::T__19:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(331);
		            	$this->match(self::T__19);
		            	break;

		            case self::T__20:
		            case self::T__21:
		            case self::T__22:
		            case self::T__23:
		            case self::T__24:
		            case self::T__25:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(332);
		            	$this->relOp();
		            	break;

		            case self::T__26:
		            case self::T__27:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(333);
		            	$this->addOp();
		            	break;

		            case self::T__5:
		            case self::T__28:
		            case self::T__29:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(334);
		            	$this->mulOp();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function relOp(): Context\RelOpContext
		{
		    $localContext = new Context\RelOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_relOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(337);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 132120576) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function addOp(): Context\AddOpContext
		{
		    $localContext = new Context\AddOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 62, self::RULE_addOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(339);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::T__26 || $_la === self::T__27)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function mulOp(): Context\MulOpContext
		{
		    $localContext = new Context\MulOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 64, self::RULE_mulOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(341);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1610612800) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function unaryOp(): Context\UnaryOpContext
		{
		    $localContext = new Context\UnaryOpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_unaryOp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(343);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 6845104192) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function primaryExpr(): Context\PrimaryExprContext
		{
			return $this->recursivePrimaryExpr(0);
		}

		/**
		 * @throws RecognitionException
		 */
		private function recursivePrimaryExpr(int $precedence): Context\PrimaryExprContext
		{
			$parentContext = $this->ctx;
			$parentState = $this->getState();
			$localContext = new Context\PrimaryExprContext($this->ctx, $parentState);
			$previousContext = $localContext;
			$startState = 68;
			$this->enterRecursionRule($localContext, 68, self::RULE_primaryExpr, $precedence);

			try {
				$this->enterOuterAlt($localContext, 1);
				$this->setState(352);
				$this->errorHandler->sync($this);

				switch ($this->input->LA(1)) {
				    case self::T__2:
				    case self::T__6:
				    case self::NIL:
				    case self::BOOL_LIT:
				    case self::INT_LIT:
				    case self::FLOAT_LIT:
				    case self::STRING_LIT:
				    case self::RUNE_LIT:
				    case self::ID:
				    	$this->setState(346);
				    	$this->operand();
				    	break;

				    case self::INT32:
				    case self::FLOAT32:
				    case self::BOOL_TYPE:
				    case self::RUNE:
				    case self::STRING_TYPE:
				    	$this->setState(347);
				    	$this->basicType();
				    	$this->setState(348);
				    	$this->match(self::T__2);
				    	$this->setState(349);
				    	$this->recursiveExpression(0);
				    	$this->setState(350);
				    	$this->match(self::T__3);
				    	break;

				default:
					throw new NoViableAltException($this);
				}
				$this->ctx->stop = $this->input->LT(-1);
				$this->setState(375);
				$this->errorHandler->sync($this);

				$alt = $this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx);

				while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					if ($alt === 1) {
						if ($this->getParseListeners() !== null) {
						    $this->triggerExitRuleEvent();
						}

						$previousContext = $localContext;
						$this->setState(373);
						$this->errorHandler->sync($this);

						switch ($this->getInterpreter()->adaptivePredict($this->input, 34, $this->ctx)) {
							case 1:
							    $localContext = new Context\PrimaryExprContext($parentContext, $parentState);
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_primaryExpr);
							    $this->setState(354);

							    if (!($this->precpred($this->ctx, 4))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 4)");
							    }
							    $this->setState(355);
							    $this->match(self::T__6);
							    $this->setState(356);
							    $this->recursiveExpression(0);
							    $this->setState(357);
							    $this->match(self::T__7);
							break;

							case 2:
							    $localContext = new Context\PrimaryExprContext($parentContext, $parentState);
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_primaryExpr);
							    $this->setState(359);

							    if (!($this->precpred($this->ctx, 3))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 3)");
							    }
							    $this->setState(360);
							    $this->match(self::T__6);
							    $this->setState(361);
							    $this->recursiveExpression(0);
							    $this->setState(362);
							    $this->match(self::T__7);
							    $this->setState(363);
							    $this->match(self::T__6);
							    $this->setState(364);
							    $this->recursiveExpression(0);
							    $this->setState(365);
							    $this->match(self::T__7);
							break;

							case 3:
							    $localContext = new Context\PrimaryExprContext($parentContext, $parentState);
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_primaryExpr);
							    $this->setState(367);

							    if (!($this->precpred($this->ctx, 2))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 2)");
							    }
							    $this->setState(368);
							    $this->match(self::T__2);
							    $this->setState(370);
							    $this->errorHandler->sync($this);
							    $_la = $this->input->LA(1);

							    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 288160014252638408) !== 0)) {
							    	$this->setState(369);
							    	$this->expressionList();
							    }
							    $this->setState(372);
							    $this->match(self::T__3);
							break;
						} 
					}

					$this->setState(377);
					$this->errorHandler->sync($this);

					$alt = $this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx);
				}
			} catch (RecognitionException $exception) {
				$localContext->exception = $exception;
				$this->errorHandler->reportError($this, $exception);
				$this->errorHandler->recover($this, $exception);
			} finally {
				$this->unrollRecursionContexts($parentContext);
			}

			return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operand(): Context\OperandContext
		{
		    $localContext = new Context\OperandContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_operand);

		    try {
		        $this->setState(384);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__6:
		            case self::NIL:
		            case self::BOOL_LIT:
		            case self::INT_LIT:
		            case self::FLOAT_LIT:
		            case self::STRING_LIT:
		            case self::RUNE_LIT:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(378);
		            	$this->literal();
		            	break;

		            case self::ID:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(379);
		            	$this->qualifiedIdent();
		            	break;

		            case self::T__2:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(380);
		            	$this->match(self::T__2);
		            	$this->setState(381);
		            	$this->recursiveExpression(0);
		            	$this->setState(382);
		            	$this->match(self::T__3);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function qualifiedIdent(): Context\QualifiedIdentContext
		{
		    $localContext = new Context\QualifiedIdentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 72, self::RULE_qualifiedIdent);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(386);
		        $this->match(self::ID);
		        $this->setState(391);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 37, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(387);
		        		$this->match(self::T__32);
		        		$this->setState(388);
		        		$this->match(self::ID); 
		        	}

		        	$this->setState(393);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 37, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function literal(): Context\LiteralContext
		{
		    $localContext = new Context\LiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 74, self::RULE_literal);

		    try {
		        $this->setState(396);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::NIL:
		            case self::BOOL_LIT:
		            case self::INT_LIT:
		            case self::FLOAT_LIT:
		            case self::STRING_LIT:
		            case self::RUNE_LIT:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(394);
		            	$this->basicLiteral();
		            	break;

		            case self::T__6:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(395);
		            	$this->arrayLiteral();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function basicLiteral(): Context\BasicLiteralContext
		{
		    $localContext = new Context\BasicLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 76, self::RULE_basicLiteral);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(398);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 139681957192663040) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayLiteral(): Context\ArrayLiteralContext
		{
		    $localContext = new Context\ArrayLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 78, self::RULE_arrayLiteral);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(400);
		        $this->match(self::T__6);
		        $this->setState(401);
		        $this->recursiveExpression(0);
		        $this->setState(402);
		        $this->match(self::T__7);
		        $this->setState(403);
		        $this->type();
		        $this->setState(404);
		        $this->match(self::T__8);
		        $this->setState(405);
		        $this->arrayElements();
		        $this->setState(406);
		        $this->match(self::T__9);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayElements(): Context\ArrayElementsContext
		{
		    $localContext = new Context\ArrayElementsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 80, self::RULE_arrayElements);

		    try {
		        $this->setState(420);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__2:
		            case self::T__5:
		            case self::T__6:
		            case self::T__8:
		            case self::T__26:
		            case self::T__27:
		            case self::T__30:
		            case self::T__31:
		            case self::NIL:
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL_TYPE:
		            case self::RUNE:
		            case self::STRING_TYPE:
		            case self::BOOL_LIT:
		            case self::INT_LIT:
		            case self::FLOAT_LIT:
		            case self::STRING_LIT:
		            case self::RUNE_LIT:
		            case self::ID:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(408);
		            	$this->arrayElement();
		            	$this->setState(413);
		            	$this->errorHandler->sync($this);

		            	$alt = $this->getInterpreter()->adaptivePredict($this->input, 39, $this->ctx);

		            	while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		            		if ($alt === 1) {
		            			$this->setState(409);
		            			$this->match(self::T__4);
		            			$this->setState(410);
		            			$this->arrayElement(); 
		            		}

		            		$this->setState(415);
		            		$this->errorHandler->sync($this);

		            		$alt = $this->getInterpreter()->adaptivePredict($this->input, 39, $this->ctx);
		            	}
		            	$this->setState(417);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__4) {
		            		$this->setState(416);
		            		$this->match(self::T__4);
		            	}
		            	break;

		            case self::T__9:
		            	$this->enterOuterAlt($localContext, 2);

		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayElement(): Context\ArrayElementContext
		{
		    $localContext = new Context\ArrayElementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 82, self::RULE_arrayElement);

		    try {
		        $this->setState(427);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__8:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(422);
		            	$this->match(self::T__8);
		            	$this->setState(423);
		            	$this->arrayElements();
		            	$this->setState(424);
		            	$this->match(self::T__9);
		            	break;

		            case self::T__2:
		            case self::T__5:
		            case self::T__6:
		            case self::T__26:
		            case self::T__27:
		            case self::T__30:
		            case self::T__31:
		            case self::NIL:
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL_TYPE:
		            case self::RUNE:
		            case self::STRING_TYPE:
		            case self::BOOL_LIT:
		            case self::INT_LIT:
		            case self::FLOAT_LIT:
		            case self::STRING_LIT:
		            case self::RUNE_LIT:
		            case self::ID:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(426);
		            	$this->recursiveExpression(0);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function identifierList(): Context\IdentifierListContext
		{
		    $localContext = new Context\IdentifierListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 84, self::RULE_identifierList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(429);
		        $this->match(self::ID);
		        $this->setState(434);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__4) {
		        	$this->setState(430);
		        	$this->match(self::T__4);
		        	$this->setState(431);
		        	$this->match(self::ID);
		        	$this->setState(436);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expressionList(): Context\ExpressionListContext
		{
		    $localContext = new Context\ExpressionListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 86, self::RULE_expressionList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(437);
		        $this->recursiveExpression(0);
		        $this->setState(442);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__4) {
		        	$this->setState(438);
		        	$this->match(self::T__4);
		        	$this->setState(439);
		        	$this->recursiveExpression(0);
		        	$this->setState(444);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		public function sempred(?RuleContext $localContext, int $ruleIndex, int $predicateIndex): bool
		{
			switch ($ruleIndex) {
					case 27:
						return $this->sempredExpression($localContext, $predicateIndex);

					case 34:
						return $this->sempredPrimaryExpr($localContext, $predicateIndex);

				default:
					return true;
				}
		}

		private function sempredExpression(?Context\ExpressionContext $localContext, int $predicateIndex): bool
		{
			switch ($predicateIndex) {
			    case 0:
			        return $this->precpred($this->ctx, 1);
			}

			return true;
		}

		private function sempredPrimaryExpr(?Context\PrimaryExprContext $localContext, int $predicateIndex): bool
		{
			switch ($predicateIndex) {
			    case 1:
			        return $this->precpred($this->ctx, 4);

			    case 2:
			        return $this->precpred($this->ctx, 3);

			    case 3:
			        return $this->precpred($this->ctx, 2);
			}

			return true;
		}
	}
}

namespace Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use GrammarParser;
	use GrammarVisitor;

	class ProgramContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_program;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::EOF, 0);
	    }

	    /**
	     * @return array<DeclarationContext>|DeclarationContext|null
	     */
	    public function declaration(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(DeclarationContext::class);
	    	}

	        return $this->getTypedRuleContext(DeclarationContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitProgram($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_declaration;
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

	    public function functionDecl(): ?FunctionDeclContext
	    {
	    	return $this->getTypedRuleContext(FunctionDeclContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitDeclaration($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_varDecl;
	    }

	    public function VAR(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::VAR, 0);
	    }

	    public function identifierList(): ?IdentifierListContext
	    {
	    	return $this->getTypedRuleContext(IdentifierListContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expressionList(): ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ConstDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_constDecl;
	    }

	    public function CONST(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::CONST, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitConstDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_functionDecl;
	    }

	    public function FUNC(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::FUNC, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::ID, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function parameterList(): ?ParameterListContext
	    {
	    	return $this->getTypedRuleContext(ParameterListContext::class, 0);
	    }

	    public function returnType(): ?ReturnTypeContext
	    {
	    	return $this->getTypedRuleContext(ReturnTypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitFunctionDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParameterListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_parameterList;
	    }

	    /**
	     * @return array<ParameterContext>|ParameterContext|null
	     */
	    public function parameter(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParameterContext::class);
	    	}

	        return $this->getTypedRuleContext(ParameterContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitParameterList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParameterContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_parameter;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitParameter($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_returnType;
	    }

	    /**
	     * @return array<TypeContext>|TypeContext|null
	     */
	    public function type(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TypeContext::class);
	    	}

	        return $this->getTypedRuleContext(TypeContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitReturnType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_type;
	    }

	    public function basicType(): ?BasicTypeContext
	    {
	    	return $this->getTypedRuleContext(BasicTypeContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BasicTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_basicType;
	    }

	    public function INT32(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::INT32, 0);
	    }

	    public function FLOAT32(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::FLOAT32, 0);
	    }

	    public function BOOL_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::BOOL_TYPE, 0);
	    }

	    public function RUNE(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::RUNE, 0);
	    }

	    public function STRING_TYPE(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::STRING_TYPE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitBasicType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_block;
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_statement;
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

	    public function simpleStmt(): ?SimpleStmtContext
	    {
	    	return $this->getTypedRuleContext(SimpleStmtContext::class, 0);
	    }

	    public function returnStmt(): ?ReturnStmtContext
	    {
	    	return $this->getTypedRuleContext(ReturnStmtContext::class, 0);
	    }

	    public function breakStmt(): ?BreakStmtContext
	    {
	    	return $this->getTypedRuleContext(BreakStmtContext::class, 0);
	    }

	    public function continueStmt(): ?ContinueStmtContext
	    {
	    	return $this->getTypedRuleContext(ContinueStmtContext::class, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

	    public function switchStmt(): ?SwitchStmtContext
	    {
	    	return $this->getTypedRuleContext(SwitchStmtContext::class, 0);
	    }

	    public function forStmt(): ?ForStmtContext
	    {
	    	return $this->getTypedRuleContext(ForStmtContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SimpleStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_simpleStmt;
	    }

	    public function shortVarDecl(): ?ShortVarDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclContext::class, 0);
	    }

	    public function assignment(): ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function incDecStmt(): ?IncDecStmtContext
	    {
	    	return $this->getTypedRuleContext(IncDecStmtContext::class, 0);
	    }

	    public function expressionStmt(): ?ExpressionStmtContext
	    {
	    	return $this->getTypedRuleContext(ExpressionStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitSimpleStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ShortVarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_shortVarDecl;
	    }

	    public function identifierList(): ?IdentifierListContext
	    {
	    	return $this->getTypedRuleContext(IdentifierListContext::class, 0);
	    }

	    public function expressionList(): ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitShortVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignmentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_assignment;
	    }

	    /**
	     * @return array<ExpressionListContext>|ExpressionListContext|null
	     */
	    public function expressionList(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionListContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionListContext::class, $index);
	    }

	    public function assignOp(): ?AssignOpContext
	    {
	    	return $this->getTypedRuleContext(AssignOpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_assignOp;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitAssignOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IncDecStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_incDecStmt;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitIncDecStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_expressionStmt;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitExpressionStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_returnStmt;
	    }

	    public function RETURN(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::RETURN, 0);
	    }

	    public function expressionList(): ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BreakStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_breakStmt;
	    }

	    public function BREAK(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::BREAK, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitBreakStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ContinueStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_continueStmt;
	    }

	    public function CONTINUE(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::CONTINUE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitContinueStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_ifStmt;
	    }

	    public function IF(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::IF, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    public function ELSE(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::ELSE, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitIfStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_switchStmt;
	    }

	    public function SWITCH(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::SWITCH, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<CaseClauseContext>|CaseClauseContext|null
	     */
	    public function caseClause(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CaseClauseContext::class);
	    	}

	        return $this->getTypedRuleContext(CaseClauseContext::class, $index);
	    }

	    public function defaultClause(): ?DefaultClauseContext
	    {
	    	return $this->getTypedRuleContext(DefaultClauseContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitSwitchStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CaseClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_caseClause;
	    }

	    public function CASE(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::CASE, 0);
	    }

	    public function expressionList(): ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitCaseClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DefaultClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_defaultClause;
	    }

	    public function DEFAULT(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::DEFAULT, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitDefaultClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_forStmt;
	    }

	    public function FOR(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::FOR, 0);
	    }

	    public function forClause(): ?ForClauseContext
	    {
	    	return $this->getTypedRuleContext(ForClauseContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitForStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_forClause;
	    }

	    /**
	     * @return array<SimpleStmtContext>|SimpleStmtContext|null
	     */
	    public function simpleStmt(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(SimpleStmtContext::class);
	    	}

	        return $this->getTypedRuleContext(SimpleStmtContext::class, $index);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitForClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_expression;
	    }

	    public function unaryExpr(): ?UnaryExprContext
	    {
	    	return $this->getTypedRuleContext(UnaryExprContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function binaryOp(): ?BinaryOpContext
	    {
	    	return $this->getTypedRuleContext(BinaryOpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitExpression($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class UnaryExprContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_unaryExpr;
	    }

	    public function primaryExpr(): ?PrimaryExprContext
	    {
	    	return $this->getTypedRuleContext(PrimaryExprContext::class, 0);
	    }

	    public function unaryOp(): ?UnaryOpContext
	    {
	    	return $this->getTypedRuleContext(UnaryOpContext::class, 0);
	    }

	    public function unaryExpr(): ?UnaryExprContext
	    {
	    	return $this->getTypedRuleContext(UnaryExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitUnaryExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BinaryOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_binaryOp;
	    }

	    public function relOp(): ?RelOpContext
	    {
	    	return $this->getTypedRuleContext(RelOpContext::class, 0);
	    }

	    public function addOp(): ?AddOpContext
	    {
	    	return $this->getTypedRuleContext(AddOpContext::class, 0);
	    }

	    public function mulOp(): ?MulOpContext
	    {
	    	return $this->getTypedRuleContext(MulOpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitBinaryOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class RelOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_relOp;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitRelOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AddOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_addOp;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitAddOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class MulOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_mulOp;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitMulOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class UnaryOpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_unaryOp;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitUnaryOp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PrimaryExprContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_primaryExpr;
	    }

	    public function operand(): ?OperandContext
	    {
	    	return $this->getTypedRuleContext(OperandContext::class, 0);
	    }

	    public function basicType(): ?BasicTypeContext
	    {
	    	return $this->getTypedRuleContext(BasicTypeContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function primaryExpr(): ?PrimaryExprContext
	    {
	    	return $this->getTypedRuleContext(PrimaryExprContext::class, 0);
	    }

	    public function expressionList(): ?ExpressionListContext
	    {
	    	return $this->getTypedRuleContext(ExpressionListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitPrimaryExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperandContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_operand;
	    }

	    public function literal(): ?LiteralContext
	    {
	    	return $this->getTypedRuleContext(LiteralContext::class, 0);
	    }

	    public function qualifiedIdent(): ?QualifiedIdentContext
	    {
	    	return $this->getTypedRuleContext(QualifiedIdentContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitOperand($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class QualifiedIdentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_qualifiedIdent;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GrammarParser::ID);
	    	}

	        return $this->getToken(GrammarParser::ID, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitQualifiedIdent($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_literal;
	    }

	    public function basicLiteral(): ?BasicLiteralContext
	    {
	    	return $this->getTypedRuleContext(BasicLiteralContext::class, 0);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BasicLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_basicLiteral;
	    }

	    public function INT_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::INT_LIT, 0);
	    }

	    public function FLOAT_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::FLOAT_LIT, 0);
	    }

	    public function STRING_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::STRING_LIT, 0);
	    }

	    public function RUNE_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::RUNE_LIT, 0);
	    }

	    public function BOOL_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::BOOL_LIT, 0);
	    }

	    public function NIL(): ?TerminalNode
	    {
	        return $this->getToken(GrammarParser::NIL, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitBasicLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_arrayLiteral;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function arrayElements(): ?ArrayElementsContext
	    {
	    	return $this->getTypedRuleContext(ArrayElementsContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitArrayLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayElementsContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_arrayElements;
	    }

	    /**
	     * @return array<ArrayElementContext>|ArrayElementContext|null
	     */
	    public function arrayElement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ArrayElementContext::class);
	    	}

	        return $this->getTypedRuleContext(ArrayElementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitArrayElements($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayElementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_arrayElement;
	    }

	    public function arrayElements(): ?ArrayElementsContext
	    {
	    	return $this->getTypedRuleContext(ArrayElementsContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitArrayElement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IdentifierListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_identifierList;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GrammarParser::ID);
	    	}

	        return $this->getToken(GrammarParser::ID, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitIdentifierList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GrammarParser::RULE_expressionList;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GrammarVisitor) {
			    return $visitor->visitExpressionList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}