<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class CatalogController
{

    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex()
    {
        // Список категорий для левого меню
        $categories = CategoryModel::getCategoriesList();

        // Список последних товаров
        $latestProducts = ProductModel::getLatestProducts(12);

        // Подключаем вид
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action для страницы "Категория товаров"
     */
    public function actionCategory($categoryId, $page = 1)
    {
        // Список категорий для левого меню
        $categories = CategoryModel::getCategoriesList();

        // Список товаров в категории
        $categoryProducts = ProductModel::getProductsListByCategory($categoryId, $page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = ProductModel::getTotalProductsInCategory($categoryId);

        // Создаем объект PaginationComponent - постраничная навигация
        $pagination = new PaginationComponent($total, $page, ProductModel::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
