<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Адмінпанель</a></li>
                    <li><a href="/admin/product">Управління товарами</a></li>
                    <li class="active">Редагувати товар</li>
                </ol>
            </div>


            <h4>Добавити новий товар</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Назва товару</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Артикул</p>
                        <input type="text" name="code" placeholder="" value="">

                        <p>Вартість, $</p>
                        <input type="text" name="price" placeholder="" value="">

                        <p>Категорія</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>

                        <p>Виробник</p>
                        <input type="text" name="brand" placeholder="" value="">

                        <p>Фото товару</p>
                        <input type="file" name="image" placeholder="" value="">

                        <p>Детальний опис</p>
                        <textarea name="description"></textarea>

                        <br/><br/>

                        <p>Наявність на складі</p>
                        <select name="availability">
                            <option value="1" selected="selected">Так</option>
                            <option value="0">Ні</option>
                        </select>

                        <br/><br/>

                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" selected="selected">Так</option>
                            <option value="0">Ні</option>
                        </select>

                        <br/><br/>

                        <p>Рекоменлації</p>
                        <select name="is_recommended">
                            <option value="1" selected="selected">Так</option>
                            <option value="0">Ні</option>
                        </select>

                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Відображається</option>
                            <option value="0">Прихований</option>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

