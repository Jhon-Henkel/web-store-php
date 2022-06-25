<?php

namespace core\models;

use core\classes\Database;

class Product
{
    public function productList($category)
    {
        $db         = new Database();
        $search     = 'SELECT * FROM produtos WHERE status_pdt = 1';
        $categories = $this->searchCategories();

        if (in_array($category, $categories)) {
            $search .= " AND categoria_pdt = '" . $category . "'";
        }

        return $db->select($search);
    }

    public function searchCategories()
    {
        $db     = new Database();
        $categoriesDb = $db->select('SELECT DISTINCT categoria_pdt FROM produtos');
        $categories = array();

        foreach ($categoriesDb as $categoryDb) {
            $categories[] = $categoryDb->categoria_pdt;
        }

        return $categories;
    }
}