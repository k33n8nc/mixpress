<?php $categories = get_categories(); ?>
<ul class="cat-list">
  <li><a class="cat-list_item active" href="#!" data-slug="">All projects</a></li>

  <?php foreach($categories as $category) : ?>
    <li>
      <a class="cat-list_item" href="#!" data-slug="<?= $category->slug; ?>">
        <?= $category->name; ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
