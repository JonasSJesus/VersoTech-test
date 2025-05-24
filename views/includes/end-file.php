<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-success alert-dismissible container" id="liveAlertPlaceholder" role="alert">
        <?= $_SESSION['flash']; ?>
        <?php unset($_SESSION['flash']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<!--    <div id="liveAlertPlaceholder">-->
<!--        <div>-->
<!--            <div class="alert alert-success alert-dismissible" role="alert">-->
<!--                <div>Nice, you triggered this alert message!</div>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<?php endif; ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>