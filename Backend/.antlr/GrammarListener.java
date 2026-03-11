// Generated from /home/rebeca-torres-del-cid/Escritorio/Proyecto1_OCL2_202200341/Backend/Grammar.g4 by ANTLR 4.13.1
import org.antlr.v4.runtime.tree.ParseTreeListener;

/**
 * This interface defines a complete listener for a parse tree produced by
 * {@link GrammarParser}.
 */
public interface GrammarListener extends ParseTreeListener {
	/**
	 * Enter a parse tree produced by {@link GrammarParser#program}.
	 * @param ctx the parse tree
	 */
	void enterProgram(GrammarParser.ProgramContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#program}.
	 * @param ctx the parse tree
	 */
	void exitProgram(GrammarParser.ProgramContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#declaration}.
	 * @param ctx the parse tree
	 */
	void enterDeclaration(GrammarParser.DeclarationContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#declaration}.
	 * @param ctx the parse tree
	 */
	void exitDeclaration(GrammarParser.DeclarationContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#varDecl}.
	 * @param ctx the parse tree
	 */
	void enterVarDecl(GrammarParser.VarDeclContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#varDecl}.
	 * @param ctx the parse tree
	 */
	void exitVarDecl(GrammarParser.VarDeclContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#constDecl}.
	 * @param ctx the parse tree
	 */
	void enterConstDecl(GrammarParser.ConstDeclContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#constDecl}.
	 * @param ctx the parse tree
	 */
	void exitConstDecl(GrammarParser.ConstDeclContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#functionDecl}.
	 * @param ctx the parse tree
	 */
	void enterFunctionDecl(GrammarParser.FunctionDeclContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#functionDecl}.
	 * @param ctx the parse tree
	 */
	void exitFunctionDecl(GrammarParser.FunctionDeclContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#parameterList}.
	 * @param ctx the parse tree
	 */
	void enterParameterList(GrammarParser.ParameterListContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#parameterList}.
	 * @param ctx the parse tree
	 */
	void exitParameterList(GrammarParser.ParameterListContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#parameter}.
	 * @param ctx the parse tree
	 */
	void enterParameter(GrammarParser.ParameterContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#parameter}.
	 * @param ctx the parse tree
	 */
	void exitParameter(GrammarParser.ParameterContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#returnType}.
	 * @param ctx the parse tree
	 */
	void enterReturnType(GrammarParser.ReturnTypeContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#returnType}.
	 * @param ctx the parse tree
	 */
	void exitReturnType(GrammarParser.ReturnTypeContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#type}.
	 * @param ctx the parse tree
	 */
	void enterType(GrammarParser.TypeContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#type}.
	 * @param ctx the parse tree
	 */
	void exitType(GrammarParser.TypeContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#basicType}.
	 * @param ctx the parse tree
	 */
	void enterBasicType(GrammarParser.BasicTypeContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#basicType}.
	 * @param ctx the parse tree
	 */
	void exitBasicType(GrammarParser.BasicTypeContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#block}.
	 * @param ctx the parse tree
	 */
	void enterBlock(GrammarParser.BlockContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#block}.
	 * @param ctx the parse tree
	 */
	void exitBlock(GrammarParser.BlockContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#statementList}.
	 * @param ctx the parse tree
	 */
	void enterStatementList(GrammarParser.StatementListContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#statementList}.
	 * @param ctx the parse tree
	 */
	void exitStatementList(GrammarParser.StatementListContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterStatement(GrammarParser.StatementContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitStatement(GrammarParser.StatementContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#simpleStmt}.
	 * @param ctx the parse tree
	 */
	void enterSimpleStmt(GrammarParser.SimpleStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#simpleStmt}.
	 * @param ctx the parse tree
	 */
	void exitSimpleStmt(GrammarParser.SimpleStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#shortVarDecl}.
	 * @param ctx the parse tree
	 */
	void enterShortVarDecl(GrammarParser.ShortVarDeclContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#shortVarDecl}.
	 * @param ctx the parse tree
	 */
	void exitShortVarDecl(GrammarParser.ShortVarDeclContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#assignment}.
	 * @param ctx the parse tree
	 */
	void enterAssignment(GrammarParser.AssignmentContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#assignment}.
	 * @param ctx the parse tree
	 */
	void exitAssignment(GrammarParser.AssignmentContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#assignOp}.
	 * @param ctx the parse tree
	 */
	void enterAssignOp(GrammarParser.AssignOpContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#assignOp}.
	 * @param ctx the parse tree
	 */
	void exitAssignOp(GrammarParser.AssignOpContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#expressionStmt}.
	 * @param ctx the parse tree
	 */
	void enterExpressionStmt(GrammarParser.ExpressionStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#expressionStmt}.
	 * @param ctx the parse tree
	 */
	void exitExpressionStmt(GrammarParser.ExpressionStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#returnStmt}.
	 * @param ctx the parse tree
	 */
	void enterReturnStmt(GrammarParser.ReturnStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#returnStmt}.
	 * @param ctx the parse tree
	 */
	void exitReturnStmt(GrammarParser.ReturnStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#breakStmt}.
	 * @param ctx the parse tree
	 */
	void enterBreakStmt(GrammarParser.BreakStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#breakStmt}.
	 * @param ctx the parse tree
	 */
	void exitBreakStmt(GrammarParser.BreakStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#continueStmt}.
	 * @param ctx the parse tree
	 */
	void enterContinueStmt(GrammarParser.ContinueStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#continueStmt}.
	 * @param ctx the parse tree
	 */
	void exitContinueStmt(GrammarParser.ContinueStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#ifStmt}.
	 * @param ctx the parse tree
	 */
	void enterIfStmt(GrammarParser.IfStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#ifStmt}.
	 * @param ctx the parse tree
	 */
	void exitIfStmt(GrammarParser.IfStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#switchStmt}.
	 * @param ctx the parse tree
	 */
	void enterSwitchStmt(GrammarParser.SwitchStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#switchStmt}.
	 * @param ctx the parse tree
	 */
	void exitSwitchStmt(GrammarParser.SwitchStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#caseClause}.
	 * @param ctx the parse tree
	 */
	void enterCaseClause(GrammarParser.CaseClauseContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#caseClause}.
	 * @param ctx the parse tree
	 */
	void exitCaseClause(GrammarParser.CaseClauseContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#defaultClause}.
	 * @param ctx the parse tree
	 */
	void enterDefaultClause(GrammarParser.DefaultClauseContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#defaultClause}.
	 * @param ctx the parse tree
	 */
	void exitDefaultClause(GrammarParser.DefaultClauseContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#forStmt}.
	 * @param ctx the parse tree
	 */
	void enterForStmt(GrammarParser.ForStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#forStmt}.
	 * @param ctx the parse tree
	 */
	void exitForStmt(GrammarParser.ForStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#expression}.
	 * @param ctx the parse tree
	 */
	void enterExpression(GrammarParser.ExpressionContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#expression}.
	 * @param ctx the parse tree
	 */
	void exitExpression(GrammarParser.ExpressionContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#unaryExpr}.
	 * @param ctx the parse tree
	 */
	void enterUnaryExpr(GrammarParser.UnaryExprContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#unaryExpr}.
	 * @param ctx the parse tree
	 */
	void exitUnaryExpr(GrammarParser.UnaryExprContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#binaryOp}.
	 * @param ctx the parse tree
	 */
	void enterBinaryOp(GrammarParser.BinaryOpContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#binaryOp}.
	 * @param ctx the parse tree
	 */
	void exitBinaryOp(GrammarParser.BinaryOpContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#relOp}.
	 * @param ctx the parse tree
	 */
	void enterRelOp(GrammarParser.RelOpContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#relOp}.
	 * @param ctx the parse tree
	 */
	void exitRelOp(GrammarParser.RelOpContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#addOp}.
	 * @param ctx the parse tree
	 */
	void enterAddOp(GrammarParser.AddOpContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#addOp}.
	 * @param ctx the parse tree
	 */
	void exitAddOp(GrammarParser.AddOpContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#mulOp}.
	 * @param ctx the parse tree
	 */
	void enterMulOp(GrammarParser.MulOpContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#mulOp}.
	 * @param ctx the parse tree
	 */
	void exitMulOp(GrammarParser.MulOpContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#unaryOp}.
	 * @param ctx the parse tree
	 */
	void enterUnaryOp(GrammarParser.UnaryOpContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#unaryOp}.
	 * @param ctx the parse tree
	 */
	void exitUnaryOp(GrammarParser.UnaryOpContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#primaryExpr}.
	 * @param ctx the parse tree
	 */
	void enterPrimaryExpr(GrammarParser.PrimaryExprContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#primaryExpr}.
	 * @param ctx the parse tree
	 */
	void exitPrimaryExpr(GrammarParser.PrimaryExprContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#operand}.
	 * @param ctx the parse tree
	 */
	void enterOperand(GrammarParser.OperandContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#operand}.
	 * @param ctx the parse tree
	 */
	void exitOperand(GrammarParser.OperandContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#qualifiedIdent}.
	 * @param ctx the parse tree
	 */
	void enterQualifiedIdent(GrammarParser.QualifiedIdentContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#qualifiedIdent}.
	 * @param ctx the parse tree
	 */
	void exitQualifiedIdent(GrammarParser.QualifiedIdentContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#actualArgs}.
	 * @param ctx the parse tree
	 */
	void enterActualArgs(GrammarParser.ActualArgsContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#actualArgs}.
	 * @param ctx the parse tree
	 */
	void exitActualArgs(GrammarParser.ActualArgsContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#literal}.
	 * @param ctx the parse tree
	 */
	void enterLiteral(GrammarParser.LiteralContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#literal}.
	 * @param ctx the parse tree
	 */
	void exitLiteral(GrammarParser.LiteralContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#basicLiteral}.
	 * @param ctx the parse tree
	 */
	void enterBasicLiteral(GrammarParser.BasicLiteralContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#basicLiteral}.
	 * @param ctx the parse tree
	 */
	void exitBasicLiteral(GrammarParser.BasicLiteralContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#arrayLiteral}.
	 * @param ctx the parse tree
	 */
	void enterArrayLiteral(GrammarParser.ArrayLiteralContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#arrayLiteral}.
	 * @param ctx the parse tree
	 */
	void exitArrayLiteral(GrammarParser.ArrayLiteralContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#identifierList}.
	 * @param ctx the parse tree
	 */
	void enterIdentifierList(GrammarParser.IdentifierListContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#identifierList}.
	 * @param ctx the parse tree
	 */
	void exitIdentifierList(GrammarParser.IdentifierListContext ctx);
	/**
	 * Enter a parse tree produced by {@link GrammarParser#expressionList}.
	 * @param ctx the parse tree
	 */
	void enterExpressionList(GrammarParser.ExpressionListContext ctx);
	/**
	 * Exit a parse tree produced by {@link GrammarParser#expressionList}.
	 * @param ctx the parse tree
	 */
	void exitExpressionList(GrammarParser.ExpressionListContext ctx);
}