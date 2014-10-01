<?php

/**
 * Description of Queries
 *
 * @author Fernando
 */
class Queries {

    const LOGIN = 'SELECT c FROM Cliente c WHERE c.email = :email and c.senha = :senha';
    const SEARCH_REST = 'SELECT r FROM restaurante r WHERE r.nome LIKE :nome';
}
