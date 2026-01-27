<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Modern E-Commerce</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #6366f1;
      --primary-dark: #4f46e5;
      --primary-light: #eef2ff;
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;
      --muted: #64748b;
      --border: #e2e8f0;
      --bg: #f8fafc;
      --bg-secondary: #f1f5f9;
      --text: #0f172a;
      --text-secondary: #475569;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
      --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
      --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
      --radius: 16px;
      --radius-sm: 10px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }

    .checkout-wrapper {
      max-width: 1200px;
      margin: 2rem auto 3rem;
      display: grid;
      grid-template-columns: 1fr 420px;
      gap: 2rem;
      padding: 0 1.5rem;
    }

    .box {
      background: white;
      border-radius: var(--radius);
      padding: 2rem;
      margin-bottom: 1.5rem;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border);
      transition: all 0.3s ease;
    }

    .box:hover {
      box-shadow: var(--shadow-md);
    }

    .box-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid var(--bg-secondary);
    }

    .box h3 {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--text);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn {
      padding: 0.75rem 1.5rem;
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
      outline: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-link {
      background: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
      padding: 0.625rem 1.25rem;
    }

    .btn-link:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }

    .btn-primary {
      background: var(--primary);
      color: white;
      box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    /* Address - COMPACT NO CARD */
    .address-display {
      padding: 0;
      background: transparent;
      border: none;
    }

    .address-label {
      display: inline-flex;
      align-items: center;
      gap: 0.375rem;
      font-size: 0.75rem;
      font-weight: 700;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.75rem;
    }

    .address-content {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .address-name {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
      margin: 0;
    }

    .address-recipient {
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--text);
      display: flex;
      align-items: center;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    .address-recipient strong {
      color: var(--text);
    }

    .address-recipient .phone {
      color: var(--text-secondary);
      font-weight: 500;
    }

    .address-detail {
      font-size: 0.875rem;
      color: var(--text-secondary);
      line-height: 1.6;
      margin: 0;
    }

    /* Product Item - IMPROVED */
    .product-item {
      display: grid;
      grid-template-columns: 100px 1fr;
      gap: 1.25rem;
      padding: 1.25rem;
      background: var(--bg);
      border-radius: var(--radius-sm);
      margin-bottom: 1rem;
      transition: all 0.3s ease;
      border: 2px solid transparent;
      align-items: start;
    }

    .product-item:hover {
      background: white;
      border-color: var(--primary);
      transform: translateX(4px);
      box-shadow: var(--shadow);
    }

    .product-img-wrapper {
      position: relative;
      border-radius: var(--radius-sm);
      overflow: hidden;
      box-shadow: var(--shadow);
      width: 100%;
      height: 0;
      padding-bottom: 100%;
    }

    .product-img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .product-discount-badge {
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      padding: 0.25rem 0.5rem;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 700;
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .product-info {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .product-name {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
      margin: 0;
      line-height: 1.4;
    }

    .product-variant {
      font-size: 0.875rem;
      color: var(--muted);
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .product-variant span {
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
    }

    .product-price-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: auto;
      padding-top: 0.75rem;
      border-top: 1px solid var(--border);
    }

    .product-qty-display {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: white;
      padding: 0.5rem 0.875rem;
      border-radius: 8px;
      border: 2px solid var(--border);
      font-weight: 600;
      color: var(--text);
    }

    .product-qty-display .qty-label {
      font-size: 0.8125rem;
      color: var(--muted);
      font-weight: 500;
    }

    .product-qty-display .qty-value {
      font-size: 1rem;
      color: var(--primary);
      font-weight: 700;
    }

    .product-prices {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 0.25rem;
    }

    .product-price-original {
      font-size: 0.875rem;
      color: var(--danger);
      text-decoration: line-through;
      font-weight: 500;
    }

    .product-price {
      font-size: 1.125rem;
      font-weight: 700;
      color: var(--primary);
    }

    .product-price.no-discount {
      font-size: 1.125rem;
      margin-top: 0.25rem;
    }

    /* Off-Canvas Promo */
    .offcanvas-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      z-index: 9998;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .offcanvas-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .offcanvas {
      position: fixed;
      top: 0;
      right: 0;
      width: 480px;
      max-width: 90vw;
      height: 100vh;
      background: white;
      z-index: 9999;
      transform: translateX(100%);
      transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      box-shadow: -10px 0 30px rgba(0, 0, 0, 0.3);
      display: flex;
      flex-direction: column;
    }

    .offcanvas.active {
      transform: translateX(0);
    }

    .offcanvas-header {
      padding: 2rem;
      border-bottom: 2px solid var(--border);
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: linear-gradient(135deg, var(--primary-light) 0%, #fef3ff 100%);
    }

    .offcanvas-header h3 {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text);
      margin: 0;
    }

    .offcanvas-close {
      width: 40px;
      height: 40px;
      border: none;
      background: white;
      border-radius: 50%;
      font-size: 1.5rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      color: var(--text);
      box-shadow: var(--shadow);
    }

    .offcanvas-close:hover {
      background: var(--danger);
      color: white;
      transform: rotate(90deg);
    }

    .offcanvas-body {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
    }

    .offcanvas-body::-webkit-scrollbar {
      width: 8px;
    }

    .offcanvas-body::-webkit-scrollbar-track {
      background: var(--bg);
    }

    .offcanvas-body::-webkit-scrollbar-thumb {
      background: var(--muted);
      border-radius: 4px;
    }

    .offcanvas-body::-webkit-scrollbar-thumb:hover {
      background: var(--text-secondary);
    }

    .promo-input-group {
      display: flex;
      gap: 0.75rem;
      margin-bottom: 2rem;
    }

    .promo-input {
      flex: 1;
      padding: 1rem 1.25rem;
      border: 2px solid var(--border);
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      font-weight: 500;
      transition: all 0.3s;
      font-family: inherit;
    }

    .promo-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .btn-apply-promo {
      padding: 1rem 1.75rem;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s;
      white-space: nowrap;
    }

    .btn-apply-promo:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    .promo-applied {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.25rem;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border-radius: var(--radius-sm);
      color: white;
      margin-bottom: 2rem;
      animation: slideInRight 0.4s ease;
      box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .promo-applied-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .promo-icon {
      width: 50px;
      height: 50px;
      background: rgba(255, 255, 255, 0.25);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
    }

    .promo-text strong {
      display: block;
      font-size: 1rem;
      margin-bottom: 0.25rem;
    }

    .promo-text small {
      font-size: 0.8125rem;
      opacity: 0.95;
    }

    .btn-remove-promo {
      background: rgba(255, 255, 255, 0.25);
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.4);
      padding: 0.625rem 1rem;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.8125rem;
      font-weight: 600;
      transition: all 0.3s;
    }

    .btn-remove-promo:hover {
      background: rgba(255, 255, 255, 0.4);
      transform: scale(1.05);
    }

    .voucher-section-title {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .voucher-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.25rem;
      background: linear-gradient(135deg, var(--primary-light) 0%, #fef3ff 100%);
      border: 2px dashed var(--primary);
      border-radius: var(--radius-sm);
      margin-bottom: 1rem;
      transition: all 0.3s ease;
      animation: slideInRight 0.3s ease;
    }

    .voucher-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
      border-style: solid;
      background: white;
    }

    .voucher-card.used {
      opacity: 0.5;
      pointer-events: none;
    }

    .voucher-left {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex: 1;
    }

    .voucher-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
      color: white;
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      font-weight: 700;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .voucher-info {
      flex: 1;
    }

    .voucher-title {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 0.25rem;
    }

    .voucher-desc {
      font-size: 0.875rem;
      color: var(--text-secondary);
      margin-bottom: 0.25rem;
    }

    .voucher-valid {
      font-size: 0.8125rem;
      color: var(--muted);
    }

    .btn-use-voucher {
      padding: 0.75rem 1.25rem;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 0.875rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s;
      white-space: nowrap;
    }

    .btn-use-voucher:hover {
      background: var(--primary-dark);
      transform: scale(1.05);
      box-shadow: var(--shadow);
    }

    .btn-use-voucher:disabled {
      background: var(--muted);
      cursor: not-allowed;
      transform: none;
    }

    /* Summary - IMPROVED */
    .summary-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      font-size: 0.9375rem;
      border-bottom: 1px solid var(--bg-secondary);
    }

    .summary-row:last-child {
      border-bottom: none;
    }

    .summary-row .label {
      color: var(--text-secondary);
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .summary-row .value {
      font-weight: 700;
      color: var(--text);
    }

    .summary-row.total-before {
      background: var(--bg);
      margin: 0 -2rem;
      padding: 1rem 2rem;
      border-radius: var(--radius-sm);
    }

    .summary-row.discount .value {
      color: var(--success);
    }

    .summary-row.voucher-discount .value {
      color: var(--primary);
    }

    .summary-row.subtotal {
      font-size: 1rem;
      padding: 1.25rem 0;
    }

    .summary-row.subtotal .label {
      color: var(--text);
      font-weight: 600;
    }

    .summary-row.subtotal .value {
      font-size: 1.25rem;
      color: var(--primary);
    }

    .summary-row.total {
      margin-top: 1rem;
      padding-top: 1.5rem;
      border-top: 3px solid var(--border);
      font-size: 1.25rem;
    }

    .summary-row.total .label {
      color: var(--text);
      font-weight: 700;
      font-size: 1.125rem;
    }

    .summary-row.total .value {
      color: var(--primary);
      font-size: 1.75rem;
      font-weight: 800;
    }

    .btn-promo-trigger {
      width: 100%;
      padding: 1rem;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
      border: 2px dashed #f59e0b;
      border-radius: var(--radius-sm);
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      margin-bottom: 1rem;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-promo-trigger:hover {
      background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    /* Checkout Button */
    .btn-checkout {
      width: 100%;
      padding: 1.25rem;
      background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 1.125rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: var(--shadow-md);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
    }

    .btn-checkout:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
    }

    .btn-checkout:active {
      transform: translateY(-1px);
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 10000;
      animation: fadeIn 0.2s ease;
    }

    .modal[aria-hidden="false"] {
      display: block;
    }

    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(8px);
    }

    .modal-content {
      position: relative;
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
      margin: 2rem auto;
      background: white;
      border-radius: var(--radius);
      padding: 2rem;
      box-shadow: var(--shadow-lg);
      animation: slideUp 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .modal-close {
      position: absolute;
      right: 1.5rem;
      top: 1.5rem;
      width: 40px;
      height: 40px;
      border: none;
      background: var(--bg);
      border-radius: 50%;
      font-size: 1.5rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s;
      color: var(--text-secondary);
    }

    .modal-close:hover {
      background: var(--danger);
      color: white;
      transform: rotate(90deg);
    }

    .address-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.25rem;
      border-radius: var(--radius);
      border: 2px solid var(--border);
      background: var(--bg);
      margin-bottom: 1rem;
      transition: 0.3s ease;
    }

    .address-card:hover {
      border-color: var(--primary);
      background: var(--primary-light);
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }

    .address-card.active {
      border-color: var(--primary);
      background: var(--primary-light);
      border-width: 3px;
    }

    .address-info strong {
      font-size: 1rem;
      color: var(--text);
      display: block;
      margin-bottom: 0.75rem;
    }

    .address-detail {
      font-size: 0.875rem;
      color: var(--text-secondary);
      line-height: 1.6;
    }

    .address-detail-label {
      color: var(--muted);
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: block;
      margin-bottom: 0.25rem;
    }

    .address-detail-section {
      margin-bottom: 0.75rem;
    }

    .address-detail-section:last-child {
      margin-bottom: 0;
    }

    .btn-use-address {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      font-weight: 700;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-use-address:hover:not(:disabled) {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }

    .btn-use-address:disabled {
      background: var(--muted) !important;
      cursor: not-allowed !important;
      transform: none !important;
      opacity: 0.7;
      box-shadow: none !important;
    }

    .address-card.active .btn-use-address:disabled {
      background: var(--muted) !important;
      color: white;
    }

    .btn-add-new-address {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
      width: 100%;
      padding: 1rem 1.5rem;
      background: linear-gradient(135deg, var(--primary-light) 0%, #fef3ff 100%);
      border: 2px dashed var(--primary);
      border-radius: var(--radius);
      color: var(--primary);
      font-size: 0.9375rem;
      font-weight: 700;
      text-decoration: none;
      transition: all 0.3s ease;
      margin-top: 1rem;
    }

    .btn-add-new-address:hover {
      background: white;
      border-style: solid;
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    .btn-add-new-address span:first-child {
      font-size: 1.25rem;
    }

    .spinner {
      width: 18px;
      height: 18px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-top-color: white;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
      display: inline-block;
      margin-right: 0.5rem;
      vertical-align: middle;
    }

    .alert {
      padding: 1.25rem;
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
    }

    .alert-warning {
      background: #fef3c7;
      border: 2px solid #f59e0b;
      color: #92400e;
    }

    /* Payment Modal Styles */
    .payment-modal-content {
      max-width: 550px;
    }

    .payment-header {
      text-align: center;
      margin-bottom: 2rem;
      padding-bottom: 2rem;
      border-bottom: 2px solid var(--bg-secondary);
    }

    .payment-header h2 {
      font-size: 1.75rem;
      color: var(--text);
      margin-bottom: 0.75rem;
      font-weight: 800;
    }

    .payment-amount {
      font-size: 2.25rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-top: 0.75rem;
    }

    .payment-methods {
      margin-bottom: 2rem;
    }

    .payment-method-title {
      font-size: 0.875rem;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 1rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .payment-option {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1.25rem;
      border: 2px solid var(--border);
      border-radius: var(--radius-sm);
      margin-bottom: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      background: white;
    }

    .payment-option:hover {
      border-color: var(--primary);
      background: var(--primary-light);
      transform: translateX(4px);
    }

    .payment-option.selected {
      border-color: var(--primary);
      background: var(--primary-light);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .payment-option input[type="radio"] {
      width: 22px;
      height: 22px;
      cursor: pointer;
      accent-color: var(--primary);
    }

    .payment-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.75rem;
      flex-shrink: 0;
      box-shadow: var(--shadow);
    }

    .payment-details {
      flex: 1;
    }

    .payment-name {
      font-size: 1.0625rem;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 0.25rem;
    }

    .payment-desc {
      font-size: 0.875rem;
      color: var(--text-secondary);
    }

    .btn-confirm-payment {
      width: 100%;
      padding: 1.25rem;
      background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 1.125rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: var(--shadow-md);
    }

    .btn-confirm-payment:hover:not(:disabled) {
      transform: translateY(-3px);
      box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
    }

    .btn-confirm-payment:disabled {
      background: linear-gradient(135deg, var(--muted) 0%, #94a3b8 100%);
      cursor: not-allowed;
      opacity: 0.6;
    }

    /* Success Modal Styles */
    .success-icon-wrapper {
      text-align: center;
      margin-bottom: 2rem;
    }

    .success-icon {
      width: 120px;
      height: 120px;
      background: linear-gradient(135deg, var(--success) 0%, #10b981 100%);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 4rem;
      color: white;
      animation: successPop 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
    }

    .success-content {
      text-align: center;
    }

    .success-content h2 {
      font-size: 2rem;
      color: var(--text);
      margin-bottom: 0.75rem;
      font-weight: 800;
    }

    .success-content p {
      font-size: 1.0625rem;
      color: var(--text-secondary);
      margin-bottom: 2rem;
    }

    .order-details {
      background: var(--bg);
      border-radius: var(--radius-sm);
      padding: 2rem;
      margin-bottom: 2rem;
      text-align: left;
    }

    .order-detail-row {
      display: flex;
      justify-content: space-between;
      padding: 0.875rem 0;
      border-bottom: 1px solid var(--border);
    }

    .order-detail-row:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .order-detail-label {
      font-size: 0.9375rem;
      color: var(--text-secondary);
      font-weight: 500;
    }

    .order-detail-value {
      font-size: 0.9375rem;
      font-weight: 700;
      color: var(--text);
    }

    .order-id {
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1.5rem;
      background: var(--primary-light);
      border: 2px dashed var(--primary);
      border-radius: var(--radius-sm);
      font-family: 'Courier New', monospace;
      font-weight: 700;
      color: var(--primary);
      margin: 1.5rem 0;
      font-size: 1.125rem;
    }

    .btn-success-action {
      width: 100%;
      padding: 1.25rem;
      background: var(--success);
      color: white;
      border: none;
      border-radius: var(--radius-sm);
      font-size: 1.0625rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-bottom: 1rem;
    }

    .btn-success-action:hover {
      background: #059669;
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    .btn-secondary-action {
      width: 100%;
      padding: 1.25rem;
      background: white;
      color: var(--primary);
      border: 2px solid var(--primary);
      border-radius: var(--radius-sm);
      font-size: 1.0625rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-secondary-action:hover {
      background: var(--primary-light);
      transform: translateY(-2px);
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    @keyframes successPop {
      0% {
        transform: scale(0);
        opacity: 0;
      }
      50% {
        transform: scale(1.15);
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    /* Responsive */
    @media (max-width: 992px) {
      .checkout-wrapper {
        grid-template-columns: 1fr;
      }

      .offcanvas {
        width: 100%;
        max-width: 100%;
      }
    }

    @media (max-width: 768px) {
      .checkout-wrapper {
        padding: 0 1rem;
        margin: 1rem auto 2rem;
        gap: 1.5rem;
      }

      .box {
        padding: 1.25rem;
        margin-bottom: 1rem;
      }

      .box h3 {
        font-size: 1.125rem;
      }

      .address-card {
        flex-direction: column;
        gap: 1rem;
      }

      .btn-use-address {
        width: 100%;
      }

      .btn-add-new-address {
        font-size: 0.875rem;
        padding: 0.875rem 1.25rem;
      }

      .product-item {
        grid-template-columns: 90px 1fr;
        gap: 1rem;
        padding: 1rem;
      }

      .product-img-wrapper {
        height: 0;
        padding-bottom: 100%;
      }

      .product-name {
        font-size: 0.9375rem;
      }

      .product-variant {
        font-size: 0.8125rem;
        gap: 0.5rem;
      }

      .product-price-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
      }

      .product-prices {
        align-items: flex-start;
      }

      .voucher-card {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
        padding: 1rem;
      }

      .voucher-left {
        flex-direction: column;
        text-align: center;
      }

      .voucher-icon {
        width: 60px;
        height: 60px;
        font-size: 1.125rem;
      }

      .btn-use-voucher {
        width: 100%;
      }

      .promo-input-group {
        flex-direction: column;
      }

      .btn-apply-promo {
        width: 100%;
      }

      .payment-option {
        flex-direction: row;
        padding: 1rem;
      }

      .payment-icon {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
      }

      .summary-row {
        font-size: 0.875rem;
        padding: 0.75rem 0;
      }

      .summary-row.total {
        font-size: 1.125rem;
      }

      .summary-row.total .value {
        font-size: 1.5rem;
      }
    }

    @media (max-width: 576px) {
      .checkout-wrapper {
        padding: 0 0.75rem;
        gap: 1rem;
      }

      .box {
        padding: 1rem;
        border-radius: 12px;
      }

      .box h3 {
        font-size: 1rem;
      }

      .btn-link {
        font-size: 0.8125rem;
        padding: 0.5rem 1rem;
      }

      .address-label {
        font-size: 0.6875rem;
      }

      .address-name {
        font-size: 0.9375rem;
      }

      .address-recipient {
        font-size: 0.8125rem;
        gap: 0.375rem;
      }

      .address-detail {
        font-size: 0.8125rem;
      }

      .product-item {
        grid-template-columns: 80px 1fr;
        gap: 0.875rem;
        padding: 0.875rem;
      }

      .product-img-wrapper {
        height: 0;
        padding-bottom: 100%;
      }

      .product-discount-badge {
        font-size: 0.6875rem;
        padding: 0.1875rem 0.375rem;
        top: 0.25rem;
        right: 0.25rem;
      }

      .product-name {
        font-size: 0.875rem;
        line-height: 1.3;
      }

      .product-variant {
        font-size: 0.75rem;
        flex-direction: column;
        gap: 0.25rem;
        align-items: flex-start;
      }

      .product-qty-display {
        padding: 0.375rem 0.625rem;
        font-size: 0.8125rem;
      }

      .product-qty-display .qty-label {
        font-size: 0.75rem;
      }

      .product-qty-display .qty-value {
        font-size: 0.875rem;
      }

      .product-price-original {
        font-size: 0.8125rem;
      }

      .product-price {
        font-size: 1rem;
      }

      .btn-promo-trigger {
        font-size: 0.875rem;
        padding: 0.875rem;
      }

      .btn-checkout {
        font-size: 1rem;
        padding: 1rem;
      }

      .summary-row.total .label {
        font-size: 1rem;
      }

      .summary-row.total .value {
        font-size: 1.375rem;
      }

      .voucher-card {
        padding: 0.875rem;
      }

      .voucher-icon {
        width: 50px;
        height: 50px;
        font-size: 1rem;
      }

      .voucher-title {
        font-size: 0.9375rem;
      }

      .voucher-desc {
        font-size: 0.8125rem;
      }

      .modal-content {
        margin: 1rem;
        padding: 1.5rem;
        border-radius: 12px;
      }

      .payment-modal-content {
        margin: 1rem;
      }

      .payment-header h2 {
        font-size: 1.5rem;
      }

      .payment-amount {
        font-size: 1.875rem;
      }
    }

    /* iPhone SE specific (375px width) */
    @media (max-width: 375px) {
      .checkout-wrapper {
        padding: 0 0.5rem;
      }

      .box {
        padding: 0.875rem;
      }

      .box-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1rem;
      }

      .btn-link {
        width: 100%;
        justify-content: center;
      }

      .product-item {
        grid-template-columns: 70px 1fr;
        gap: 0.75rem;
      }

      .product-img-wrapper {
        height: 0;
        padding-bottom: 100%;
      }

      .product-name {
        font-size: 0.8125rem;
      }

      .product-variant {
        font-size: 0.6875rem;
      }

      .product-qty-display {
        padding: 0.3125rem 0.5rem;
      }

      .product-qty-display .qty-label {
        font-size: 0.6875rem;
      }

      .product-qty-display .qty-value {
        font-size: 0.8125rem;
      }

      .product-price-original {
        font-size: 0.75rem;
      }

      .product-price {
        font-size: 0.9375rem;
      }

      .summary-row.total-before {
        margin: 0 -0.875rem;
        padding: 0.875rem;
      }
    }
  </style>
</head>
<body>

<div class="checkout-wrapper">
  <div class="checkout-left">
    
    <!-- Alamat Pengiriman - SINGLE CARD -->
    <div class="box">
      <div class="box-header">
        <h3>📍 Alamat Pengiriman</h3>
        <button class="btn btn-link" id="btn-open-modal">Ganti Alamat</button>
      </div>
      
      <div class="address-display" id="address-display-main">
        <?php if ($alamat_checkout): ?>
          <div class="address-content">
            <h4 class="address-name"><?= htmlspecialchars($alamat_checkout->nama_alamat ?? '-') ?></h4>
            
            <div class="address-recipient">
              <span>👤</span>
              <strong><?= htmlspecialchars($alamat_checkout->nama_penerima ?? '-') ?></strong>
              <span class="phone">📱 <?= htmlspecialchars($alamat_checkout->nomor_telp_penerima ?? '-') ?></span>
            </div>
            
            <p class="address-detail"><?= htmlspecialchars($alamat_checkout->detail) ?><?php if (!empty($alamat_checkout->nama_kelurahan)): ?>, <?= htmlspecialchars($alamat_checkout->nama_kelurahan) ?>, <?= htmlspecialchars($alamat_checkout->nama_kecamatan) ?>, <?= htmlspecialchars($alamat_checkout->nama_kabupaten) ?>, <?= htmlspecialchars($alamat_checkout->nama_provinsi) ?> <?= htmlspecialchars($alamat_checkout->kode_pos) ?><?php endif; ?></p>
          </div>
        <?php else: ?>
          <div class="alert alert-warning">
            ⚠️ Belum ada alamat pengiriman. Silakan pilih alamat.
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Produk -->
    <div class="box">
      <h3>🛍️ Pesanan Anda</h3>

      <!-- Product 1 - WITH DISCOUNT -->
      <div class="product-item">
        <div class="product-img-wrapper">
          <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=400&fit=crop" class="product-img" alt="Nike Air Max">
          <div class="product-discount-badge">-30%</div>
        </div>
        <div class="product-info">
          <h4 class="product-name">Nike Air Max 270</h4>
          <div class="product-variant">
            <span>📏 Ukuran: 42</span>
            <span>🎨 Warna: Hitam</span>
          </div>
          <div class="product-price-row">
            <div class="product-qty-display">
              <span class="qty-label">Jumlah:</span>
              <span class="qty-value">1</span>
            </div>
            <div class="product-prices">
              <span class="product-price-original">Rp 1.500.000</span>
              <span class="product-price">Rp 1.050.000</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Product 2 - NO DISCOUNT -->
      <div class="product-item">
        <div class="product-img-wrapper">
          <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&h=400&fit=crop" class="product-img" alt="Adidas Ultraboost">
        </div>
        <div class="product-info">
          <h4 class="product-name">Adidas Ultraboost 21</h4>
          <div class="product-variant">
            <span>📏 Ukuran: 41</span>
            <span>🎨 Warna: Putih</span>
          </div>
          <div class="product-price-row">
            <div class="product-qty-display">
              <span class="qty-label">Jumlah:</span>
              <span class="qty-value">2</span>
            </div>
            <div class="product-prices">
              <span class="product-price no-discount">Rp 3.800.000</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Product 3 - WITH DISCOUNT -->
      <div class="product-item">
        <div class="product-img-wrapper">
          <img src="https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=400&h=400&fit=crop" class="product-img" alt="Converse Chuck Taylor">
          <div class="product-discount-badge">-25%</div>
        </div>
        <div class="product-info">
          <h4 class="product-name">Converse Chuck Taylor All Star</h4>
          <div class="product-variant">
            <span>📏 Ukuran: 40</span>
            <span>🎨 Warna: Merah</span>
          </div>
          <div class="product-price-row">
            <div class="product-qty-display">
              <span class="qty-label">Jumlah:</span>
              <span class="qty-value">1</span>
            </div>
            <div class="product-prices">
              <span class="product-price-original">Rp 800.000</span>
              <span class="product-price">Rp 600.000</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="checkout-right">
    
    <!-- Ringkasan -->
    <div class="box">
      <h3>📋 Ringkasan Belanja</h3>

      <div class="summary-row total-before">
        <span class="label">Total Harga (3 item)</span>
        <span class="value" id="total-before">Rp 6.100.000</span>
      </div>

      <div class="summary-row discount">
        <span class="label">💸 Diskon Produk</span>
        <span class="value" id="product-discount">- Rp 650.000</span>
      </div>

      <div class="summary-row subtotal">
        <span class="label">Subtotal</span>
        <span class="value" id="subtotal">Rp 5.450.000</span>
      </div>

      <div class="summary-row">
        <span class="label">🚚 Ongkir</span>
        <span class="value" id="shipping">Rp 25.000</span>
      </div>

      <div class="summary-row voucher-discount" id="voucher-discount-row" style="display: none;">
        <span class="label">🎁 Diskon Voucher</span>
        <span class="value" id="voucher-discount">- Rp 0</span>
      </div>

      <div class="summary-row total">
        <span class="label">Total</span>
        <span class="value" id="total">Rp 5.475.000</span>
      </div>

      <button class="btn-promo-trigger" id="btn-open-promo">
        🎁 Pakai Promo / Voucher
      </button>

      <button class="btn-checkout" id="btn-checkout">
        <span>💳</span>
        <span>Bayar Sekarang</span>
      </button>
    </div>

  </div>
</div>

<!-- Off-Canvas Promo -->
<div class="offcanvas-overlay" id="offcanvas-overlay"></div>
<div class="offcanvas" id="offcanvas-promo">
  <div class="offcanvas-header">
    <h3>🎁 Promo & Voucher</h3>
    <button class="offcanvas-close" id="offcanvas-close">×</button>
  </div>
  <div class="offcanvas-body">
    <div id="promo-container">
      <!-- Input Promo -->
      <div class="promo-input-group">
        <input type="text" class="promo-input" id="promo-code" placeholder="Masukkan kode promo">
        <button class="btn-apply-promo" id="btn-apply-promo">Pakai</button>
      </div>

      <!-- Available Vouchers -->
      <div class="voucher-section-title">✨ Voucher Tersedia</div>

      <!-- Voucher 1 -->
      <div class="voucher-card" data-code="DISKON10" data-type="percentage" data-value="10">
        <div class="voucher-left">
          <div class="voucher-icon">10%</div>
          <div class="voucher-info">
            <div class="voucher-title">Diskon 10%</div>
            <div class="voucher-desc">Potongan 10% untuk semua produk</div>
            <div class="voucher-valid">Berlaku hingga 31 Jan 2026</div>
          </div>
        </div>
        <button class="btn-use-voucher" onclick="applyVoucher('DISKON10', 'percentage', 10)">
          Pakai
        </button>
      </div>

      <!-- Voucher 2 -->
      <div class="voucher-card" data-code="GRATIS50" data-type="fixed" data-value="50000">
        <div class="voucher-left">
          <div class="voucher-icon">50K</div>
          <div class="voucher-info">
            <div class="voucher-title">Potongan Rp 50.000</div>
            <div class="voucher-desc">Untuk pembelian min. Rp 500.000</div>
            <div class="voucher-valid">Berlaku hingga 28 Feb 2026</div>
          </div>
        </div>
        <button class="btn-use-voucher" onclick="applyVoucher('GRATIS50', 'fixed', 50000)">
          Pakai
        </button>
      </div>

      <!-- Voucher 3 -->
      <div class="voucher-card" data-code="FREEONGKIR" data-type="shipping" data-value="0">
        <div class="voucher-left">
          <div class="voucher-icon">🚚</div>
          <div class="voucher-info">
            <div class="voucher-title">Gratis Ongkir</div>
            <div class="voucher-desc">Bebas biaya pengiriman</div>
            <div class="voucher-valid">Berlaku hingga 15 Feb 2026</div>
          </div>
        </div>
        <button class="btn-use-voucher" onclick="applyVoucher('FREEONGKIR', 'shipping', 0)">
          Pakai
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Alamat -->
<div id="alamat-modal" class="modal" aria-hidden="true">
  <div class="modal-overlay" id="modal-overlay"></div>
  <div class="modal-content">
    <button class="modal-close" id="modal-close">×</button>
    <h3>Pilih Alamat Pengiriman</h3>

    <div id="address-list-container">
      <?php if (!empty($alamat_list)): ?>
        <?php foreach ($alamat_list as $alamat): ?>
          <?php 
          $is_selected = false;
          if ($this->session->userdata('id_alamat_checkout')) {
              $is_selected = ($alamat->id_alamat == $this->session->userdata('id_alamat_checkout'));
          } else {
              $is_selected = ($alamat->is_default == 1);
          }
          ?>
          
          <div class="address-card <?= $is_selected ? 'active' : '' ?>" data-id="<?= $alamat->id_alamat ?>">
            <div class="address-info">
              <strong>
                <?= htmlspecialchars($alamat->nama_alamat) ?>
                <?php if ($alamat->is_default == 1): ?>
                  <span style="color: var(--success); font-size: 0.875rem;">⭐ Utama</span>
                <?php endif; ?>
                <?php if ($is_selected && $alamat->is_default != 1): ?>
                  <span style="color: var(--primary); font-size: 0.875rem;">✓ Dipilih</span>
                <?php endif; ?>
              </strong>
              <div class="address-detail">
                <div class="address-detail-section">
                  <span class="address-detail-label">Nama Penerima</span>
                  <strong><?= htmlspecialchars($alamat->nama_penerima ?? '-') ?></strong>
                </div>
                
                <div class="address-detail-section">
                  <span class="address-detail-label">Nomor Telepon</span>
                  <span>📱 <?= htmlspecialchars($alamat->nomor_telp_penerima ?? '-') ?></span>
                </div>
                
                <div class="address-detail-section">
                  <span class="address-detail-label">Detail Alamat</span>
                  <span><?= htmlspecialchars($alamat->detail) ?></span>
                </div>
                
                <?php if (!empty($alamat->nama_kelurahan)): ?>
                  <div class="address-detail-section">
                    <span class="address-detail-label">Wilayah</span>
                    <span>
                      <?= htmlspecialchars($alamat->nama_kelurahan) ?>, 
                      <?= htmlspecialchars($alamat->nama_kecamatan) ?>,
                      <?= htmlspecialchars($alamat->nama_kabupaten) ?>, 
                      <?= htmlspecialchars($alamat->nama_provinsi) ?>,
                      <?= htmlspecialchars($alamat->kode_pos) ?>
                    </span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <button 
              class="btn-use-address" 
              data-id="<?= $alamat->id_alamat ?>"
              <?= $is_selected ? 'disabled' : '' ?>>
              <?= $is_selected ? 'Terpilih' : 'Pilih' ?>
            </button>
          </div>
        <?php endforeach; ?>
        
        <!-- Tombol Tambah Alamat Baru -->
        <a href="<?= base_url('alamat') ?>" class="btn-add-new-address">
          <span>➕</span>
          <span>Tambah Alamat Baru</span>
        </a>
        
      <?php else: ?>
        <div style="text-align: center; padding: 2rem;">
          <p style="color: var(--muted); margin-bottom: 1rem;">📍 Anda belum memiliki alamat</p>
          <a href="<?= base_url('alamat') ?>" class="btn btn-primary">Tambah Alamat</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Payment Modal -->
<div id="payment-modal" class="modal" aria-hidden="true">
  <div class="modal-overlay" onclick="closePaymentModal()"></div>
  <div class="modal-content payment-modal-content">
    <button class="modal-close" onclick="closePaymentModal()">×</button>
    
    <div class="payment-header">
      <h2>Pilih Metode Pembayaran</h2>
      <p style="color: var(--text-secondary); font-size: 0.9375rem; font-weight: 500;">Total yang harus dibayar</p>
      <div class="payment-amount" id="payment-amount-display">Rp 5.475.000</div>
    </div>

    <div class="payment-methods">
      <div class="payment-method-title">E-Wallet</div>
      
      <label class="payment-option" for="gopay">
        <input type="radio" name="payment" id="gopay" value="gopay">
        <div class="payment-icon" style="background: linear-gradient(135deg, #00AA13 0%, #00D41D 100%);">
          💚
        </div>
        <div class="payment-details">
          <div class="payment-name">GoPay</div>
          <div class="payment-desc">Bayar pakai saldo GoPay</div>
        </div>
      </label>

      <label class="payment-option" for="ovo">
        <input type="radio" name="payment" id="ovo" value="ovo">
        <div class="payment-icon" style="background: linear-gradient(135deg, #4C3494 0%, #6B4AB8 100%);">
          💜
        </div>
        <div class="payment-details">
          <div class="payment-name">OVO</div>
          <div class="payment-desc">Bayar pakai saldo OVO</div>
        </div>
      </label>

      <label class="payment-option" for="dana">
        <input type="radio" name="payment" id="dana" value="dana">
        <div class="payment-icon" style="background: linear-gradient(135deg, #118EEA 0%, #3DA5F4 100%);">
          💙
        </div>
        <div class="payment-details">
          <div class="payment-name">DANA</div>
          <div class="payment-desc">Bayar pakai saldo DANA</div>
        </div>
      </label>

      <div class="payment-method-title" style="margin-top: 1.5rem;">Transfer Bank</div>

      <label class="payment-option" for="bca">
        <input type="radio" name="payment" id="bca" value="bca">
        <div class="payment-icon" style="background: linear-gradient(135deg, #0066AE 0%, #0080D6 100%);">
          🏦
        </div>
        <div class="payment-details">
          <div class="payment-name">Bank BCA</div>
          <div class="payment-desc">Transfer via BCA Virtual Account</div>
        </div>
      </label>

      <label class="payment-option" for="mandiri">
        <input type="radio" name="payment" id="mandiri" value="mandiri">
        <div class="payment-icon" style="background: linear-gradient(135deg, #003D79 0%, #00529C 100%);">
          🏧
        </div>
        <div class="payment-details">
          <div class="payment-name">Bank Mandiri</div>
          <div class="payment-desc">Transfer via Mandiri Virtual Account</div>
        </div>
      </label>
    </div>

    <button class="btn-confirm-payment" id="btn-confirm-payment" disabled>
      Konfirmasi Pembayaran
    </button>
  </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="modal" aria-hidden="true">
  <div class="modal-overlay"></div>
  <div class="modal-content payment-modal-content">
    
    <div class="success-icon-wrapper">
      <div class="success-icon">✓</div>
    </div>

    <div class="success-content">
      <h2>Pembayaran Berhasil!</h2>
      <p>Terima kasih atas pesanan Anda</p>

      <div class="order-id">
        <span>📋</span>
        <span id="generated-order-id">ORDER-2026-001234</span>
      </div>

      <div class="order-details">
        <div class="order-detail-row">
          <span class="order-detail-label">Metode Pembayaran</span>
          <span class="order-detail-value" id="selected-payment-method">-</span>
        </div>
        <div class="order-detail-row">
          <span class="order-detail-label">Total Pembayaran</span>
          <span class="order-detail-value" id="paid-amount">Rp 0</span>
        </div>
        <div class="order-detail-row">
          <span class="order-detail-label">Waktu Pembayaran</span>
          <span class="order-detail-value" id="payment-time">-</span>
        </div>
        <div class="order-detail-row">
          <span class="order-detail-label">Status</span>
          <span class="order-detail-value" style="color: var(--success);">✓ Lunas</span>
        </div>
      </div>

      <button class="btn-success-action" onclick="trackOrder()">
        📦 Lacak Pesanan
      </button>
      <button class="btn-secondary-action" onclick="continueShopping()">
        🛍️ Lanjut Belanja
      </button>
    </div>
  </div>
</div>

<script>
// State - UPDATED PRICING
const state = {
  totalBefore: 6100000,  // Total harga sebelum diskon produk
  productDiscount: 650000,  // Diskon dari produk (30% Nike + 25% Converse)
  subtotal: 5450000,  // Setelah diskon produk
  shipping: 25000,
  voucherDiscount: 0,  // Diskon dari voucher
  promoCode: null,
  selectedPayment: null
};

// Format Rupiah
function formatRupiah(amount) {
  return 'Rp ' + amount.toLocaleString('id-ID');
}

// Calculate Total
function calculateTotal() {
  return state.subtotal + state.shipping - state.voucherDiscount;
}

// Update Display
function updatePriceDisplay() {
  document.getElementById('total-before').textContent = formatRupiah(state.totalBefore);
  document.getElementById('product-discount').textContent = '- ' + formatRupiah(state.productDiscount);
  document.getElementById('subtotal').textContent = formatRupiah(state.subtotal);
  document.getElementById('shipping').textContent = formatRupiah(state.shipping);
  document.getElementById('total').textContent = formatRupiah(calculateTotal());

  const voucherDiscountRow = document.getElementById('voucher-discount-row');
  if (state.voucherDiscount > 0) {
    voucherDiscountRow.style.display = 'flex';
    document.getElementById('voucher-discount').textContent = '- ' + formatRupiah(state.voucherDiscount);
  } else {
    voucherDiscountRow.style.display = 'none';
  }

  // Update payment modal amount
  const paymentAmount = document.getElementById('payment-amount-display');
  if (paymentAmount) {
    paymentAmount.textContent = formatRupiah(calculateTotal());
  }
}

// Apply Promo (dari input)
function applyPromo(code) {
  code = code.toUpperCase().trim();
  
  const promos = {
    'DISKON10': { type: 'percentage', value: 10, desc: 'Diskon 10%' },
    'GRATIS50': { type: 'fixed', value: 50000, desc: 'Potongan Rp 50.000' },
    'FREEONGKIR': { type: 'shipping', value: 0, desc: 'Gratis Ongkir' }
  };

  if (!promos[code]) {
    showNotification('❌ Kode promo tidak valid', 'error');
    return;
  }

  const promo = promos[code];
  applyDiscount(code, promo.type, promo.value, promo.desc);
}

// Apply Voucher (dari card)
function applyVoucher(code, type, value) {
  let desc = '';
  if (type === 'percentage') desc = `Diskon ${value}%`;
  else if (type === 'fixed') desc = `Potongan Rp ${value.toLocaleString('id-ID')}`;
  else if (type === 'shipping') desc = 'Gratis Ongkir';

  applyDiscount(code, type, value, desc);
}

// Core Apply Discount - UPDATED
function applyDiscount(code, type, value, description) {
  let discountAmount = 0;

  if (type === 'percentage') {
    discountAmount = Math.floor(state.subtotal * (value / 100));
  } else if (type === 'fixed') {
    discountAmount = value;
  } else if (type === 'shipping') {
    discountAmount = state.shipping;
    state.shipping = 0;
  }

  state.voucherDiscount = discountAmount;
  state.promoCode = code;

  // Update UI - Replace entire promo container
  const promoContainer = document.getElementById('promo-container');
  promoContainer.innerHTML = `
    <div class="promo-applied">
      <div class="promo-applied-info">
        <div class="promo-icon">🎉</div>
        <div class="promo-text">
          <strong>${code}</strong>
          <small>${description} diterapkan</small>
        </div>
      </div>
      <button class="btn-remove-promo" onclick="removePromo()">Hapus</button>
    </div>
  `;

  updatePriceDisplay();
  showNotification('✅ Voucher berhasil diterapkan!', 'success');
  
  // Close offcanvas after applying
  closeOffcanvas();
}

// Remove Promo - UPDATED
function removePromo() {
  state.voucherDiscount = 0;
  state.shipping = 25000;
  state.promoCode = null;

  const promoContainer = document.getElementById('promo-container');
  promoContainer.innerHTML = `
    <div class="promo-input-group">
      <input type="text" class="promo-input" id="promo-code" placeholder="Masukkan kode promo">
      <button class="btn-apply-promo" id="btn-apply-promo">Pakai</button>
    </div>

    <div class="voucher-section-title">✨ Voucher Tersedia</div>

    <div class="voucher-card">
      <div class="voucher-left">
        <div class="voucher-icon">10%</div>
        <div class="voucher-info">
          <div class="voucher-title">Diskon 10%</div>
          <div class="voucher-desc">Potongan 10% untuk semua produk</div>
          <div class="voucher-valid">Berlaku hingga 31 Jan 2026</div>
        </div>
      </div>
      <button class="btn-use-voucher" onclick="applyVoucher('DISKON10', 'percentage', 10)">
        Pakai
      </button>
    </div>

    <div class="voucher-card">
      <div class="voucher-left">
        <div class="voucher-icon">50K</div>
        <div class="voucher-info">
          <div class="voucher-title">Potongan Rp 50.000</div>
          <div class="voucher-desc">Untuk pembelian min. Rp 500.000</div>
          <div class="voucher-valid">Berlaku hingga 28 Feb 2026</div>
        </div>
      </div>
      <button class="btn-use-voucher" onclick="applyVoucher('GRATIS50', 'fixed', 50000)">
        Pakai
      </button>
    </div>

    <div class="voucher-card">
      <div class="voucher-left">
        <div class="voucher-icon">🚚</div>
        <div class="voucher-info">
          <div class="voucher-title">Gratis Ongkir</div>
          <div class="voucher-desc">Bebas biaya pengiriman</div>
          <div class="voucher-valid">Berlaku hingga 15 Feb 2026</div>
        </div>
      </div>
      <button class="btn-use-voucher" onclick="applyVoucher('FREEONGKIR', 'shipping', 0)">
        Pakai
      </button>
    </div>
  `;

  // Re-attach input event
  attachPromoEvents();

  updatePriceDisplay();
  showNotification('ℹ️ Voucher dihapus', 'info');
}

// Attach Promo Events
function attachPromoEvents() {
  const btnApplyPromo = document.getElementById('btn-apply-promo');
  if (btnApplyPromo) {
    btnApplyPromo.addEventListener('click', function() {
      const code = document.getElementById('promo-code').value;
      if (code) applyPromo(code);
    });
  }

  const promoInput = document.getElementById('promo-code');
  if (promoInput) {
    promoInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        const code = this.value;
        if (code) applyPromo(code);
      }
    });
  }
}

// Off-canvas Functions
function openOffcanvas() {
  document.getElementById('offcanvas-overlay').classList.add('active');
  document.getElementById('offcanvas-promo').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeOffcanvas() {
  document.getElementById('offcanvas-overlay').classList.remove('active');
  document.getElementById('offcanvas-promo').classList.remove('active');
  document.body.style.overflow = '';
}

// Modal
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }
}

// Payment Modal Functions
function openPaymentModal() {
  openModal('payment-modal');
  updatePriceDisplay();
}

function closePaymentModal() {
  closeModal('payment-modal');
  state.selectedPayment = null;
  document.querySelectorAll('input[name="payment"]').forEach(input => {
    input.checked = false;
  });
  document.querySelectorAll('.payment-option').forEach(option => {
    option.classList.remove('selected');
  });
  document.getElementById('btn-confirm-payment').disabled = true;
}

// Process Payment
function processPayment() {
  if (!state.selectedPayment) {
    showNotification('⚠️ Pilih metode pembayaran terlebih dahulu', 'error');
    return;
  }

  const btnConfirm = document.getElementById('btn-confirm-payment');
  btnConfirm.innerHTML = '<span class="spinner"></span> Memproses...';
  btnConfirm.disabled = true;

  setTimeout(() => {
    closePaymentModal();
    showPaymentSuccess();
  }, 2000);
}

// Show Payment Success
function showPaymentSuccess() {
  const orderId = 'ORDER-' + new Date().getFullYear() + '-' + Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
  document.getElementById('generated-order-id').textContent = orderId;

  const paymentMethods = {
    'gopay': 'GoPay',
    'ovo': 'OVO',
    'dana': 'DANA',
    'bca': 'Bank BCA',
    'mandiri': 'Bank Mandiri',
  };
  
  document.getElementById('selected-payment-method').textContent = paymentMethods[state.selectedPayment] || state.selectedPayment;
  document.getElementById('paid-amount').textContent = formatRupiah(calculateTotal());
  
  const now = new Date();
  const options = { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
  document.getElementById('payment-time').textContent = now.toLocaleDateString('id-ID', options) + ' WIB';

  openModal('success-modal');
}

// Track Order
function trackOrder() {
  closeModal('success-modal');
  showNotification('📦 Membuka halaman pelacakan pesanan...', 'info');
}

// Continue Shopping
function continueShopping() {
  closeModal('success-modal');
  showNotification('🛍️ Kembali ke halaman belanja...', 'info');
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
  
  // Off-canvas triggers
  const btnOpenPromo = document.getElementById('btn-open-promo');
  if (btnOpenPromo) {
    btnOpenPromo.addEventListener('click', openOffcanvas);
  }

  const offcanvasClose = document.getElementById('offcanvas-close');
  if (offcanvasClose) {
    offcanvasClose.addEventListener('click', closeOffcanvas);
  }

  const offcanvasOverlay = document.getElementById('offcanvas-overlay');
  if (offcanvasOverlay) {
    offcanvasOverlay.addEventListener('click', closeOffcanvas);
  }

  // Promo events
  attachPromoEvents();

  // Open address modal
  const btnOpenModal = document.getElementById('btn-open-modal');
  if (btnOpenModal) {
    btnOpenModal.addEventListener('click', function(e) {
      e.preventDefault();
      openModal('alamat-modal');
    });
  }
  
  // Close address modal
  const modalClose = document.getElementById('modal-close');
  if (modalClose) {
    modalClose.addEventListener('click', function() {
      closeModal('alamat-modal');
    });
  }
  
  const modalOverlay = document.getElementById('modal-overlay');
  if (modalOverlay) {
    modalOverlay.addEventListener('click', function() {
      closeModal('alamat-modal');
    });
  }
  
  // Address buttons
  const addressListContainer = document.getElementById('address-list-container');
  if (addressListContainer) {
    addressListContainer.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-use-address') && !e.target.disabled) {
        const alamatId = e.target.getAttribute('data-id');
        setAlamat(alamatId, e.target);
      }
    });
  }
  
  // Checkout button
  const btnCheckout = document.getElementById('btn-checkout');
  if (btnCheckout) {
    btnCheckout.addEventListener('click', function() {
      openPaymentModal();
    });
  }

  // Payment method selection
  const paymentOptions = document.querySelectorAll('.payment-option');
  paymentOptions.forEach(option => {
    option.addEventListener('click', function() {
      const radio = this.querySelector('input[type="radio"]');
      radio.checked = true;
      
      paymentOptions.forEach(opt => opt.classList.remove('selected'));
      this.classList.add('selected');
      
      state.selectedPayment = radio.value;
      document.getElementById('btn-confirm-payment').disabled = false;
    });
  });

  // Confirm payment button
  const btnConfirmPayment = document.getElementById('btn-confirm-payment');
  if (btnConfirmPayment) {
    btnConfirmPayment.addEventListener('click', processPayment);
  }

  // Keyboard
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeModal('alamat-modal');
      closePaymentModal();
      closeOffcanvas();
    }
  });

  // Init
  updatePriceDisplay();
});

// ORIGINAL DATABASE FUNCTIONS
function setAlamat(id_alamat, button) {
  const originalText = button.innerHTML;
  
  button.innerHTML = '<span class="spinner"></span> Memproses...';
  button.disabled = true;

  const url = "<?= base_url('index.php/checkout/set_alamat') ?>";

  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      "X-Requested-With": "XMLHttpRequest"
    },
    body: "id_alamat=" + encodeURIComponent(id_alamat)
  })
  .then(res => {
    if (!res.ok) {
      throw new Error(`HTTP ${res.status}`);
    }
    return res.json();
  })
  .then(data => {
    if (data.status === 'ok') {
      showNotification('✅ ' + data.message, 'success');
      
      if (data.alamat) {
        updateAddressDisplay(data.alamat);
        updateModalAddressList(id_alamat);
      }
      
      setTimeout(() => {
        closeModal('alamat-modal');
      }, 500);
    } else {
      showNotification('❌ ' + data.message, 'error');
      button.innerHTML = originalText;
      button.disabled = false;
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('❌ Terjadi kesalahan', 'error');
    button.innerHTML = originalText;
    button.disabled = false;
  });
}

function updateAddressDisplay(alamat) {
  const addressDisplay = document.getElementById('address-display-main');
  if (!addressDisplay) return;
  
  let wilayahText = '';
  if (alamat.nama_kelurahan) {
    wilayahText = `, ${escapeHtml(alamat.nama_kelurahan)}, ${escapeHtml(alamat.nama_kecamatan)}, ${escapeHtml(alamat.nama_kabupaten)}, ${escapeHtml(alamat.nama_provinsi)} ${escapeHtml(alamat.kode_pos)}`;
  }
  
  addressDisplay.innerHTML = `
    <div class="address-label">
      <span>📍</span>
      <span>Alamat Pengiriman</span>
    </div>
    <div class="address-content">
      <h4 class="address-name">${escapeHtml(alamat.nama_alamat || '-')}</h4>
      <div class="address-recipient">
        <span>👤</span>
        <strong>${escapeHtml(alamat.nama_penerima || '-')}</strong>
        <span class="phone">📱 ${escapeHtml(alamat.nomor_telp_penerima || '-')}</span>
      </div>
      <p class="address-detail">${escapeHtml(alamat.detail)}${wilayahText}</p>
    </div>
  `;
}

function updateModalAddressList(selected_id) {
  const addressCards = document.querySelectorAll('.address-card');
  
  // First pass: Reset ALL cards and buttons to default state
  addressCards.forEach(card => {
    const button = card.querySelector('.btn-use-address');
    const addressInfo = card.querySelector('.address-info strong');
    
    // Remove ALL selection badges
    const badges = addressInfo.querySelectorAll('span');
    badges.forEach(badge => {
      const text = badge.textContent;
      if (text.includes('Dipilih') || text.includes('✓') || text.includes('Terpilih')) {
        badge.remove();
      }
    });
    
    // Reset card state
    card.classList.remove('active');
    
    // Reset button to default state
    if (button) {
      button.disabled = false;
      button.textContent = 'Pilih';
      button.style.background = '';
      button.style.cursor = '';
    }
  });
  
  // Second pass: Update ONLY the selected card
  addressCards.forEach(card => {
    const cardId = card.getAttribute('data-id');
    
    if (cardId == selected_id) {
      const button = card.querySelector('.btn-use-address');
      const addressInfo = card.querySelector('.address-info strong');
      
      // Activate card
      card.classList.add('active');
      
      // Disable and update button
      if (button) {
        button.disabled = true;
        button.textContent = 'Terpilih';
      }
      
      // Add badge only if not "Utama"
      const remainingBadges = addressInfo.querySelectorAll('span');
      const hasUtamaBadge = Array.from(remainingBadges).some(b => 
        b.textContent.includes('Utama') || b.textContent.includes('⭐')
      );
      
      if (!hasUtamaBadge) {
        const badge = document.createElement('span');
        badge.style.cssText = 'color: var(--primary); font-size: 0.875rem;';
        badge.textContent = ' ✓ Dipilih';
        addressInfo.appendChild(badge);
      }
    }
  });
}

function escapeHtml(text) {
  if (!text) return '';
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return String(text).replace(/[&<>"']/g, m => map[m]);
}

function showNotification(message, type = 'info') {
  const notification = document.createElement('div');
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1.25rem 1.75rem;
    background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#6366f1'};
    color: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    z-index: 10001;
    animation: slideInRight 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    font-size: 0.9375rem;
    font-weight: 600;
    max-width: 350px;
  `;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.animation = 'slideOutRight 0.3s ease forwards';
    setTimeout(() => notification.remove(), 300);
  }, 3500);
}
</script>

</body>
</html>