<?php

namespace App\ConvertPaginator;

use App\ConvertPaginator\BaseConvertPaginator;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Paginator情報を検索結果モデル情報に変換します。
 */
class ConvertPaginatorToSearchResultModel extends BaseConvertPaginator {

    /**
     * コンストラクタ
     * @param LengthAwarePaginator $originPaginator
     */
    public function __construct(LengthAwarePaginator $originPaginator)
    {
        // 親コンストラクタ処理実行
        parent::__construct($originPaginator);

        // 初期化処理実行
        $this->init();
    }

    /**
     * 初期化処理を行います。
     */
    private function init()
    {
        $retDetails = [];
        foreach($this->__originPaginator as $detailInfo)
        {
            $table1 = $detailInfo;
            $table2 = $table1->table2;
            $table3 = $table2->table3;

            // 名称
            $name = $table1->name;
            // 距離
            $distance = $table2->distance . "m";
            // 価格
            $price = number_format($table3->price) . "円";

            // 戻り値に追加
            $retDetails[] = (object)[
                // 名称
                'name' => $name,
                // 距離
                'distance' => $distance,
                // 価格
                'price' => $price,
            ];
        }

        // 格納
        $this->details = $retDetails;
    }
}