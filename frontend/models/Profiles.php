<?php


namespace frontend\models;


//use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;

class Profiles extends ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['user_id'], 'integer'],
            [['skill_id'], 'integer'],
        ];
    }

    public static function tableName()
    {
        return '{{profiles}}';
    }

    public static function getProfile($user_id)
    {
        $sql = "
        SELECT city.name city, users.name 
        FROM users 
        JOIN city ON city.id=users.city_id
        WHERE users.id=:id 
        LIMIT 1";

        $users_info = Yii::$app->db->createCommand($sql)
            ->bindValue(':id', $user_id)
            ->queryOne();

        $city = $users_info['city'];
        $name = $users_info['name'];

        $sql = "
        SELECT skills.name skill 
        FROM profiles 
        JOIN skills ON skills.id=profiles.skill_id
        WHERE profiles.user_id=:id
        ";

        $profileInfo = Yii::$app->db->createCommand($sql)
            ->bindValue(':id', $user_id)
            ->queryAll();

        $skills = [];
        if (!empty($profileInfo)) {
            foreach ($profileInfo as $item) {
                $skills[] = $item['skill'];
            }
        }

        return [
            'name' => $name,
            'city' => $city,
            'skills' => implode(', ', $skills)
        ];
    }

    public static function getProfiles()
    {
        $users = Users::getUsersOrderById();

        $profiles = [];
        foreach ($users as $user) {
            $profileInfo = self::getProfile($user['id']);
            $profile = [
                'id' => $user['id'],
                'city' => $profileInfo['city'],
                'skills' => $profileInfo['skills'],
                'name' => $profileInfo['name']
            ];
            $profiles[] = $profile;
        }
        return $profiles;
    }

    public static function getTableHeader()
    {
        return '
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Город</th>
            <th>Навыки</th>
            <th></th>
        </tr>
        </thead>
        <tbody>';
    }

    public static function getTableFooter()
    {
        return '</tbody>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Город</th>
            <th>Навыки</th>
            <th></th>
        </tr>
        </tfoot>
    </table>';
    }

    public static function getTableTr($data_item)
    {
        return '<tr id="' . $data_item['id'] . '">
            <th scope="row">' . $data_item['id'] . '</th>
            <td>' . $data_item['name'] . '</td>
            <td>' . $data_item['city'] . '</td>
            <td>' . $data_item['skills'] . '</td>
            <td class="delete_user"><i class="fas fa-trash-alt"></i></td>
        </tr>';
    }

    public static function getTable()
    {
        $profiles = self::getProfiles();
        $table = self::getTableHeader();
        if (!empty($profiles)) {
            foreach ($profiles as $profile) {
                $table .= self::getTableTr($profile);
            }
        }
        $table .= self::getTableFooter();
        return $table;
    }


    public static function deleteProfile($user_id)
    {
        //$sql = "DELETE FROM profiles WHERE user_id=:id";

        $condition = 'id = '.$user_id;

        Yii::$app->db->createCommand()->delete('profiles', $condition)->execute();

       /* Yii::$app->db->createCommand($sql)
            ->bindValue(':id', $user_id)
            ->queryAll();*/

        Yii::$app->db->createCommand()->delete('users', $condition)->execute();


        /*$sql = "DELETE FROM users WHERE user_id=:id LIMIT 1";
        Yii::$app->db->createCommand($sql)
            ->bindValue(':id', $user_id)
            ->queryOne();*/
    }

    public static function createProfile()
    {
        $username = Users::getRandomUserName();
        $skills = Skills::getRandomSkills();
        $city = City::getRandomCity();

        $userdata = [
            'name' => $username,
            'city_id' => $city
        ];

        $user_id = Users::insertUser($userdata);

        $profiledata = [
            'user_id' => $user_id,
            'skills' => $skills
        ];
        self::insertProfile($profiledata);
    }

    public static function insertProfile(array $profiledata)
    {
        $user_id = $profiledata['user_id'];
        $skills = $profiledata['skills'];

        if (empty($skills)) return;

        foreach ($skills as $skill) {
            $time_now = time();
            Yii::$app->db->createCommand()->insert('profiles', [
                'user_id' => $user_id,
                'skill_id' => $skill,
                'created_at' => $time_now,
                'updated_at' => $time_now,
            ])->execute();
        }
    }

}