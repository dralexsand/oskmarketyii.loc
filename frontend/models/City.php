<?php


namespace frontend\models;


//use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;

class City extends ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function rules()
    {
        return [
            [['name'], 'string'],
        ];
    }

    public static function tableName()
    {
        return '{{city}}';
    }

    public static function getRandomCity()
    {

        $sql = "SELECT id FROM city";

        $cities = Yii::$app->db->createCommand($sql)
            ->queryAll();

        $random = rand(0, sizeof($cities) - 1);

        $ids = [];
        foreach ($cities as $city) {
            $ids[] = $city['id'];
        }
        return $ids[$random];
    }

}