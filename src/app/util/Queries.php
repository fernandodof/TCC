<?php

/**
 * Description of Queries
 *
 * @author Fernando
 */
class Queries {

    const LOGIN = 'SELECT c FROM Cliente c WHERE c.email = :email and c.senha = :senha';

}
