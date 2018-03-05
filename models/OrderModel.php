<?php

/**
 * Класс OrderModel - модель для работи с замовленнями
 */
class OrderModel
{

    /**
     * Зберігаємо заказ
     * @param string $userName <p>Імя</p>
     * @param string $userPhone <p>Телефон</p>
     * @param string $userComment <p>Коментарій</p>
     * @param integer $userId <p>id користувача</p>
     * @param array $products <p>Масив з товарами</p>
     * @return boolean <p>Результат виконання методу</p>
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        
        $db = DBComponent::getConnection();// Зєднання с БД

  
        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) ' // Текст запиту до  БД
                . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        $products = json_encode($products);

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * повертаємо список заказів
     * @return array <p>Список заказів</p>
     */
    public static function getOrdersList()
    {
       
        $db = DBComponent::getConnection();// Зєднання с БД

        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC');// отримання і повернення результатів,
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    /**
     * повертає текстове пояснення статусу  для заказу :<br/>
     * <i>1 - Новий заказ, 2 - В обрабці, 3 - Доставка, 4 - Закритий</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстове пояснення</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новий заказ';
                break;
            case '2':
                return 'В обрабці';
                break;
            case '3':
                return 'Доставка';
                break;
            case '4':
                return 'Закритий';
                break;
        }
    }

    /**
     * Повертає замовлення  з заданим id
     * @param integer $id <p>id</p>
     * @return array <p>Масив з информацією про заказ</p>
     */
    public static function getOrderById($id)
    {
        // зєднання с БД
        $db = DBComponent::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);


        $result->setFetchMode(PDO::FETCH_ASSOC);// отримання і повернення результатів,використовується підготовка-запит

        
        $result->execute();//Виконуємо запит

        return $result->fetch();// повертаємо дані
    }

    /**
     * Видаляє замовлення з заданим id
     * @param integer $id <p>id заказу</p>
     * @return boolean <p>Результат виконання методу</p>
     */
    public static function deleteOrderById($id)
    {
      
        $db = DBComponent::getConnection();// Зєднання с БД


        $sql = 'DELETE FROM product_order WHERE id = :id';// Текст запиту до  БД

      
        $result = $db->prepare($sql);// отримання і повернення результатів,використовується підготовка-запит
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редагуємо замовлення  з заданим id
     * @param integer $id <p>id товару</p>
     * @param string $userName <p>Імя клієнта</p>
     * @param string $userPhone <p>Телефон клієнта</p>
     * @param string $userComment <p>Коментар клієнта</p>
     * @param string $date <p>Дата оформлення</p>
     * @param integer $status <p>Статус <i>(включено "1", виключено "0")</i></p>
     * @return boolean <p>Результат виконання методу</p>
     */
    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
    {
        
        $db = DBComponent::getConnection();// Зєднання с БД

       // Текст запиту до  БД
        $sql = "UPDATE product_order 
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";

       // отримання і повернення результатів,використовується підготовка-запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

}
