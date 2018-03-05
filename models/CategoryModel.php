<?php

/**
 * Клас CategoryModel - модель для работи з категоріями товарів
 */
class CategoryModel
{

    /**
     *  повертає масив категорій для списку на сайті
     * @return array <p>Масив з категоріями</p>
     */
    public static function getCategoriesList()
    {
        
        $db = DBComponent::getConnection();// Зєднання с БД

        
        $result = $db->query('SELECT id, name FROM category WHERE status = "1" ORDER BY sort_order, name ASC');// Запит до БД

       
        $i = 0; // Отримання і повернення результатів
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * повертає масив категорій для списку в адмінпанелі <br/>
     * @return array <p>Массив категорий</p>
     */
    public static function getCategoriesListAdmin()
    {
      
        $db = DBComponent::getConnection();// Зєднання с БД

        
        $result = $db->query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC');// Запит с БД

        
        $categoryList = array();// Отримання і повернення результатів
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Видаляє категорію з заданим id
     * @param integer $id
     * @return boolean <p>Результат виконання метода</p>
     */
    public static function deleteCategoryById($id)
    {
        
        $db = DBComponent::getConnection();// Зєднання с БД

        
        $sql = 'DELETE FROM category WHERE id = :id';// Текст запиту до  БД

       
        $result = $db->prepare($sql); // отримання і повернення результатів,використовується підготовка-запит
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редагування категорії з заданим id
     * @param integer $id <p>id категорії</p>
     * @param string $name <p>Назва</p>
     * @param integer $sortOrder <p>Порядковий номер</p>
     * @param integer $status <p>Статус <i>(включено "1", виключено "0")</i></p>
     * @return boolean <p>Результат виконання методу</p>
     */
    public static function updateCategoryById($id, $name, $sortOrder, $status)
    {
        
        $db = DBComponent::getConnection();// Зєднання с БД

      
        $sql = "UPDATE category SET name = :name, sort_order = :sort_order, status = :status WHERE id = :id";// Текст запиту до  БД

    
        $result = $db->prepare($sql); // отримання і повернення результатів,використовується підготовка-запит
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Повертає категорію з заданим id
     * @param integer $id <p>id категорії</p>
     * @return array <p>Масив з информацією про категорії</p>
     */
    public static function getCategoryById($id)
    {
       
        $db = DBComponent::getConnection();// Зєднання с БД

        $sql = 'SELECT * FROM category WHERE id = :id';// Текст запиту до  БД

      
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);//,використовується підготовка-запит

        
        $result->setFetchMode(PDO::FETCH_ASSOC);// вказуємо що хочемо отримати дані у вигляді масиву

        
        $result->execute();// Виконуємо запит

       
        return $result->fetch(); // повертаємо дані
    }

    /**
     * повертає текстове пояснення статусу для категорії :<br/>
     * <i>0 - Приховано, 1 - Відображається</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстове пояснення</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Відображається';
                break;
            case '0':
                return 'Приховано';
                break;
        }
    }

    /**
     * Добавляє нову категорію
     * @param string $name <p>Назва</p>
     * @param integer $sortOrder <p>Порядковий номер</p>
     * @param integer $status <p>Статус <i>(включено "1", виключено "0")</i></p>
     * @return boolean <p>Результат добавлення запису в таблицю</p>
     */
    public static function createCategory($name, $sortOrder, $status)
    {
 
        $db = DBComponent::getConnection();// Зєднання с БД

  
        $sql = 'INSERT INTO category (name, sort_order, status) ' . 'VALUES (:name, :sort_order, :status)';// Текст запиту до  БД

        $result = $db->prepare($sql);// отримання і повернення результатів,використовується підготовка-запит
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

}
