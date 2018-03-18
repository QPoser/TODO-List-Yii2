<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.03.2018
 * Time: 12:11
 */

namespace app\repositories;


use app\models\App\Deal;

class DealRepository
{

    public function get($id): Deal
    {
        if (!$deal = Deal::findOne($id)) {
            throw new \DomainException('Task is not found');
        }
        return $deal;
    }

    public function save(Deal $deal): void
    {
        if (!$deal->save()) {
            throw new \RuntimeException('Saving error');
        }
    }

    public function remove(Deal $deal): void
    {
        if (!$deal->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}