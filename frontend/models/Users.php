<?php


namespace frontend\models;


//use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;

class Users extends ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function insertUser(array $userdata)
    {
        $name = $userdata['name'];
        $city_id = $userdata['city_id'];
        $time_now = time();

        Yii::$app->db->createCommand()->insert('users', [
            'name' => $name,
            'city_id' => $city_id,
            'created_at' => $time_now,
            'updated_at' => $time_now,
        ])->execute();

        return self::getLastUserId();
    }

    public static function getLastUserId()
    {
        $sql = "
        SELECT id 
        FROM users 
        ORDER BY id DESC
        LIMIT 1";

        return Yii::$app->db->createCommand($sql)
            ->queryOne()['id'];
    }

    public function rules()
    {
        return [
            [['name'], 'string'],
            [['city_id'], 'integer'],
        ];
    }

    public static function tableName()
    {
        return '{{users}}';
    }

    public static function getUsersOrderById($orderBy = 'DESC')
    {
        $sql = "
        SELECT id, name, city_id
        FROM users 
        ORDER BY id " . $orderBy;

        /*$users = Yii::$app->db->createCommand($sql)
            ->queryAll();*/

        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function getUsersList()
    {
        $sql = "SELECT name  FROM users";
        $users = Yii::$app->db->createCommand($sql)->queryAll();

        $list = [];
        foreach ($users as $user) {
            $list[] = $user['name'];
        }

        return $list;
    }


    public static function isDublicate0($name)
    {
        $sql = "SELECT 1 FROM users WHERE name=:name LIMIT 1";
        $result = Yii::$app->db->createCommand($sql)
            ->bindValue(':name', $name)
            ->queryOne();
        //return empty($result) ? true : false;
        return empty($result) ? false : true;
    }

    public static function isDublicate($list, $name)
    {
        return in_array($name, $list) ? true : false;
    }

    public static function generateRandomUserName()
    {
        $listFirstNames = self::listFirstNames();
        $listLastNames = self::listLastNames();

        $random = rand(0, sizeof($listFirstNames) - 1);
        $firstName = $listFirstNames[$random];

        $random = rand(0, sizeof($listLastNames) - 1);
        $lastName = $listLastNames[$random];

        return $lastName . " " . $firstName;
    }

    public static function getRandomUserName()
    {
        $list = self::getUsersList();
        $userName = self::generateRandomUserName();
        while (in_array($userName, $list)) {
            $userName = self::generateRandomUserName();
        }
        return $userName;
    }


    public static function listFirstNames()
    {
        return [
            'Anastasia', 'Alex', 'Daemon', 'Max', 'Stephen', 'Anna', 'Maria', 'John', 'Henry',
            'Jack', 'Simon', 'Anthony', 'Daniel', 'Peter', 'David', 'Victor', 'Eric', 'Phil', 'Harry',
            'Paul', 'Juan', 'Marcus', 'Jesse', 'Andreas', 'Fred', 'Bruno', 'Diego', 'Luke', 'Timothy', 'Aaron',
            'James', 'Mason', 'Axel', 'Scott', 'Brandon'
        ];
    }

    public static function listLastNames()
    {
        return [
            'Lindelöf', 'Bailly', 'Jones', 'Maguire', 'Pogba', 'Mata', 'Martial', 'Rashford', 'Grant',
            'Lingard', 'Pereira', 'Andreas', 'Fernandes', 'Dalot', 'James', 'Romero', 'Shaw', 'Greenwood', 'Gomes',
            'Garner', 'McTominay', 'Williams', 'Phelan', 'Carrick', 'Dempsey', 'Pert', 'Hartis', 'Hawkins', 'Gaudino', 'Owen',
            'Clegg', 'Leng', 'Butt', 'Wood', 'Neil', 'Ryan', 'West', 'Mangnall', 'Bentley', 'Robson',
            'Duncan', 'Caretaker', 'McGuinness', 'Docherty', 'Atkinson'
        ];
    }


}