<?php

/**
 * Description of QueryBuilders
 *
 * @author Fernando
 */

class QueryBuilders {
    public static function get_order_history_by_restauant_id(){
        $qb['select'] = 'p.id, p.data';
        $from['pedido'] = 'p';
        $qb['from'] = $from;
        
        $qb['where'] = 'p.restaurante = :id AND p.status = 4';
        
        return $qb;
    }
}
