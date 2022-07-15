<?php

namespace core\models;

use core\classes\Database;
use Exception;

class AdminModel
{
    /**
     * @throws Exception
     */
    public function validateLoginAdmin($adminUser, $adminPass)
    {
        $params = [
            ':adminUser' => $adminUser,
        ];

        $db = new Database();
        $results = $db->select('
            SELECT * FROM admin_login 
            WHERE usuario_admin = :adminUser 
            AND deleted_at IS NULL', $params);

        if (count($results) == 0) {
            return false;
        } else {

            $adminUser = $results[0];

            if (!password_verify($adminPass, $adminUser->senha_admin)) {
                return false;
            }

            return $adminUser;
        }
    }
}