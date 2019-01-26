<?php 

namespace App\Helpers;

trait ModelHelper {
	public function list($where = null, $result = null) {
		$result = $result ?? $this;
		$result = $result->getWhere($where);

		if(isset($where['paginate']) && is_int($where['paginate']) && $where['paginate'])
			return $result->paginate($where['paginate']);
		return $result->get();
	}

	protected function getWhere($where= null, $result = null) {
		$result = $result ?? $this;

		//check if featured is set or not
		$result = isset($where['featured']) && is_int($where['featured']) ? $result->where('featured', $where['featured']) : $result;
		
		//check if featured is set or not
		$result = isset($where['gender']) && in_array($where['gender'], ['male', 'female', 'others']) ? $result->where('gender', $where['gender']) : $result;
		
		//check if limit is set or not
		$result = isset($where['limit']) && is_int($where['limit']) ? $result->limit($where['limit']) : $result;
		
		//check if order is set
		$result = isset($where['order']) && in_array($where['order'], ['desc', 'asc', 'DESC', 'ASC']) ? $result->orderBy('created_at', $where['order']) : $result->orderBy('updated_at', 'DESC');
		$k=0;
		if(isset($where['like']) && is_array($where['like']) && count($where['like']))
			foreach ($where['like'] as $key => $value) {
				$result = $k==0 ? $result->where($key, "LIKE", "%" . $value . "%") : $result->orWhere($key, "LIKE", "%" . $value . "%");
				$k++;
			}
		// dd($result->toSql());
		return $result;
	}

	public function toggleStatus($column = 'status') {
		$this->$column = !$this->$column;
		return $this->save();
	}

	public function shortDescription($text, $length = 200) {
		return strlen($text) > $length ? trim(substr($text, 0, $length))."..." : $text;
	}

	public function enabledDisabled($i) {
		return $i === 1  ? "Enabled" : "Disabled";
	}
}