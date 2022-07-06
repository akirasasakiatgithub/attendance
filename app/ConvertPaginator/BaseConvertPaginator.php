<?php

namespace App\ConvertPaginator;

use IteratorAggregate;
use Countable;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * 基底Paginatorラッパークラス
 */
class BaseConvertPaginator implements IteratorAggregate, Countable
{

  /**
   * 元情報
   * @var LengthAwarePaginator
   */
  protected $__originPaginator;

  /**
   * 一覧情報
   * @var array
   */
  protected $details = [];

  /**
   * コンストラクタ
   * @param LengthAwarePaginator $originPaginator
   */
  public function __construct(LengthAwarePaginator $originPaginator)
  {
    // 引数格納
    $this->__originPaginator = $originPaginator;
  }

  /**
   * 本メソッドは該当メソッドが見つからない場合に呼び出されます。
   * @param $method
   * @param $parameters
   * @return mixed
   */
  public function __call($method, $parameters)
  {
    // total等の関数は本来のPaginatorが保持する関数を利用する
    $result = call_user_func_array([$this->__originPaginator, $method], $parameters);
    return $result;
  }

  /**
   * イテレータを取得します。
   * @return \Generator
   */
  public function getIterator()
  {
    foreach ($this->details as $key => $val) {
      yield $key => $val;
    }
  }

  /**
   * 件数を取得します。
   * @return mixed
   */
  public function count():int
  {
    return count($this->details);
  }

  /**
   * 件数の開始位置を取得します。
   */
  public function firstItem()
  {
    // firstItemメソッドは表示件数が0件の場合も「１」を返すため、この対策が必要
    $total = $this->__originPaginator->total();
    if ($total == 0) {
      return 0;
    }
    return $this->__originPaginator->firstItem();
  }
}
