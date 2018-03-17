<?php
namespace app\repositories;
use app\models\User;
use DomainException;

/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 17.03.2018
 * Time: 20:43
 */
class UserRepository
{

    public function getByEmail($email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function get(int $id): User
    {
        if (!$user = User::find()->andWhere(['ID' => $id])->limit(1)->one()) {
            throw new DomainException('User not found.');
        }
        return $user;
    }



    private function getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new DomainException('User not found.');
        }
        return $user;
    }

}