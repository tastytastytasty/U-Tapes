<style>
    @media (max-width: 576px) {
        .pagination {
            margin-top: 30px !important;
        }
    }
</style>
<div class="pagination d-flex justify-content-end mt-4 gap-1">
    <?php if ($start > 1): ?>
        <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary page-link" data-page="<?= $start - 1 ?>">
            &laquo;
        </a>
    <?php endif; ?>

    <?php for ($i = $start; $i <= $end; $i++): ?>
        <a href="javascript:void(0)"
            class="btn btn-sm page-link <?= ($i == $page) ? 'btn-primary active' : 'btn-outline-primary' ?>"
            data-page="<?= $i ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($end < $total_page): ?>
        <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary page-link" data-page="<?= $end + 1 ?>">
            &raquo;
        </a>
    <?php endif; ?>

</div>