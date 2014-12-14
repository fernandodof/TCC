<?php

/**
 * Description of Queries
 *
 * @author Fernando
 */
class Queries {

    const LOGIN_COM_EMAIl = 'SELECT c FROM Cliente c WHERE c.email = :email AND c.senha = :senha';
    const LOGIN_COM_LOGIN = 'SELECT c FROM Cliente c WHERE c.login = :login AND c.senha = :senha';
    const SEARCH_REST_NOME = 'SELECT r FROM restaurante r WHERE r.nome LIKE :nome';
    const SEARCH_REST_CEP = 'SELECT r FROM restaurante r JOIN r.endereco e WITH e.cep LIKE :nome';
    const SEARCH_REST_NOME_TIPO = 'SELECT r FROM restaurante r JOIN r.endereco e JOIN r.tipo t WHERE r.nome LIKE :nome AND t.nome LIKE :tipo';
    const SEARCH_REST_CEP_TIPO = 'SELECT r FROM restaurante r JOIN r.endereco e JOIN r.tipo t WHERE e.cep LIKE :nome AND t.nome LIKE :tipo';
    const LOGIN_FUNCIONARIO = 'SELECT f FROM funcionario f WHERE f.login = :login and f.senha = :senha';
    const TIPOS_RESTAURANTE_DISTINCT = 'SELECT DISTINCT t.nome FROM tiporestaurante t';
    const GET_NOME_RESTAURANTE_BY_ID = 'SELECT r.nome FROM restaurante r WHERE r.id = :id';
    const GET_PEDIDOS_RESTAURANTE = 'SELECT p FROM pedido p WHERE p.restaurante = :id';
    const GET_PEDIDOS_POR_STATUS_RESTAURANTE = 'SELECT p FROM pedido p WHERE p.restaurante = :id and p.status = :status';
    const GET_PEDIDOS_POR_STATUS_RESTAURANTE_DATA = 'SELECT p FROM pedido p WHERE p.restaurante = :id and p.status = :status and p.dataHora > :dataHora';
    const SET_PEDIDO_STATUS = 'UPDATE pedido p SET p.status = :status WHERE p.id = :id';
    const UPDATE_STATUS_PEDIDO = 'UPDATE pedido p SET p.status = p.status+1 WHERE p.id = :id';
    
    //Native Queries
    const GET_IDS_RESTAURANTES_CLIENTE_COMPROU = 'SELECT DISTINCT p.id_restaurante as id_restaurante FROM pedido p WHERE p.id_cliente = :id_cliente';
    const GET_IDS_PRODUTOS_CLIENTE_COMPROOU = "SELECT DISTINCT ip.id_produto as id_produto FROM pedido p INNER JOIN pedido_itempedido pIt ON p.id = pIt.id_Pedido INNER JOIN itempedido ip ON pIt.id_itemPedido = ip.id INNER JOIN produto pr ON pr.id = ip.id_produto INNER JOIN categoria c ON c.id = pr.id_categoria WHERE c.nome LIKE 'comida' AND p.id_cliente = :id_cliente";
    const GET_NOTA_CLINTE_RESTAURANTE = 'SELECT id, nota FROM avaliacao WHERE id_cliente = :id_cliente and id_restaurante = :id_restaurante';
    const GET_NOTA_CLINTE_PRODUTO = 'SELECT id, nota FROM avaliacao WHERE id_cliente = :id_cliente and id_produto = :id_produto';
    const GET_RESTAURANTE_RAIO = 'SELECT r.id, (6371 * acos(cos(radians(:latitude)) * cos(radians(e.latitude)) * cos(radians(e.longitude) - radians(:longitude)) + sin(radians(:latitude)) * sin(radians(e.latitude)))) AS distance FROM restaurante R INNER JOIN endereco E ON r.id_endereco = e.id HAVING distance < :raio ORDER BY distance';
    const GET_RESTAURANTE_RAIO_TIPO = 'SELECT r.id, (6371 * acos(cos(radians(:latitude)) * cos(radians(e.latitude)) * cos(radians(e.longitude) - radians(:longitude)) + sin(radians(:latitude)) * sin(radians(e.latitude)))) AS distance FROM restaurante R INNER JOIN endereco E ON r.id_endereco = e.id INNER JOIN tiporestaurante t ON r.id_tipo = t.id WHERE t.nome LIKE :tipo HAVING distance < :raio ORDER BY distance';
    const GET_RESTAURANTE_RAIO_ORDER_BY_AVALIACAO_E_RAIO = 'SELECT r.id, AVG (a.nota), (6371 * acos(cos(radians(:latitude)) * cos(radians(e.latitude)) * cos(radians(e.longitude) - radians(:longitude)) + sin(radians(:latitude)) * sin(radians(e.latitude)))) AS distance FROM restaurante R INNER JOIN endereco E ON r.id_endereco = e.id LEFT JOIN avaliacao a ON r.id = a.id_restaurante GROUP BY r.id ORDER BY AVG(a.nota) DESC, distance';
    const GET_RESTAURANTE_RAIO_TIPO_ORDER_BY_AVALIACAO_E_RAIO = 'SELECT r.id, AVG (a.nota), (6371 * acos(cos(radians(:latitude)) * cos(radians(e.latitude)) * cos(radians(e.longitude) - radians(:longitude)) + sin(radians(:latitude)) * sin(radians(e.latitude)))) AS distance FROM restaurante R INNER JOIN endereco E ON r.id_endereco = e.id INNER JOIN tiporestaurante t ON r.id_tipo = t.id LEFT JOIN avaliacao a ON r.id = a.id_restaurante WHERE t.nome LIKE :tipo GROUP BY r.id ORDER BY AVG(a.nota) DESC, distance';
    const GET_RESTAURANTE_ORDER_BY_AVALIACAO = 'SELECT r.id, AVG (a.nota) FROM restaurante R LEFT JOIN avaliacao a ON r.id = a.id_restaurante GROUP BY r.id ORDER BY AVG(a.nota) DESC';
    const GET_RESTAURANTE_TIPO_ORDER_BY_AVALIACAO = 'SELECT r.id, AVG (a.nota) FROM restaurante R INNER JOIN tiporestaurante t ON r.id_tipo = t.id LEFT JOIN avaliacao a ON r.id = a.id_restaurante WHERE t.nome LIKE :tipo GROUP BY r.id ORDER BY AVG(a.nota) DESC';
    
}
