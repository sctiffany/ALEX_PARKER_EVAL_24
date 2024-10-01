<ul class="menu-link">
    <?php include_once "../app/models/categoriesModel.php";
    $categories = \App\Models\CategoriesModel\findAll($connexion); ?>
    <?php foreach ($categories as $category): ?>
        <li><a href="index.html"><?php echo $category['name'] ?>[<?php echo $category['categories_count'] ?>]</a></li>
    <?php endforeach ?>
</ul>