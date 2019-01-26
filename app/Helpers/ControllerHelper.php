<?php 

namespace App\Helpers;

trait ControllerHelper {
	public function list($where = null) {
		$result = $this;

		//check if limit is set or not
		isset($where['limit']) && is_int($where['limit']) && $where['limit'] ? $result->limit($where['limit']) : null;
		
		//check if order is set
		isset($where['order']) && in_array($where['order'], ['desc', 'asc', 'DESC', 'ASC']) ? $result->orderBy('created_at', $where['order']) : null;

		return $result->get();
	}
}