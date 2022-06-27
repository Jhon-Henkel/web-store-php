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

    public function validateStockProduct($idPdt): bool
    {
        $db = new Database();
        $params = [':idPdt' => $idPdt];
        $results = $db->select('SELECT * FROM produtos WHERE id_pdt = :idPdt AND status_pdt = 1 AND qtd_pdt_estoque > 0', $params);
        return count($results) != 0 ? true : false;
    }
}