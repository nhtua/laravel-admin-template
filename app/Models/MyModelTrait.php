<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

trait MyModelTrait
{
  public function isNew()
  {
    return null === $this->id;
  }
	public function getThumbBySize($value=128, $imgCol = 'thumbnail')
  {    
    if ($this[$imgCol] === null)
      return "/backend/images/placeholder.png";
    $sizes = explode(',', trim(env('IMAGE_SIZES')) );
    $pieces = explode(".", $this[$imgCol]);    
    foreach ($sizes as $size) {
      if ($value >= $size) {        
        return $this[$imgCol].".".$size.".".$pieces[count($pieces) - 1];        
      }
    }
    return $this[$imgCol];
  }
  public function sumAttr($requestData) {
    $requestData = null === $requestData ? [] : $requestData;
    $sum = 0;    
    foreach ($requestData as $value) {
      $sum += $value;
    }
    $this->attr = $sum;
    return $this->attr;
  }

  /**
   * Hàm chuyển đổi giá trị attr lưu trong db thành mảng các attributes ở tầng logic
   * @return Array Mảng chứa các attributes đã bật
   * Ví dụ: 13 -> [1,4,8]
   */
  public function calAttr()
  {
    $base = $this->attr*1;
    $bina = strrev(decbin($base));
    $data =  [];
    for($i = 0; $i < strlen($bina); $i++ )
        if ( $bina[$i] == 1)
            $data[] = pow(2,$i);
    return $data;
  }
}