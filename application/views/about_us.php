<div class="breadcrumbs">
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Tentang Kami</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="<?= site_url('homepage') ?>"><i class="lni lni-home"></i> Beranda</a></li>
                    <li>Tentang Kami</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="item-details section">
    <div class="container-fluid px-4">
        <div class="top-area">
            <div class="row">
                <?php foreach ($tentang as $t): ?>
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm border-md">
                            <div class="card-body">
                                <div class="row align-items-start p-2">
                                    <?php if ($t->layout == 1): ?>
                                        <div class="col-lg-8 col-md-8 col-12">
                                            <h2 class="card-title fw-bold"><?= $t->title ?></h2>
                                            <h5 class="card-text mt-2"><?= $t->content ?></h5>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12 text-end">
                                            <img src="<?= base_url('assets/images/item/' . $t->gambar) ?>" alt="Tentang Kami"
                                                class="img-fluid rounded" style="height: 300px; width: auto; object-fit: cover;"
                                                onerror="this.onerror=null; this.src='<?= base_url('assets/images/item/no_image.jpg') ?>'">
                                        </div>
                                    <?php elseif ($t->layout == 2): ?>
                                        <div class="col-lg-4 col-md-4 col-12 text-start">
                                            <img src="<?= base_url('assets/images/item/' . $t->gambar) ?>" alt="Tentang Kami"
                                                class="img-fluid rounded" style="height: 300px; width: auto; object-fit: cover;"
                                                onerror="this.onerror=null; this.src='<?= base_url('assets/images/item/no_image.jpg') ?>'">
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-12">
                                            <h2 class="card-title fw-bold"><?= $t->title ?></h2>
                                            <h5 class="card-text mt-2"><?= $t->content ?></h5>
                                        </div>
                                    <?php elseif ($t->layout == 3): ?>
                                        <div class="col-12 text-center">
                                            <h2 class="card-title fw-bold"><?= $t->title ?></h2>
                                            <img src="<?= base_url('assets/images/item/' . $t->gambar) ?>" alt="Tentang Kami"
                                                class="img-fluid rounded" style="height: 450px; object-fit: cover;"
                                                onerror="this.onerror=null; this.src='<?= base_url('assets/images/item/no_image.jpg') ?>'">
                                        </div>
                                        <div class="col-12 mt-3 text-center">
                                            <h5 class="card-text mt-2 mb-4"><?= $t->content ?></h5>
                                        </div>
                                    <?php elseif ($t->layout == 4): ?>
                                        <div class="col-12 text-center">
                                            <h2 class="card-title fw-bold"><?= $t->title ?></h2>
                                            <h5 class="card-text mt-4"><?= $t->content ?></h5>
                                        </div>
                                        <div class="col-12 mt-3 text-center">
                                            <img src="<?= base_url('assets/images/item/' . $t->gambar) ?>" alt="Tentang Kami"
                                                class="img-fluid rounded" style="height: 450px; object-fit: cover;"
                                                onerror="this.onerror=null; this.src='<?= base_url('assets/images/item/no_image.jpg') ?>'">
                                        </div>
                                    <?php elseif ($t->layout == 5): ?>
                                        <div class="col-12 text-center" style="height:300px">
                                            <div class="mx-auto">
                                                <h2 class="card-title fw-bold"><?= $t->title ?></h2>
                                                <h5 class="card-text mt-4"><?= $t->content ?></h5>
                                            </div>
                                        </div>
                                    <?php elseif ($t->layout == 6): ?>
                                        <div class="col-12 text-center">
                                            <h2 class="card-title fw-bold"><?= $t->title ?></h2>
                                            <div class="mt-3">
                                                <img src="<?= base_url('assets/images/item/' . $t->gambar) ?>"
                                                    alt="Tentang Kami" class="img-fluid rounded"
                                                    style="height: 500px; width: auto; object-fit: cover;"
                                                    onerror="this.onerror=null; this.src='<?= base_url('assets/images/item/no_image.jpg') ?>'">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>