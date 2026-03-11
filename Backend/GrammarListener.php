<?php

/*
 * Generated from Grammar.g4 by ANTLR 4.13.2
 */

use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;

/**
 * This interface defines a complete listener for a parse tree produced by
 * {@see GrammarParser}.
 */
interface GrammarListener extends ParseTreeListener {
	/**
	 * Enter a parse tree produced by {@see GrammarParser::program()}.
	 * @param $context The parse tree.
	 */
	public function enterProgram(Context\ProgramContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::program()}.
	 * @param $context The parse tree.
	 */
	public function exitProgram(Context\ProgramContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::declaration()}.
	 * @param $context The parse tree.
	 */
	public function enterDeclaration(Context\DeclarationContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::declaration()}.
	 * @param $context The parse tree.
	 */
	public function exitDeclaration(Context\DeclarationContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::varDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterVarDecl(Context\VarDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::varDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitVarDecl(Context\VarDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::constDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterConstDecl(Context\ConstDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::constDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitConstDecl(Context\ConstDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::functionDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionDecl(Context\FunctionDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::functionDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionDecl(Context\FunctionDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::parameterList()}.
	 * @param $context The parse tree.
	 */
	public function enterParameterList(Context\ParameterListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::parameterList()}.
	 * @param $context The parse tree.
	 */
	public function exitParameterList(Context\ParameterListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::parameter()}.
	 * @param $context The parse tree.
	 */
	public function enterParameter(Context\ParameterContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::parameter()}.
	 * @param $context The parse tree.
	 */
	public function exitParameter(Context\ParameterContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::returnType()}.
	 * @param $context The parse tree.
	 */
	public function enterReturnType(Context\ReturnTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::returnType()}.
	 * @param $context The parse tree.
	 */
	public function exitReturnType(Context\ReturnTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::type()}.
	 * @param $context The parse tree.
	 */
	public function enterType(Context\TypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::type()}.
	 * @param $context The parse tree.
	 */
	public function exitType(Context\TypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::basicType()}.
	 * @param $context The parse tree.
	 */
	public function enterBasicType(Context\BasicTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::basicType()}.
	 * @param $context The parse tree.
	 */
	public function exitBasicType(Context\BasicTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::block()}.
	 * @param $context The parse tree.
	 */
	public function enterBlock(Context\BlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::block()}.
	 * @param $context The parse tree.
	 */
	public function exitBlock(Context\BlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::statementList()}.
	 * @param $context The parse tree.
	 */
	public function enterStatementList(Context\StatementListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::statementList()}.
	 * @param $context The parse tree.
	 */
	public function exitStatementList(Context\StatementListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStatement(Context\StatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStatement(Context\StatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::simpleStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleStmt(Context\SimpleStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::simpleStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleStmt(Context\SimpleStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::shortVarDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterShortVarDecl(Context\ShortVarDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::shortVarDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitShortVarDecl(Context\ShortVarDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::assignment()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignment(Context\AssignmentContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::assignment()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignment(Context\AssignmentContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::assignOp()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignOp(Context\AssignOpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::assignOp()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignOp(Context\AssignOpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::expressionStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterExpressionStmt(Context\ExpressionStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::expressionStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitExpressionStmt(Context\ExpressionStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::returnStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterReturnStmt(Context\ReturnStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::returnStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitReturnStmt(Context\ReturnStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::breakStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterBreakStmt(Context\BreakStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::breakStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitBreakStmt(Context\BreakStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::continueStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterContinueStmt(Context\ContinueStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::continueStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitContinueStmt(Context\ContinueStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::ifStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterIfStmt(Context\IfStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::ifStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitIfStmt(Context\IfStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::switchStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterSwitchStmt(Context\SwitchStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::switchStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitSwitchStmt(Context\SwitchStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::caseClause()}.
	 * @param $context The parse tree.
	 */
	public function enterCaseClause(Context\CaseClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::caseClause()}.
	 * @param $context The parse tree.
	 */
	public function exitCaseClause(Context\CaseClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::defaultClause()}.
	 * @param $context The parse tree.
	 */
	public function enterDefaultClause(Context\DefaultClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::defaultClause()}.
	 * @param $context The parse tree.
	 */
	public function exitDefaultClause(Context\DefaultClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::forStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterForStmt(Context\ForStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::forStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitForStmt(Context\ForStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExpression(Context\ExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExpression(Context\ExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::unaryExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterUnaryExpr(Context\UnaryExprContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::unaryExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitUnaryExpr(Context\UnaryExprContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::binaryOp()}.
	 * @param $context The parse tree.
	 */
	public function enterBinaryOp(Context\BinaryOpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::binaryOp()}.
	 * @param $context The parse tree.
	 */
	public function exitBinaryOp(Context\BinaryOpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::relOp()}.
	 * @param $context The parse tree.
	 */
	public function enterRelOp(Context\RelOpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::relOp()}.
	 * @param $context The parse tree.
	 */
	public function exitRelOp(Context\RelOpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::addOp()}.
	 * @param $context The parse tree.
	 */
	public function enterAddOp(Context\AddOpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::addOp()}.
	 * @param $context The parse tree.
	 */
	public function exitAddOp(Context\AddOpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::mulOp()}.
	 * @param $context The parse tree.
	 */
	public function enterMulOp(Context\MulOpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::mulOp()}.
	 * @param $context The parse tree.
	 */
	public function exitMulOp(Context\MulOpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::unaryOp()}.
	 * @param $context The parse tree.
	 */
	public function enterUnaryOp(Context\UnaryOpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::unaryOp()}.
	 * @param $context The parse tree.
	 */
	public function exitUnaryOp(Context\UnaryOpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::primaryExpr()}.
	 * @param $context The parse tree.
	 */
	public function enterPrimaryExpr(Context\PrimaryExprContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::primaryExpr()}.
	 * @param $context The parse tree.
	 */
	public function exitPrimaryExpr(Context\PrimaryExprContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::operand()}.
	 * @param $context The parse tree.
	 */
	public function enterOperand(Context\OperandContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::operand()}.
	 * @param $context The parse tree.
	 */
	public function exitOperand(Context\OperandContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::qualifiedIdent()}.
	 * @param $context The parse tree.
	 */
	public function enterQualifiedIdent(Context\QualifiedIdentContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::qualifiedIdent()}.
	 * @param $context The parse tree.
	 */
	public function exitQualifiedIdent(Context\QualifiedIdentContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::actualArgs()}.
	 * @param $context The parse tree.
	 */
	public function enterActualArgs(Context\ActualArgsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::actualArgs()}.
	 * @param $context The parse tree.
	 */
	public function exitActualArgs(Context\ActualArgsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::literal()}.
	 * @param $context The parse tree.
	 */
	public function enterLiteral(Context\LiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::literal()}.
	 * @param $context The parse tree.
	 */
	public function exitLiteral(Context\LiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::basicLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterBasicLiteral(Context\BasicLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::basicLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitBasicLiteral(Context\BasicLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::arrayLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayLiteral(Context\ArrayLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::arrayLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayLiteral(Context\ArrayLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::identifierList()}.
	 * @param $context The parse tree.
	 */
	public function enterIdentifierList(Context\IdentifierListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::identifierList()}.
	 * @param $context The parse tree.
	 */
	public function exitIdentifierList(Context\IdentifierListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GrammarParser::expressionList()}.
	 * @param $context The parse tree.
	 */
	public function enterExpressionList(Context\ExpressionListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GrammarParser::expressionList()}.
	 * @param $context The parse tree.
	 */
	public function exitExpressionList(Context\ExpressionListContext $context): void;
}