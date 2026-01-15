<style>
	.product-image img {
		width: 100%;
		border-radius: 6px;
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

	.product-actions .action-btn:hover {
		transform: scale(1.1);
	}

	.product-actions {
		transition: opacity 0.3s ease, transform 0.2s ease;
		z-index: 10;
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

	.product-actions button:hover {
		transform: scale(1.1);
	}
</style>
<!-- Start Hero Area -->
<section class="hero-area">
	<div class="container-fluid px-4">
		<div class="row">
			<div class="col-lg-8 col-12 custom-padding-right">
				<div class="slider-head">
					<!-- Start Hero Slider -->
					<div class="hero-slider">
						<!-- Start Single Slider -->
						<div class="single-slider"
							style="background-image: url(<?= base_url('assets/images/hero/slider-bg1.jpg') ?>);">
							<div class="content">
								<h2><span>No restocking fee ($35 savings)</span>
									M75 Sport Watch
								</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
									incididunt ut labore et dolore magna aliqua.</p>
								<h3><span>Now Only</span> $320.99</h3>
								<div class="button">
									<a href="<?= site_url('detailproduct') ?>" class="btn">Shop Now</a>
								</div>
							</div>
						</div>
						<!-- End Single Slider -->
						<!-- Start Single Slider -->
						<div class="single-slider"
							style="background-image: url(<?= base_url('assets/images/hero/slider-bg2.jpg') ?>);">
							<div class="content">
								<h2><span>Big Sale Offer</span>
									Get the Best Deal on CCTV Camera
								</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
									incididunt ut labore et dolore magna aliqua.</p>
								<h3><span>Combo Only:</span> $590.00</h3>
								<div class="button">
									<a href="<?= site_url('detailproduct') ?>" class="btn">Shop Now</a>
								</div>
							</div>
						</div>
						<!-- End Single Slider -->
					</div>
					<!-- End Hero Slider -->
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<div class="row">
					<div class="col-lg-12 col-md-6 col-12 md-custom-padding">
						<!-- Start Small Banner -->
						<div class="hero-small-banner"
							style="background-image: url('<?= base_url('assets/images/hero/slider-bnr.jpg') ?>');">
							<a href="<?= site_url('detailproduct') ?>">
								<div class="content">
									<h2>
										<span>Sepatu terbaru</span>
										Sepaut
									</h2>
									<h3>Rp. 1.000</h3>
								</div>
							</a>
						</div>
						<!-- End Small Banner -->
					</div>
					<div class="col-lg-12 col-md-6 col-12">
						<!-- Start Small Banner -->
						<div class="hero-small-banner style2">
							<div class="content">
								<h2>Promo baru</h2>
								<p>Promo Natal 25% dari 21 - 26 Desember 2025.</p>
								<div class="button">
									<a class="btn" href="<?= site_url('katalog') ?>">Beli Sekarang</a>
								</div>
							</div>
						</div>
						<!-- Start Small Banner -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Hero Area -->

<!-- Start Trending Product Area -->
<section class="trending-product section">
	<div class="container-fluid px-4">
		<div class="row align-items-center mb-3">
			<div class="col-12">
				<div class="section-title mb-0">
					<h2 class="mb-0">Produk Terkini</h2>
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
		<!-- Start Single Product -->
		<div class="row">
			<?php foreach ($items as $item): ?>
				<div class="col-6 col-md-4 col-lg-3 mb-4">
					<div class="single-product d-flex flex-column h-100">
						<div class="product-image position-relative">
							<img src="<?= base_url('assets/images/item/' . $item->gambar) ?>"
								alt="<?= $item->nama_sepatu ?>">
							<div class="product-actions position-absolute top-0 end-0 m-2 d-flex justify-content-inline gap-1
								<?= $item->in_wishlist ? 'in-wishlist' : 'not-in-wishlist' ?>">
								<button class="btn btn-sm btn-danger btn-wishlist" data-page="catalog"
									data-id="<?= $item->id_item ?>"
									data-login="<?= $this->session->userdata('logged_in') ? 1 : 0 ?>">
									<i class="lni <?= $item->in_wishlist ? 'lni-heart-filled' : 'lni-heart' ?>"></i>
								</button>
							</div>
							<?php if ($item->is_new): ?>
								<span class="new-tag">Baru</span>
							<?php endif; ?>
							<div class="button">
								<a href="<?= site_url('detailproduct/' . $item->id_item) ?>" class="btn">Lihat Detail</a>
							</div>
						</div>
						<div class="product-info d-flex flex-column flex-grow-1">
							<span class="category text-primary"><?= $item->nama_kategori ?> | <?= $item->merk ?></span>
							<h4 class="title">
								<a href="<?= site_url('detailproduct/' . $item->id_item) ?>">
									<?= $item->nama_sepatu ?>
								</a>
							</h4>
							<div class="price d-flex justify-content-between">
								<span>Rp. <?= number_format($item->harga_termurah, 0, ',', '.') ?></span>
								<?php if ($item->total_stok <= 0): ?>
									<span class="text-danger">Habis</span>
								<?php endif; ?>
							</div>
							<?php if ($item->total_stok > 0): ?>
								<a href="<?= site_url('detailproduct/' . $item->id_item) ?>"
									class="btn btn-sm btn-primary w-100 mt-auto">
									<i class="lni lni-wallet me-1"></i><span class="fw-bold"> Checkout</span>
								</a>
							<?php else: ?>
								<button class="btn-sm btn-secondary w-100 mt-auto" style="border-bottom: none; border-right: none;" disabled>
									<i class="lni lni-wallet me-1"></i><span class="fw-bold"> Checkout</span>
								</button>
							<?php endif; ?>
						</div>
					</div>
					<!-- End Single Product -->
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- End Trending Product Area -->

<!-- Start Banner Area -->
<section class="banner section">
	<div class="container-fluid px-4">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Trending Product</h2>
					<p>There are many variations of passages of Lorem Ipsum available, but the majority have
						suffered alteration in some form.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="single-banner"
					style="background-image:url('<?= base_url('assets/images/banner/banner-1-bg.jpg') ?>')">
					<div class="content">
						<h2>Smart Watch 2.0</h2>
						<p>Space Gray Aluminum Case with <br>Black/Volt Real Sport Band </p>
						<div class="button">
							<a href="<?= site_url('detailproduct') ?>" class="btn">View Details</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="single-banner custom-responsive-margin"
					style="background-image:url('<?= base_url('assets/images/banner/banner-2-bg.jpg') ?>')">
					<div class="content">
						<h2>Smart Headphone</h2>
						<p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
							incididunt ut labore.</p>
						<div class="button">
							<a href="<?= site_url('detailproduct') ?>" class="btn">Shop Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Banner Area -->

<!-- Start Shipping Info -->
<section class="shipping-info">
	<div class="container-fluid px-4">
		<ul>
			<!-- Free Shipping -->
			<li>
				<div class="media-icon">
					<i class="lni lni-delivery"></i>
				</div>
				<div class="media-body">
					<h5>Free Shipping</h5>
					<span>On order over $99</span>
				</div>
			</li>
			<!-- Money Return -->
			<li>
				<div class="media-icon">
					<i class="lni lni-support"></i>
				</div>
				<div class="media-body">
					<h5>24/7 Support.</h5>
					<span>Live Chat Or Call.</span>
				</div>
			</li>
			<!-- Support 24/7 -->
			<li>
				<div class="media-icon">
					<i class="lni lni-credit-cards"></i>
				</div>
				<div class="media-body">
					<h5>Online Payment.</h5>
					<span>Secure Payment Services.</span>
				</div>
			</li>
			<!-- Safe Payment -->
			<li>
				<div class="media-icon">
					<i class="lni lni-reload"></i>
				</div>
				<div class="media-body">
					<h5>Easy Return.</h5>
					<span>Hassle Free Shopping.</span>
				</div>
			</li>
		</ul>
	</div>
</section>
<!-- End Shipping Info -->