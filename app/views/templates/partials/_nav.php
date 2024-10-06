<nav aria-label="Page navigation example" style="text-align: center;">
    <ul class="pagination">
        <!-- Lien vers la page précédente -->
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="posts/page/<?php echo $page - 1; ?>">Previous</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        <?php endif; ?>

        <!-- Liens vers chaque page -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="posts/page/<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <!-- Lien vers la page suivante -->
        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="posts/page/<?php echo $page + 1; ?>">Next</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        <?php endif; ?>
    </ul>
</nav>