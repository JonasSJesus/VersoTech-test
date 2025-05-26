-- Retornar os vendedores ativos organizados por nome em ordem alfabetica:
SELECT id_vendedor, nome, salario FROM vendedores WHERE inativo = false ORDER BY nome ASC;

-- Funcionários com Salário Acima da Média:
SELECT id_vendedor, nome, salario
FROM vendedores
WHERE salario > (SELECT AVG(salario) FROM vendedores)
ORDER BY salario DESC;

-- Resumo por cliente, query para listar os clientes e seus pedidos
SELECT 
    c.id_cliente,
    c.razao_social,
    COALESCE(SUM(p.valor_total), 0) AS total
FROM 
    clientes c
LEFT JOIN 
    pedido p ON p.id_cliente = c.id_cliente
GROUP BY 
    c.id_cliente, c.razao_social
ORDER BY 
    total DESC;

-- Situacao por pedido
SELECT
    id_pedido,
    valor_total,
    data_emissao,
    CASE
        WHEN data_cancelamento IS NOT NULL THEN 'CANCELADO'
        WHEN data_faturamento IS NOT NULL THEN 'FATURADO'
        ELSE 'PENDENTE'
    END AS situacao
FROM
    pedido
ORDER BY
    id_pedido;

-- Produtos mais vendidos
SELECT 
    id_produto,
    SUM(quantidade) AS quantidade_vendida,
    SUM(quantidade * preco_praticado) AS total_vendido,
    COUNT(DISTINCT p.id_cliente) AS clientes,
    COUNT(DISTINCT i.id_pedido) AS pedidos
FROM 
    itens_pedido i
JOIN 
    pedido p ON p.id_pedido = i.id_pedido
GROUP BY 
    id_produto
ORDER BY 
    quantidade_vendida DESC,
    total_vendido DESC
LIMIT 1;

