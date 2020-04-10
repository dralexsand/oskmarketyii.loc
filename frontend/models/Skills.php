<?php


namespace frontend\models;


//use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;

class Skills extends ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function rules()
    {
        return [
            [['name'], 'string'],
            [['id'], 'integer'],
        ];
    }

    public static function tableName()
    {
        return '{{skills}}';
    }

    public static function getRandomSkills()
    {
        $sql = "SELECT id FROM skills";

        $skills = Yii::$app->db->createCommand($sql)
            ->queryAll();

        $random_amount_skills = rand(0, sizeof($skills) - 1);

        if($random_amount_skills == 0 ) return [];

        $ids = [];
        foreach ($skills as $skill) {
            $ids[] = $skill['id'];
        }

        $skills_ids = [];
        $i = 1;
        while ($i <= $random_amount_skills) {
            $random_i = rand(0, sizeof($ids) - 1);
            $skills_ids[] = $ids[$random_i];
            unset($ids[$random_i]);
            sort($ids);
            $i++;
        }
        return $skills_ids;
    }

}