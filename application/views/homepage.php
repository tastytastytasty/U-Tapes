<style>
	.product-image {
		position: relative;
		width: 100%;
		height: 0;
		padding-bottom: 100%;
		overflow: hidden;
		border-radius: 6px;
		background: #f8f9fa;
	}

	.product-image img {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
		object-position: center;
		border-radius: 6px;
	}

	.slider-head,
	.hero-slider,
	.hero-slider .slick-prev,
	.hero-slider .slick-next {
		z-index: 1 !important;
	}

	.product-actions {
		transition: opacity 0.3s ease, transform 0.2s ease;
		z-index: 6;
	}

	.product-actions .action-btn {
		width: 34px;
		height: 34px;
		padding: 0;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.product-actions .action-btn i {
		font-size: 16px;
	}

	.product-actions button:hover {
		transform: scale(1.1);
	}

	.product-actions.in-wishlist {
		opacity: 1;
	}

	.product-actions.not-in-wishlist {
		opacity: 0;
	}

	.product-image:hover .product-actions.not-in-wishlist {
		opacity: 1;
	}

	.new-tag,
	.sale-tag {
		position: static !important;
		background: #0d6efd;
		color: #fff;
	}

	.sale-tag {
		background: #dc3545;
	}

	.badge-wrapper span {
		display: inline-block;
		margin-right: 6px;
		font-size: 12px;
		padding: 3px 8px;
	}

	.badge-desktop {
		position: absolute;
		top: 10px;
		left: 10px;
	}

	.badge-mobile {
		display: none;
	}

	.stok-overlay {
		position: absolute;
		inset: 0;
		background: rgba(255, 255, 255, 0.6);
		display: flex;
		text-align: center;
		align-items: center;
		justify-content: center;
		font-size: 40px;
		font-weight: 700;
		color: red;
		letter-spacing: 3px;
		z-index: 5;
	}

	.color-out .color-circle {
		opacity: 0.45;
		position: relative;
		outline: 2px solid #ccc;
		outline-offset: 2px;
	}

	.color-out .color-circle::after {
		content: "";
		position: absolute;
		top: 50%;
		left: 50%;
		width: 140%;
		height: 2px;
		background: #aaa;
		transform: translate(-50%, -50%) rotate(-45deg);
		pointer-events: none;
		border-radius: 2px;
	}

	.color-out {
		cursor: not-allowed !important;
	}

	.color-radio input {
		display: none;
	}

	.color-circle {
		width: 34px;
		height: 34px;
		border-radius: 50%;
		border: 2px solid #000000;
		cursor: pointer;
		display: inline-block;
	}

	.color-radio input:checked+.color-circle {
		border: 3px solid #0d6efd;
		box-shadow: 0 0 0 2px rgba(13, 110, 253, .3);
	}

	@media (max-width: 576px) {
		.container-fluid {
			padding-left: 20px !important;
			padding-right: 20px !important;
		}

		.col-6 {
			padding: 6px !important;
			margin: 0 !important;
		}

		.single-product {
			padding: 4px !important;
			border-radius: 6px;
		}

		.product-image img {
			width: 100%;
			height: 170px;
			object-fit: cover;
			border-radius: 6px;
		}

		.product-actions .btn {
			padding: 2px 4px;
			font-size: 10px;
		}

		.product-actions i {
			font-size: 12px;
		}

		.new-tag,
		.sale-tag {
			margin-top: 0px !important;
			font-size: 9px !important;
			padding: 2px 4px !important;
			border-radius: 4px !important;
		}

		.product-info {
			padding: 4px !important;
		}

		.product-info .category {
			font-size: 10px;
			line-height: 1.1;
		}

		.product-info .title {
			font-size: 12px;
			line-height: 1.2;
			margin: 2px 0;
		}

		.product-info .title a {
			font-size: 12px;
		}

		.price {
			margin-bottom: auto;
		}

		.price span {
			font-size: 11px;
		}

		.discount-price {
			font-size: 10px;
		}
	}

	@media (max-width: 991px) {
		.hero-slider .single-slider .content {
			padding-right: 15px !important;
		}

		.hero-slider .single-slider .content img {
			height: 350px !important;
		}
	}

	@media (max-width: 767px) {
		.slider-head {
			min-height: 350px;
		}

		.hero-slider .single-slider {
			min-height: 350px !important;
		}

		.hero-slider .single-slider .content {
			flex-direction: row !important;
			padding: 16px !important;
			align-items: center !important;
		}

		.hero-slider .single-slider .content>div:first-child {
			padding-right: 10px !important;
		}

		.hero-slider .single-slider .content img {
			height: 300px !important;
			width: 300px !important;
			max-width: 300px !important;
			object-fit: contain !important;
		}

		.hero-slider .single-slider h2 {
			font-size: 1.2rem;
		}

		.hero-slider .single-slider p {
			font-size: 0.85rem;
		}

		.col-lg-4 .row>.col-lg-12 {
			flex: 0 0 50% !important;
			max-width: 50% !important;
		}

		.col-lg-4 .row>.col-lg-12.mt-2 {
			margin-top: 0 !important;
		}

		.hero-small-banner {
			flex-direction: column !important;
			align-items: flex-end !important;
			justify-content: center !important;
			padding: 14px !important;
			min-height: 180px !important;
		}

		.hero-small-banner>a {
			flex-direction: column !important;
			align-items: flex-end !important;
			justify-content: center !important;
			gap: 8px !important;
		}

		.hero-small-banner img {
			max-height: 120px !important;
			width: 100% !important;
			max-width: 100% !important;
			margin-right: 0 !important;
			object-fit: contain !important;
			align-self: center !important;
		}

		.hero-small-banner .content h3 {
			font-size: 1rem !important;
		}

		.hero-small-banner .content .title {
			font-size: 0.85rem !important;
		}

		.hero-small-banner .content .btn {
			padding: 6px 14px !important;
			font-size: 0.8rem !important;
		}
	}

	@media (max-width: 480px) {

		.slider-head {
			max-height: 340px !important;
			overflow: hidden !important;
		}

		.hero-slider .single-slider {
			min-height: 0 !important;
			max-height: 340px !important;
		}

		.hero-slider .single-slider .content {
			flex-direction: row !important;
			padding: 16px !important;
			align-items: center !important;
		}

		.hero-slider .single-slider .content>div:first-child {
			padding-right: 12px 14px 0 14px !important;
		}

		.hero-slider .single-slider .content img {
			height: 150px !important;
			width: 150px !important;
			max-width: 150px !important;
			object-fit: contain !important;
		}

		.hero-slider .single-slider h2 {
			font-size: 1rem !important;
		}

		.hero-slider .single-slider p {
			font-size: 0.78rem !important;
			margin-bottom: 10px !important;
		}

		.hero-slider .single-slider .btn {
			padding: 7px 16px !important;
			font-size: 0.8rem !important;
		}

		.col-lg-4 .row>.col-lg-12 {
			flex: 0 0 100% !important;
			max-width: 100% !important;
		}

		.col-lg-4 .row>.col-lg-12.mt-2 {
			margin-top: 10px !important;
		}

		.hero-small-banner {
			flex-direction: row !important;
			align-items: center !important;
		}

		.hero-small-banner>a {
			flex-direction: row !important;
			align-items: center !important;
		}

		.hero-small-banner img {
			width: 150px !important;
			max-width: 150px !important;
			height: 150px !important;
			max-height: 150px !important;
			object-fit: contain !important;
		}

		.stok-overlay {
			position: absolute;
			inset: 0;
			background: rgba(255, 255, 255, 0.6);
			display: flex;
			text-align: center;
			align-items: center;
			justify-content: center;
			font-size: 20px;
			font-weight: 700;
			color: red;
			letter-spacing: 3px;
			z-index: 5;
		}
	}
</style>
<section class="hero-area">
	<div class="container-fluid px-4">
		<div class="row">
			<?php
			$has_main = !empty($banners);
			$has_new = isset($new_items[0]) && !empty($new_items->total_stok);
			$has_promo = isset($promo_items[0]);
			$new = $has_new ? $new_items[0] : null;
			$promo = $has_promo ? $promo_items[0] : null;
			$has_small = $has_new || $has_promo;
			?>
			<?php if ($has_main): ?>
				<div class="<?= $has_small ? 'col-lg-8' : 'col-12' ?> col-12 custom-padding-right">
					<div class="slider-head">
						<div class="hero-slider">
							<?php foreach ($banners as $banner): ?>
								<div class="single-slider"
									style="background-image: url('<?= base_url('assets/images/hero/' . $banner->background_banner) ?>');">
									<div class="content"
										style="display:flex; align-items:center; justify-content:space-between; width:100%; padding-right:25px;">
										<div style="flex:1; min-width:0; padding-right:15px;">
											<h2>
												<span><?= $banner->subtitle ?></span>
												<?= $banner->nama_item ?>
											</h2>
											<p><?= $banner->deskripsi_banner ?></p>
											<div class="button">
												<a href="<?= site_url('detailproduct/' . $banner->id_item) ?>" class="btn">Beli
													Sekarang</a>
											</div>
										</div>
										<div style="flex-shrink:0; align-self:stretch; display:flex; align-items:flex-end;">
											<img src="<?= base_url('assets/images/item/' . $banner->gambar_item) ?>"
												alt="<?= $banner->nama_item ?>"
												style="height:450px; object-fit:cover; border-radius:12px; border: 1px solid #0d6efd;">
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($has_small): ?>
				<div class="<?= $has_main ? 'col-lg-4' : 'col-12' ?> col-12">
					<div class="row h-100">
						<?php if ($new): ?>
							<div
								class="<?= (!$has_main && !$has_promo) ? 'col-12' : (!$has_main ? 'col-lg-6 col-md-6' : 'col-lg-12 col-md-6') ?> col-12 <?= $has_promo ? 'mt-2' : '' ?>">
								<div class="hero-small-banner h-100"
									style="background-image: url('<?= base_url('assets/images/hero/slider1.jpg') ?>'); display:flex; align-items:center; justify-content:space-between; box-shadow:0 5px 8px rgba(0,0,0,0.2); <?= !$has_main ? 'min-height:300px;' : '' ?>">
									<a href="<?= site_url('detailproduct/' . $new->id_item) ?>"
										style="display:flex; align-items:center; justify-content:space-between; width:100%; text-decoration:none;">
										<div class="content">
											<h5 class="fw-bold text-primary mb-4">Produk Baru</h5>
											<h5 class="title fw-bold mb-2">
												<a
													href="<?= site_url('detailproduct/' . $new->id_item) ?>"><?= $new->nama_item ?></a>
											</h5>
											<h3>Rp <?= number_format($new->harga_termurah, 0, ',', '.') ?></h3>
											<div class="mt-4">
												<a class="btn btn-primary fw-bold"
													href="<?= site_url('detailproduct/' . $new->id_item) ?>">Lihat</a>
											</div>
										</div>
										<div style="flex-shrink:0;">
											<img src="<?= base_url('assets/images/item/' . $new->gambar_item) ?>"
												alt="<?= $new->nama_item ?>"
												style="height:100%; max-height:200px; object-fit:contain; margin-right:20px; border:1px solid #0d6efd; border-radius:8px;">
										</div>
									</a>
								</div>
							</div>
						<?php endif; ?>
						<?php if ($promo): ?>
							<?php
							$harga_asli = $promo->harga_termurah;
							$harga_diskon = $harga_asli;
							if ($promo->is_sale) {
								if ($promo->persen_promo > 0) {
									$harga_diskon = $harga_asli - ($harga_asli * $promo->persen_promo / 100);
								} elseif ($promo->harga_promo > 0) {
									$harga_diskon = $harga_asli - $promo->harga_promo;
								}
							}
							?>
							<div
								class="<?= (!$has_main && !$has_new) ? 'col-12' : (!$has_main ? 'col-lg-6 col-md-6' : 'col-lg-12 col-md-6') ?> col-12 <?= $has_new ? 'mt-2' : '' ?>">
								<div class="hero-small-banner h-100"
									style="background-image: url('<?= base_url('assets/images/hero/slider3.jpg') ?>'); display:flex; align-items:center; justify-content:space-between; box-shadow:0 5px 8px rgba(0,0,0,0.2); <?= !$has_main ? 'min-height:300px;' : '' ?>">
									<a href="<?= site_url('detailproduct/' . $promo->id_item) ?>"
										style="display:flex; align-items:center; justify-content:space-between; width:100%; text-decoration:none;">
										<div class="content" style="flex:1; min-width:0; padding-right:15px;">
											<h5 class="fw-bold text-danger mb-4">Produk Promo</h5>
											<h5 class="title fw-bold mb-2">
												<a
													href="<?= site_url('detailproduct/' . $promo->id_item) ?>"><?= $promo->nama_item ?></a>
											</h5>
											<h3 class="text-danger mb-2">Rp <?= number_format($harga_diskon, 0, ',', '.') ?>
											</h3>
											<del class="text-muted">Rp <?= number_format($harga_asli, 0, ',', '.') ?></del>
											<?php if ($promo->persen_promo > 0): ?>
												<span class="text-danger ms-2 fw-bold"><?= $promo->persen_promo ?>%</span>
											<?php elseif ($promo->harga_promo > 0): ?>
												<span class="text-danger ms-2 fw-bold">Rp
													<?= number_format($promo->harga_promo, 0, ',', '.') ?></span>
											<?php endif; ?>
											<div class="mt-4">
												<a class="btn btn-danger fw-bold"
													href="<?= site_url('detailproduct/' . $promo->id_item) ?>">Lihat</a>
											</div>
										</div>
										<div style="flex-shrink:0;">
											<img src="<?= base_url('assets/images/item/' . $promo->gambar_item) ?>"
												alt="<?= $promo->nama_item ?>"
												style="height:100%; max-height:200px; object-fit:contain; margin-right:20px; border:1px solid #dc3545; border-radius:8px;">
										</div>
									</a>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- Start Trending Product Area -->
<section class="trending-product section pt-5">
	<div class="container-fluid px-4">
		<div class="row align-items-center mb-3">
			<div class="col-12">
				<div class="section-title mb-0">
					<h2 class="mb-0 mt-4">Produk Baru</h2>
				</div>
			</div>
			<div class="text-end">
				<a href="<?= site_url('katalog') ?>"
					class="btn btn-link fw-bold text-primary text-decoration-none d-inline-flex align-items-center gap-2">
					Lihat Semua
					<i class="lni lni-arrow-right" style="font-size: 18px;"></i>
				</a>
			</div>
		</div>
		<hr>
		<?php $this->load->view('card', ['items' => $new_items]); ?>
	</div>
	<div class="container-fluid px-4">
		<div class="row align-items-center mb-3">
			<div class="col-12">
				<div class="section-title mb-0">
					<h2 class="mb-0  mt-4">Produk Promo</h2>
				</div>
			</div>
			<div class="text-end">
				<a href="<?= site_url('promo') ?>"
					class="btn btn-link fw-bold text-primary text-decoration-none d-inline-flex align-items-center gap-2">
					Lihat Semua
					<i class="lni lni-arrow-right" style="font-size: 18px;"></i>
				</a>
			</div>
		</div>
		<hr>
		<?php $this->load->view('card', ['items' => $promo_items]); ?>
	</div>
	<div class="container-fluid px-4">
		<div class="row align-items-center mb-3">
			<div class="col-12">
				<div class="section-title mb-0">
					<h2 class="mb-0  mt-4">Produk Populer</h2>
				</div>
			</div>
			<div class="text-end">
				<a href="<?= site_url('katalog?sort=terpopuler') ?>"
					class="btn btn-link fw-bold text-primary text-decoration-none d-inline-flex align-items-center gap-2">
					Lihat Semua
					<i class="lni lni-arrow-right" style="font-size: 18px;"></i>
				</a>
			</div>
		</div>
		<hr>
		<?php $this->load->view('card', ['items' => $trend_items]); ?>
	</div>
</section>