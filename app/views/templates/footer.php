<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
<?php if (!isset($_SESSION['user_id'])) : ?>
    <script src="<?= BASEURL; ?>/js/home.js"></script>
<?php else : ?>
    <script src="<?= BASEURL; ?>/js/blog.js"></script>
<?php endif; ?>
</body>

</html>