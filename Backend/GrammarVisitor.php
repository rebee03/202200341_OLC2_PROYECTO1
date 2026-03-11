<?php

/*
 * Generated from Grammar.g4 by ANTLR 4.13.2
 */

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see GrammarParser}.
 */
interface GrammarVisitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see GrammarParser::program()}.
	 *
	 * @param Context\ProgramContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitProgram(Context\ProgramContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::declaration()}.
	 *
	 * @param Context\DeclarationContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclaration(Context\DeclarationContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::varDecl()}.
	 *
	 * @param Context\VarDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarDecl(Context\VarDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::constDecl()}.
	 *
	 * @param Context\ConstDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitConstDecl(Context\ConstDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::functionDecl()}.
	 *
	 * @param Context\FunctionDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFunctionDecl(Context\FunctionDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::parameterList()}.
	 *
	 * @param Context\ParameterListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParameterList(Context\ParameterListContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::parameter()}.
	 *
	 * @param Context\ParameterContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParameter(Context\ParameterContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::returnType()}.
	 *
	 * @param Context\ReturnTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnType(Context\ReturnTypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::type()}.
	 *
	 * @param Context\TypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitType(Context\TypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::basicType()}.
	 *
	 * @param Context\BasicTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBasicType(Context\BasicTypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::block()}.
	 *
	 * @param Context\BlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBlock(Context\BlockContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::statementList()}.
	 *
	 * @param Context\StatementListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatementList(Context\StatementListContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::statement()}.
	 *
	 * @param Context\StatementContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatement(Context\StatementContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::simpleStmt()}.
	 *
	 * @param Context\SimpleStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSimpleStmt(Context\SimpleStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::shortVarDecl()}.
	 *
	 * @param Context\ShortVarDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitShortVarDecl(Context\ShortVarDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::assignment()}.
	 *
	 * @param Context\AssignmentContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignment(Context\AssignmentContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::assignOp()}.
	 *
	 * @param Context\AssignOpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignOp(Context\AssignOpContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::expressionStmt()}.
	 *
	 * @param Context\ExpressionStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpressionStmt(Context\ExpressionStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::returnStmt()}.
	 *
	 * @param Context\ReturnStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnStmt(Context\ReturnStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::breakStmt()}.
	 *
	 * @param Context\BreakStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBreakStmt(Context\BreakStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::continueStmt()}.
	 *
	 * @param Context\ContinueStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitContinueStmt(Context\ContinueStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::ifStmt()}.
	 *
	 * @param Context\IfStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIfStmt(Context\IfStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::switchStmt()}.
	 *
	 * @param Context\SwitchStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSwitchStmt(Context\SwitchStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::caseClause()}.
	 *
	 * @param Context\CaseClauseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitCaseClause(Context\CaseClauseContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::defaultClause()}.
	 *
	 * @param Context\DefaultClauseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDefaultClause(Context\DefaultClauseContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::forStmt()}.
	 *
	 * @param Context\ForStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForStmt(Context\ForStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::expression()}.
	 *
	 * @param Context\ExpressionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpression(Context\ExpressionContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::unaryExpr()}.
	 *
	 * @param Context\UnaryExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitUnaryExpr(Context\UnaryExprContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::binaryOp()}.
	 *
	 * @param Context\BinaryOpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBinaryOp(Context\BinaryOpContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::relOp()}.
	 *
	 * @param Context\RelOpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitRelOp(Context\RelOpContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::addOp()}.
	 *
	 * @param Context\AddOpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAddOp(Context\AddOpContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::mulOp()}.
	 *
	 * @param Context\MulOpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitMulOp(Context\MulOpContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::unaryOp()}.
	 *
	 * @param Context\UnaryOpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitUnaryOp(Context\UnaryOpContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::primaryExpr()}.
	 *
	 * @param Context\PrimaryExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitPrimaryExpr(Context\PrimaryExprContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::operand()}.
	 *
	 * @param Context\OperandContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperand(Context\OperandContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::qualifiedIdent()}.
	 *
	 * @param Context\QualifiedIdentContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitQualifiedIdent(Context\QualifiedIdentContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::actualArgs()}.
	 *
	 * @param Context\ActualArgsContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitActualArgs(Context\ActualArgsContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::literal()}.
	 *
	 * @param Context\LiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLiteral(Context\LiteralContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::basicLiteral()}.
	 *
	 * @param Context\BasicLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBasicLiteral(Context\BasicLiteralContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::arrayLiteral()}.
	 *
	 * @param Context\ArrayLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayLiteral(Context\ArrayLiteralContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::identifierList()}.
	 *
	 * @param Context\IdentifierListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIdentifierList(Context\IdentifierListContext $context);

	/**
	 * Visit a parse tree produced by {@see GrammarParser::expressionList()}.
	 *
	 * @param Context\ExpressionListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpressionList(Context\ExpressionListContext $context);
}