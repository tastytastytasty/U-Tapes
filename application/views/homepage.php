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

	.color-out {
		position: relative;
	}

	.color-out::after {
        content: "";
        position: absolute;
        top: 40%;
        left: -5px;
        width: 110%;
        height: 5px;
        background: #ff0019;
        transform: rotate(-35deg);
        pointer-events: none;
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

		.text-danger {
			font-size: 10px;
		}
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
									<a href="<?= site_url('detailproduct') ?>" class="btn">Beli Sekarang</a>
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
									<a href="<?= site_url('detailproduct') ?>" class="btn">Beli Sekarang</a>
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
					<h2 class="mb-0">Produk</h2>
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
		<?php $this->load->view('card', ['items' => $items]); ?>
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
							<a href="<?= site_url('detailproduct') ?>" class="btn">Lihat Detail</a>
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
							<a href="<?= site_url('detailproduct') ?>" class="btn">Beli Sekarang</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Banner Area -->