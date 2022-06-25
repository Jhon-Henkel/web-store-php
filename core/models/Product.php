<?php

namespace core\models;

use core\classes\Database;

class Product
{
    public function productList($category)
    {
        $db     = new Database();
        $search = 'SELECT * FROM produtos WHERE status_pdt = 1';

        if ($category != 'todos') {
            $search .= " AND categoria_pdt = '" . $category . "'";
        }

        return $db->select($search);
    }

    public function searchCategories()
    {
        $db     = new Database();
        $search = 'SELECT DISTINCT categoria_pdt FROM produtos';

        return $db->select($search);
    }
}