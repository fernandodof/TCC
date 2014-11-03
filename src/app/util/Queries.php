<?php

/**
 * Description of Queries
 *
 * @author Fernando
 */
class Queries {

    const LOGIN = 'SELECT c FROM Cliente c WHERE c.email = :email and c.senha = :senha';
    const SEARCH_REST_NOME = 'SELECT r FROM restaurante r WHERE r.nome LIKE :nome';
    const SEARCH_REST_CEP = 'SELECT r FROM restaurante r JOIN r.endereco e WITH e.cep LIKE :nome';
    const SEARCH_REST_NOME_TIPO = 'SELECT r FROM restaurante r JOIN r.endereco e JOIN r.tipo t WHERE r.nome LIKE :nome AND t.nome LIKE :tipo';
    const SEARCH_REST_CEP_TIPO = 'SELECT r FROM restaurante r JOIN r.endereco e JOIN r.tipo t WHERE e.cep LIKE :nome AND t.nome LIKE :tipo';
    const LOGIN_FUNCIONARIO = 'SELECT f FROM funcionario f WHERE f.login = :login and f.senha = :senha';
    const TIPOS_RESTAURANTE_DISTINCT = 'SELECT DISTINCT t.nome FROM tiporestaurante t';
    const PRODUTOS_RESTAURANTE = '';
}


//SELECT * FROM restaurante r 
//INNER JOIN restaurante_tipo rt ON r.id = rt.id_restaurante
//INNER JOIN tipoRestaurante t ON rt.id_tipo = t.id
//WHERE r.nome = 'Tarandela 3' AND
//t.nome = 'Pizzaria';