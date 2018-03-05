<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id']; ?>">
                                            <?php echo $categoryItem['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>


                    <?php if ($result): ?>
                        <p>Замовлення оформлене. Ми Вам передзвонимо.</p>
                    <?php else: ?>

                        <p>Вибрано товарів: <?php echo $totalQuantity; ?>, на суму: <?php echo $totalPrice; ?>, $</p><br/>

                        <?php if (!$result): ?>                        

                            <div class="col-sm-4">
                                <?php if (isset($errors) && is_array($errors)): ?>
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li> - <?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <p>Для оформлення замовлення заповніть форму. Наш менеджер звяжеться з Вами.</p>

                                <div class="login-form">
                                    <form action="#" method="post">

                                        <p>Ваше імя</p>
                                        <input type="text" name="userName" placeholder="" value="<?php echo $userName; ?>"/>

                                        <p>Номер телефону</p>
                                        <input type="text" name="userPhone" placeholder="" value="<?php echo $userPhone; ?>"/>

                                        <p>Коментар до  замовлення</p>
                                        <input type="text" name="userComment" placeholder="Сообщение" value="<?php echo $userComment; ?>"/>

                                        <br/>
                                        <br/>
                                        <input type="submit" name="submit" class="btn btn-default" value="Оформить" />
                                    </form>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>