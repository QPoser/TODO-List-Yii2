<?php
namespace app\forms\App\Search;

use app\models\App\Deal;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 25.03.2018
 * Time: 18:11
 */
class DealSearch extends Model
{

    const TODAY = 3600 * 24;
    const WEEKLY = 3600 * 24 * 7;

    public $id;
    public $name;
    public $date;

    public function rules(): array
    {
        return [
            ['id', 'integer'],
            [['date', 'name'], 'string']
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Deal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['complete' => SORT_ASC, 'priority' => SORT_DESC, 'promptly' => SORT_DESC, 'id' => SORT_DESC]
            ],
            'pagination' => ['pageSize' => 15]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        switch ($params['date']) {
            case 'today':
                $query
                    ->andFilterWhere(['>', 'end_date', strtotime('today GMT')])
                    ->andFilterWhere(['<', 'end_date', strtotime('today GMT') + self::TODAY]);
                break;

            case 'weekly':
                $query
                    ->andFilterWhere(['>', 'end_date', strtotime('today GMT')])
                    ->andFilterWhere(['<', 'end_date', strtotime('today GMT') + self::WEEKLY]);
                break;

            default:
                break;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;

    }



}