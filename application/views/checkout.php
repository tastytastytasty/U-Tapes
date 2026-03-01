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
    
    html {
      scroll-behavior: smooth;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html,
    body {
      overflow-x: hidden;
    }

    body {
      font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: #ffffff;
      color: var(--text);
      line-height: 1.6;
      overflow-x: hidden;
    }

    .checkout-wrapper {
      max-width: 1200px;
      margin: 2rem auto 3rem;
      display: grid;
      grid-template-columns: 1fr 420px;
      gap: 2rem;
      padding: 0;
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
      border-color: var(--primary);
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

    .btn-primary:disabled {
      background: var(--muted);
      cursor: not-allowed;
      opacity: 0.6;
      transform: none;
    }

    .btn-secondary {
      background: white;
      color: var(--text);
      border: 2px solid var(--border);
    }

    .btn-secondary:hover {
      background: var(--bg);
    }

    /* Address Display */
    .address-display {
      padding: 0;
      background: transparent;
      border: none;
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

    /* Product Item */
    .product-item {
      display: grid;
      grid-template-columns: 100px 1fr; /* UPDATED: Hapus kolom checkbox */
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
      background: var(--bg); /* Fallback kalau img ga load */
    }
    
    /* Fallback untuk broken image */
    .product-img[data-errored="1"] {
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .product-img[data-errored="1"]::before {
      content: '🖼️';
      font-size: 2rem;
      opacity: 0.3;
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

    .promo-buttons-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
    }

    .btn-promo-trigger {
      padding: 1rem;
      border: 2px dashed #f59e0b;
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      flex-direction: column;
      text-align: center;
    }

    .btn-promo-item {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .btn-promo-item:hover {
      background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    .btn-promo-shipping {
      background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
      color: #1e40af;
      border-color: #3b82f6;
    }

    .btn-promo-shipping:hover {
      background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    .btn-promo-trigger .promo-icon {
      font-size: 1.5rem;
    }

    .btn-promo-trigger .promo-text {
      font-size: 0.875rem;
      line-height: 1.2;
    }

    .btn-promo-trigger.active {
      border-style: solid;
      padding: 0.875rem;
    }

    .btn-promo-item.active {
      background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
      border-color: #10b981;
      color: #065f46;
    }

    .btn-promo-item.active:hover {
      background: linear-gradient(135deg, #bbf7d0 0%, #86efac 100%);
    }

    .btn-promo-shipping.active {
      background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);
      border-color: #3b82f6;
      color: #1e3a8a;
    }

    .btn-promo-shipping.active:hover {
      background: linear-gradient(135deg, #93c5fd 0%, #60a5fa 100%);
    }

    .btn-promo-trigger.active .promo-icon {
      font-size: 1.25rem;
    }

    .btn-promo-trigger.active .promo-code {
      font-weight: 800;
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: 0.125rem;
    }

    .btn-promo-trigger.active .promo-text {
      font-size: 0.75rem;
      font-weight: 500;
      opacity: 0.8;
    }

    /* Summary */
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

    .summary-row.total .value {
      color: var(--primary);
      font-size: 1.75rem;
      font-weight: 800;
    }

    .summary-section {
      border: 2px solid var(--border);
      border-radius: var(--radius-sm);
      margin-bottom: 1rem;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .summary-section:hover {
      border-color: var(--primary);
    }

    .summary-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 1.25rem;
      background: var(--bg);
      cursor: pointer;
      transition: all 0.3s ease;
      user-select: none;
    }

    .summary-header:hover {
      background: var(--primary-light);
    }

    .summary-header.active {
      background: var(--primary-light);
      border-bottom: 2px solid var(--border);
    }

    .summary-header-left {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .summary-header-icon {
      font-size: 1rem;
      transition: transform 0.3s ease;
      color: var(--primary);
    }

    .summary-header.active .summary-header-icon {
      transform: rotate(180deg);
    }

    .summary-header-title {
      font-size: 0.9375rem;
      font-weight: 600;
      color: var(--text);
    }

    .summary-header-value {
      font-size: 1rem;
      font-weight: 700;
      color: var(--primary);
    }

    .summary-body {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
      background: white;
    }

    .summary-body.active {
      max-height: 500px;
    }

    .summary-body-content {
      padding: 1rem 1.25rem;
    }

    .summary-detail-row {
      display: flex;
      justify-content: space-between;
      padding: 0.75rem 0;
      font-size: 0.875rem;
      border-bottom: 1px solid var(--bg-secondary);
    }

    .summary-detail-row:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .summary-detail-row .label {
      color: var(--text-secondary);
      font-weight: 500;
    }

    .summary-detail-row .value {
      font-weight: 600;
      color: var(--text);
    }

    .summary-detail-row.discount .value {
      color: var(--success);
    }

    .summary-detail-row.voucher .value {
      color: var(--primary);
    }

    .summary-total-section {
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 3px solid var(--border);
    }

    .summary-total-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
    }

    .summary-total-row .label {
      font-size: 1.125rem;
      font-weight: 700;
      color: var(--text);
    }

    .summary-total-row .value {
      font-size: 1.75rem;
      font-weight: 800;
      color: var(--primary);
      background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
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
      margin-bottom: 1.5rem;
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
      margin-top: 1rem;
    }

    .btn-checkout:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
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

    /* Address Card */
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
      opacity: 0.7;
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
      cursor: pointer;
    }

    .btn-add-new-address:hover {
      background: white;
      border-style: solid;
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }

    /* Form Styles */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .form-grid .full {
      grid-column: 1 / -1;
    }

    .form-group {
      margin-bottom: 0.5rem;
    }

    .form-group label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--text);
    }

    .form-group label.required::after {
      content: '*';
      color: var(--danger);
      margin-left: 0.25rem;
    }

    .form-group input[type="text"],
    .form-group input[type="tel"] {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 2px solid var(--border);
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      font-family: inherit;
      transition: all 0.3s;
    }

    .form-group input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .modal-actions {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
      margin-top: 2rem;
      padding-top: 1.5rem;
      border-top: 2px solid var(--border);
    }

    #modalAlamat h3 {
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid var(--border);
    }

    /* Custom Dropdown */
    .dropdown-box {
      position: relative;
      width: 100%;
    }

    .dropdown-selected {
      padding: 0.75rem 1rem;
      border: 2px solid var(--border);
      border-radius: var(--radius-sm);
      cursor: pointer;
      background: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.3s;
      font-size: 0.9375rem;
    }

    .dropdown-selected:hover {
      border-color: var(--primary);
    }

    .dropdown-selected::after {
      content: '▼';
      font-size: 0.75rem;
      color: var(--muted);
    }

    .dropdown-list {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 2px solid var(--border);
      border-radius: var(--radius-sm);
      margin-top: 0.25rem;
      max-height: 300px;
      overflow-y: auto;
      display: none;
      z-index: 1000;
      box-shadow: var(--shadow-lg);
    }

    .dropdown-list.active {
      display: block;
    }

    .dropdown-list input {
      width: 100%;
      padding: 0.75rem;
      border: none;
      border-bottom: 2px solid var(--border);
      outline: none;
      font-family: inherit;
    }

    .dropdown-items {
      max-height: 250px;
      overflow-y: auto;
    }

    .dropdown-item {
      padding: 0.75rem 1rem;
      cursor: pointer;
      transition: all 0.2s;
      font-size: 0.9375rem;
    }

    .dropdown-item:hover {
      background: var(--primary-light);
      color: var(--primary);
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
    }

    .alert {
      padding: 1rem;
      border-radius: var(--radius-sm);
      font-size: 0.9375rem;
      margin-bottom: 1rem;
    }

    .alert-warning {
      background: #fef3c7;
      border: 2px solid #f59e0b;
      color: #92400e;
    }

    /* Payment Modal */
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

    /* Success Modal */
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
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
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

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
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

    /* ============================================ */
/* RESPONSIVE STYLES - TAMBAHKAN DI AKHIR CSS  */
/* ============================================ */

/* Tablet and below (992px) */
@media (max-width: 992px) {
  .checkout-wrapper {
    grid-template-columns: 1fr;
    gap: 1.5rem;
    padding: 0;
    margin: 1.5rem auto 2rem;
  }

  .box {
    padding: 1.5rem;
    margin-bottom: 1rem;
  }

  .box h3 {
    font-size: 1.125rem;
  }

  .summary-total-row .value {
    font-size: 1.5rem;
  }

  .payment-amount {
    font-size: 1.875rem;
  }

  .success-content h2 {
    font-size: 1.5rem;
  }
}

/* Mobile (768px and below) */
@media (max-width: 768px) {
  .checkout-wrapper {
    padding: 0;
    margin: 1rem auto 1.5rem;
  }

  .box {
    padding: 1.25rem;
    border-radius: 12px;
  }

  .box-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.75rem;
  }

  .btn-link {
    width: 100%;
    justify-content: center;
  }

  /* Product items responsive */
  .product-item {
    grid-template-columns: 32px 70px 1fr; /* Checkbox lebih kecil, gambar lebih kecil */
    gap: 0.75rem;
    padding: 0.875rem;
  }
  
  .product-checkbox {
    width: 32px;
    height: 32px;
  }
  
  .item-checkbox {
    width: 18px;
    height: 18px;
  }

  .product-img-wrapper {
    width: 70px;
    height: 70px;
    padding-bottom: 0;
  }
  
  .product-img {
    position: static;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .product-name {
    font-size: 0.875rem;
    line-height: 1.3;
    -webkit-line-clamp: 2;
  }
  
  .product-variant {
    font-size: 0.75rem;
  }

  .product-variant {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.25rem;
  }

  .product-price-row {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }

  .product-prices {
    align-items: flex-start;
    flex-wrap: wrap;
  }
  
  .price-current {
    font-size: 1rem;
  }
  
  .price-original {
    font-size: 0.75rem;
  }

  /* Form grid responsive */
  .form-grid {
    grid-template-columns: 1fr;
  }

  /* Address card responsive */
  .address-card {
    flex-direction: column;
    align-items: stretch;
    padding: 1rem;
  }

  .address-info {
    width: 100%;
  }
  
  .address-name {
    font-size: 0.9375rem;
  }
  
  .address-phone {
    font-size: 0.875rem;
  }
  
  .address-detail {
    font-size: 0.8125rem;
    line-height: 1.4;
  }

  .btn-use-address {
    width: 100%;
    margin-top: 0.75rem;
  }

  /* Modal responsive */
  .modal-content {
    margin: 0;
    padding: 1.25rem;
    max-height: 100vh;
    width: 100%;
    border-radius: 0;
    overflow-y: auto;
  }

  .modal-close {
    right: 1rem;
    top: 1rem;
    width: 36px;
    height: 36px;
    font-size: 1.5rem;
  }
  
  .modal-header h2 {
    font-size: 1.25rem;
    padding-right: 2.5rem;
  }
  
  .modal-body {
    padding: 1rem 0;
  }
  
  /* Address list in modal */
  .address-list {
    gap: 0.75rem;
  }
  
  .address-card {
    padding: 1rem;
  }
  
  /* Form dalam modal */
  .form-group label {
    font-size: 0.875rem;
  }
  
  .form-group input,
  .form-group select,
  .form-group textarea {
    font-size: 0.9375rem;
    padding: 0.625rem 0.875rem;
  }
  
  .form-actions {
    flex-direction: column-reverse;
    gap: 0.75rem;
  }
  
  .form-actions .btn {
    width: 100%;
    margin: 0;
  }

  /* Payment modal responsive */
  .payment-modal-content {
    max-width: 100%;
  }

  .payment-header h2 {
    font-size: 1.5rem;
  }

  .payment-amount {
    font-size: 1.75rem;
  }

  .payment-option {
    padding: 1rem;
    flex-wrap: wrap;
  }

  .payment-icon {
    width: 50px;
    height: 50px;
    font-size: 1.5rem;
  }

  .payment-details {
    flex: 1;
    min-width: 150px;
  }

  .payment-name {
    font-size: 0.9375rem;
  }

  .payment-desc {
    font-size: 0.8125rem;
  }

  /* Offcanvas responsive */
  .offcanvas {
    width: 100%;
    max-width: 100%;
  }

  .offcanvas-header {
    padding: 1.5rem;
  }

  .offcanvas-header h3 {
    font-size: 1.25rem;
  }

  .offcanvas-body {
    padding: 1.5rem;
  }

  /* Voucher card responsive */
  .voucher-card {
    flex-direction: column;
    align-items: stretch;
  }

  .voucher-left {
    width: 100%;
  }

  .btn-use-voucher {
    width: 100%;
  }

  /* Promo buttons responsive */
  .promo-buttons-container {
    grid-template-columns: 1fr;
    gap: 0.5rem;
  }

  .btn-promo-trigger {
    padding: 0.875rem;
  }

  .btn-promo-trigger .promo-icon {
    font-size: 1.25rem;
  }

  .btn-promo-trigger .promo-text {
    font-size: 0.8125rem;
  }

  /* Promo input responsive */
  .promo-input-group {
    flex-direction: column;
  }

  .promo-input {
    width: 100%;
    min-width: 100%;
  }

  .btn-apply-promo {
    width: 100%;
  }

  .promo-applied {
    flex-wrap: wrap;
  }

  /* Summary responsive */
  .summary-header {
    padding: 0.875rem 1rem;
  }

  .summary-header-title {
    font-size: 0.875rem;
  }

  .summary-header-value {
    font-size: 0.9375rem;
  }

  .summary-body-content {
    padding: 0.875rem 1rem;
  }

  .summary-total-row .label {
    font-size: 1rem;
  }

  .summary-total-row .value {
    font-size: 1.5rem;
  }

  /* Success modal responsive */
  .success-icon {
    width: 100px;
    height: 100px;
    font-size: 3rem;
  }

  .success-content h2 {
    font-size: 1.5rem;
  }

  .success-content p {
    font-size: 0.9375rem;
  }

  .order-details {
    padding: 1.5rem;
  }

  .order-detail-row {
    flex-wrap: wrap;
  }

  .order-id {
    font-size: 1rem;
    padding: 0.625rem 1.25rem;
    flex-wrap: wrap;
    justify-content: center;
  }

  /* Modal actions responsive */
  .modal-actions {
    flex-direction: column;
  }

  .modal-actions .btn {
    width: 100%;
  }

  /* Button responsive */
  .btn {
    padding: 0.625rem 1.25rem;
    font-size: 0.875rem;
  }

  .btn-checkout {
    padding: 1rem;
    font-size: 1rem;
  }

  .summary-row.total-before {
    margin: 0 -1.25rem;
    padding: 1rem 1.25rem;
  }
  
  /* Summary section mobile */
  .summary-header {
    padding: 1rem;
  }
  
  .summary-header-title {
    font-size: 0.9375rem;
  }
  
  .summary-header-value {
    font-size: 1rem;
  }
  
  .summary-body {
    padding: 0.75rem 1rem;
  }
  
  .summary-detail-row {
    font-size: 0.875rem;
  }
  
  .summary-row.total {
    padding: 1rem;
  }
  
  .summary-row.total .label {
    font-size: 1rem;
  }
  
  .summary-row.total .value {
    font-size: 1.25rem;
  }
  
  /* ✨ BOTTOM SHEET - COLLAPSIBLE SUMMARY */
  .checkout-wrapper {
    padding-bottom: 100px; /* Space untuk bottom sheet collapsed */
  }
  
  .box:has(.summary-section) {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 10001; /* Di atas navbar (navbar = 1000) */
    margin: 0;
    border-radius: 20px 20px 0 0;
    box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
    background: white;
    transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    max-height: 130px; /* Default: collapsed - cuma total + tombol */
    overflow: hidden;
  }
  
  /* Expanded state */
  .box:has(.summary-section).expanded {
    max-height: calc(100vh - env(safe-area-inset-top, 60px)); /* Safe area untuk notch + navbar */
    overflow-y: auto;
    padding-top: calc(env(safe-area-inset-top, 0px) + 60px); /* Space untuk navbar */
  }
  
  /* Handle / drag indicator */
  .box:has(.summary-section)::before {
    content: '';
    position: absolute;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 4px;
    background: #cbd5e1;
    border-radius: 2px;
    cursor: grab;
  }
  
  /* Promo buttons - HIDE saat collapsed */
  .promo-buttons-container {
    display: none;
    gap: 0.5rem;
    margin: 0.5rem 1rem 0.75rem;
    padding-top: 0.5rem;
  }
  
  .expanded .promo-buttons-container {
    display: flex;
  }
  
  .btn-promo-trigger {
    flex: 1;
    padding: 0.625rem 0.75rem;
    font-size: 0.8125rem;
    min-width: 0;
  }
  
  .promo-icon {
    font-size: 1.125rem;
  }
  
  .promo-text {
    font-size: 0.8125rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  
  /* Summary sections - HIDE saat collapsed */
  .summary-section {
    display: none;
    margin-bottom: 0.5rem;
  }
  
  .expanded .summary-section {
    display: block;
  }
  
  .summary-header {
    padding: 0.875rem 1rem;
  }
  
  /* Total section - ALWAYS VISIBLE */
  .summary-total-section {
    padding: 1rem 1rem 0.75rem;
    background: white;
    cursor: pointer;
    transition: background 0.2s;
    margin-top: 1.5rem; /* Space for handle */
  }
  
  .summary-total-section:active {
    background: #f8fafc;
  }
  
  .summary-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .summary-total-row .label {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #1e293b;
  }
  
  .summary-total-row .value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
  }
  
  /* Tombol bayar - ALWAYS VISIBLE */
  .btn-checkout {
    margin: 0.75rem 1rem 1rem;
    padding: 1rem;
    font-size: 1rem;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
  }
  
  /* Overlay untuk close saat expanded */
  /* Overlay untuk close saat expanded */
  .summary-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    z-index: 10000; /* Di atas navbar (1000), di bawah bottom sheet (10001) */
    opacity: 0;
    transition: opacity 0.3s;
  }
  
  .summary-overlay.active {
    display: block;
    opacity: 1;
  }
}

/* Small mobile (480px and below) */
@media (max-width: 480px) {
  .box {
    padding: 1rem;
  }

  .box h3 {
    font-size: 1rem;
  }

  .product-item {
    grid-template-columns: 28px 60px 1fr; /* Checkbox + gambar lebih kecil */
    gap: 0.625rem;
    padding: 0.75rem;
  }
  
  .product-checkbox {
    width: 28px;
    height: 28px;
  }
  
  .item-checkbox {
    width: 16px;
    height: 16px;
  }

  .product-img-wrapper {
    width: 60px;
    height: 60px;
  }

  .product-name {
    font-size: 0.8125rem;
    line-height: 1.2;
  }

  .product-variant {
    font-size: 0.75rem;
  }

  .price-current {
    font-size: 0.9375rem;
  }

  .price-original {
    font-size: 0.6875rem;
  }
  
  /* Modal full screen di mobile kecil */
  .modal-content {
    border-radius: 0;
    margin: 0;
    width: 100vw;
    height: 100vh;
    max-height: 100vh;
    padding: 1rem;
  }
  
  .modal-header h2 {
    font-size: 1.125rem;
  }
  
  /* Address card lebih compact */
  .address-card {
    padding: 0.875rem;
  }
  
  .address-name {
    font-size: 0.875rem;
  }
  
  .address-phone {
    font-size: 0.8125rem;
  }
  
  .address-detail {
    font-size: 0.75rem;
  }

  .voucher-icon {
    width: 60px;
    height: 60px;
    font-size: 1.125rem;
  }

  .voucher-title {
    font-size: 0.9375rem;
  }

  .voucher-desc {
    font-size: 0.8125rem;
  }

  .payment-header h2 {
    font-size: 1.25rem;
  }

  .payment-amount {
    font-size: 1.5rem;
  }

  .summary-total-row .value {
    font-size: 1.375rem;
  }

  .offcanvas-header h3 {
    font-size: 1.125rem;
  }

  .modal-content {
    padding: 1.25rem;
  }

  #modalAlamat h3 {
    font-size: 1.125rem;
  }

  .address-recipient {
    font-size: 0.8125rem;
  }

  .address-detail {
    font-size: 0.8125rem;
  }
}

/* Extra small devices (360px and below) */
@media (max-width: 360px) {
  .checkout-wrapper {
    padding: 0 0.5rem;
  }

  .box {
    padding: 0.875rem;
    margin-bottom: 0.75rem;
  }

  .product-item {
    grid-template-columns: 60px 1fr;
    gap: 0.75rem;
    padding: 0.75rem;
  }

  .product-img-wrapper {
    width: 60px;
    padding-bottom: 60px;
  }

  .btn {
    padding: 0.5rem 1rem;
    font-size: 0.8125rem;
  }

  .summary-header-title,
  .summary-header-value {
    font-size: 0.8125rem;
  }

  .product-qty-display {
    padding: 0.375rem 0.625rem;
  }

  .product-qty-display .qty-label {
    font-size: 0.75rem;
  }

  .product-qty-display .qty-value {
    font-size: 0.875rem;
  }
}

/* Landscape orientation fixes */
@media (max-height: 600px) and (orientation: landscape) {
  .modal-content {
    margin: 0.5rem;
    max-height: calc(100vh - 1rem);
  }

  .offcanvas-body {
    padding: 1rem;
  }

  .payment-header {
    margin-bottom: 1rem;
    padding-bottom: 1rem;
  }

  .payment-amount {
    font-size: 1.5rem;
    margin-top: 0.5rem;
  }

  .success-icon {
    width: 80px;
    height: 80px;
    font-size: 2.5rem;
  }

  .order-details {
    padding: 1rem;
    margin-bottom: 1rem;
  }
}

/* High DPI / Retina displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .product-img {
    image-rendering: -webkit-optimize-contrast;
  }
}

/* Fix untuk Bootstrap conflict */
.checkout-wrapper * {
  box-sizing: border-box;
}

/* Override Bootstrap container if exists */
.checkout-wrapper.container,
.checkout-wrapper.container-fluid {
  max-width: 1200px !important;
  padding-left: 1.5rem !important;
  padding-right: 1.5rem !important;
}

@media (max-width: 768px) {
  .checkout-wrapper.container,
  .checkout-wrapper.container-fluid {
    padding-left: 0.75rem !important;
    padding-right: 0.75rem !important;
  }
}

/* Ensure modals are above Bootstrap elements */
.modal {
  z-index: 10000 !important;
}

.offcanvas {
  z-index: 9999 !important;
}

.offcanvas-overlay {
  z-index: 9998 !important;
}

    .alert-warning a {
      color: var(--primary);
      font-weight: 700;
      text-decoration: underline;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .alert-warning a:hover {
      color: var(--primary-dark);
    }

    .btn-checkout:disabled {
      background: linear-gradient(135deg, var(--muted) 0%, #94a3b8 100%);
      cursor: not-allowed;
      opacity: 0.6;
      transform: none;
      box-shadow: none;
    }

    .btn-checkout:disabled:hover {
      transform: none;
      box-shadow: none;
    }
  </style>
</head>

<body>

  <div class="checkout-wrapper">
    <div class="checkout-left">

      <!-- Alamat Pengiriman -->
      <div class="box">
        <div class="box-header">
          <h3>📍 Alamat Pengiriman</h3>
          <div id="btn-ganti-alamat-container">
            <?php if ($alamat_checkout): ?>
              <button class="btn btn-link" id="btn-open-modal">Ganti Alamat</button>
            <?php endif; ?>
          </div>
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
              ⚠️ Belum ada alamat pengiriman.
              <a href="javascript:void(0)" onclick="openModalTambahAlamat()" style="color: var(--primary); font-weight: 700; text-decoration: underline;">
                Klik di sini untuk menambah alamat
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Produk - DARI DATABASE -->
      <div class="box">
        <h3>🛍️ Pesanan Anda (<?= isset($summary) && isset($summary['total_items']) ? $summary['total_items'] : 0 ?> item)</h3>

       

        <?php if (!empty($checkout_items)): ?>
          <?php foreach ($checkout_items as $item): ?>
            <?php
            // Hitung harga final (setelah diskon)
            $final_price = $checkout_model->get_item_final_price($item);
            $subtotal = $final_price * $item->qty;
            
            // DEBUG: Echo subtotal ke HTML comment
            // echo "<!-- DEBUG: Item {$item->id_cart} - final_price: {$final_price} - qty: {$item->qty} - subtotal: {$subtotal} -->\n";
            
            // Cek apakah ada diskon
            $has_discount = ($item->is_sale == 1 && ($item->persen_promo > 0 || $item->harga_promo > 0));
            $discount_percentage = $has_discount && $item->persen_promo > 0 ? $item->persen_promo : 0;
            ?>
            
            <div class="product-item" data-id-cart="<?= $item->id_cart ?>" data-price="<?= $subtotal ?>">
              
              <div class="product-img-wrapper">
                <img src="<?= base_url('assets/images/item/' . $item->gambar_item) ?>" 
                     class="product-img" 
                     alt="<?= htmlspecialchars($item->nama_item) ?>"
                     onerror="if(!this.dataset.errored){this.dataset.errored=1;this.src='<?= base_url('assets/images/no-image.jpg') ?>';}">
                <?php if ($has_discount): ?>
                  <div class="product-discount-badge">-<?= $discount_percentage ?>%</div>
                <?php endif; ?>
              </div>
              <div class="product-info">
                <h4 class="product-name"><?= htmlspecialchars($item->nama_item) ?></h4>
                <div class="product-variant">
                  <span>📏 Ukuran: <?= htmlspecialchars($item->ukuran) ?></span>
                  <span>🎨 Warna: <?= htmlspecialchars($item->warna) ?></span>
                </div>
                <div class="product-price-row">
                  <div class="product-qty-display">
                    <span class="qty-label">Jumlah:</span>
                    <span class="qty-value"><?= $item->qty ?></span>
                  </div>
                  <div class="product-prices">
                    <?php if ($has_discount): ?>
                      <span class="product-price-original">Rp <?= number_format($item->harga * $item->qty, 0, ',', '.') ?></span>
                      <span class="product-price">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    <?php else: ?>
                      <span class="product-price no-discount">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-warning" style="background: #fff3cd; border: 2px solid #ffc107; border-radius: 8px; padding: 1.5rem; text-align: center;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🛒</div>
            <h4 style="color: #856404; margin-bottom: 0.5rem;">Tidak ada item yang dipilih untuk checkout</h4>
            <p style="color: #856404; margin-bottom: 1rem;">
              Silakan kembali ke halaman keranjang dan centang item yang ingin dibeli.
            </p>
            <a href="<?= site_url('keranjang') ?>" 
               style="display: inline-block; background: var(--primary); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 700;">
              🔙 Kembali ke Keranjang
            </a>
            
            <?php if (ENVIRONMENT === 'development'): ?>
              <!-- DEBUG INFO -->
              <div style="margin-top: 1.5rem; padding: 1rem; background: #fee; border: 1px solid #fcc; border-radius: 8px; font-size: 0.875rem; text-align: left;">
                <strong>🐛 Debug Info - Kenapa Kosong?</strong><br><br>
                
                <strong>1. Session Info:</strong><br>
                - ID Customer: <?= $this->session->userdata('id_customer') ?><br><br>
                
                <strong>2. Database Query:</strong><br>
                - Query: SELECT * FROM cart WHERE id_customer = '<?= $this->session->userdata('id_customer') ?>' AND checklist = 'Yes'<br>
                - Result: 0 rows<br><br>
                
                <strong>3. Kemungkinan Penyebab:</strong><br>
                - ❌ Semua item di cart memiliki checklist = 'No'<br>
                - ❌ Cart kosong (belum ada item)<br>
                - ❌ User belum centang item di halaman keranjang<br><br>
                
                <strong>4. Solusi:</strong><br>
                1. Buka halaman keranjang<br>
                2. Centang checkbox item yang mau dibeli<br>
                3. Klik "Checkout"<br>
                4. Item yang dicentang akan muncul di sini<br><br>
                
                <strong>5. Check Database Manual:</strong><br>
                <code style="background: #333; color: #0f0; padding: 0.5rem; display: block; border-radius: 4px; margin-top: 0.5rem;">
                  SELECT id_cart, checklist FROM cart WHERE id_customer = '<?= $this->session->userdata('id_customer') ?>';
                </code>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>

    <div class="checkout-right">

      <!-- Ringkasan - DUMMY DATA -->

      <div class="box">

        <!-- TOMBOL PROMO - DIPISAH -->
        <div class="promo-buttons-container">
          <button class="btn-promo-trigger btn-promo-item" id="btn-open-promo-item">
            <span class="promo-icon">🎁</span>
            <span class="promo-text">Promo Item</span>
          </button>
          
          <button class="btn-promo-trigger btn-promo-shipping" id="btn-open-promo-shipping">
            <span class="promo-icon">🚚</span>
            <span class="promo-text">Gratis Ongkir</span>
          </button>
        </div>

        <!-- SUBTOTAL PRODUK - COLLAPSIBLE -->
        <div class="summary-section">
          <div class="summary-header" id="product-header" onclick="toggleSummary('product')">
            <div class="summary-header-left">
              <span class="summary-header-icon">▼</span>
              <span class="summary-header-title">🛍️ Subtotal Produk</span>
            </div>
            <span class="summary-header-value" id="subtotal-produk-display">Rp 0</span>
          </div>
          <div class="summary-body" id="product-body">
            <div class="summary-body-content">
              <div class="summary-detail-row">
                <span class="label">Total Harga (<span id="total-items-count">0</span> item)</span>
                <span class="value" id="total-before-detail">Rp 0</span>
              </div>
              <?php if (isset($summary) && $summary['total_discount'] > 0): ?>
                <div class="summary-detail-row discount">
                  <span class="label">💸 Diskon Produk</span>
                  <span class="value" id="product-discount-detail">- Rp <?= number_format($summary['total_discount'], 0, ',', '.') ?></span>
                </div>
              <?php endif; ?>
              <div class="summary-detail-row voucher" id="voucher-product-row" style="display: none;">
                <span class="label" id="voucher-product-label">🎁 Voucher</span>
                <span class="value" id="voucher-product-detail">- Rp 0</span>
              </div>
            </div>
          </div>
        </div>

        <!-- SUBTOTAL ONGKIR - COLLAPSIBLE -->
        <div class="summary-section">
          <div class="summary-header" id="shipping-header" onclick="toggleSummary('shipping')">
            <div class="summary-header-left">
              <span class="summary-header-icon">▼</span>
              <span class="summary-header-title">🚚 Subtotal Ongkir</span>
            </div>
            <span class="summary-header-value" id="subtotal-ongkir-display">Rp 25.000</span>
          </div>
          <div class="summary-body" id="shipping-body">
            <div class="summary-body-content">
              <div class="summary-detail-row">
                <span class="label">Biaya Ongkir</span>
                <span class="value" id="shipping-cost-detail">Rp 25.000</span>
              </div>
              <div class="summary-detail-row discount" id="shipping-discount-row" style="display: none;">
                <span class="label" id="shipping-discount-label">🎁 Diskon Ongkir</span>
                <span class="value" id="shipping-discount-detail">- Rp 0</span>
              </div>
            </div>
          </div>
        </div>

        <!-- TOTAL -->
        <div class="summary-total-section">
          <div class="summary-total-row">
            <span class="label">Total Pembayaran</span>
            <span class="value" id="total-final">Rp 25.000</span>
          </div>
        </div>

        <!-- METODE PEMBAYARAN DROPDOWN -->
        <div class="payment-method-section" style="margin-top: 1.5rem; padding: 1.25rem; background: var(--bg); border-radius: var(--radius-sm); border: 2px solid var(--border);">
          <label style="font-size: 0.875rem; font-weight: 700; color: var(--text); display: block; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
            💳 Metode Pembayaran
          </label>
          <select id="payment-method-select" style="width: 100%; padding: 0.875rem 1rem; border: 2px solid var(--border); border-radius: var(--radius-sm); font-size: 0.9375rem; font-weight: 600; color: var(--text); background: white; cursor: pointer; transition: all 0.3s; font-family: inherit;">
            <option value="">Pilih metode pembayaran</option>
            <option value="bca">🏦 Bank BCA</option>
            <option value="mandiri">🏧 Bank Mandiri</option>
            <option value="bni">🏦 Bank BNI</option>
            <option value="bri">🏦 Bank BRI</option>
          </select>
        </div>

        <button class="btn-checkout" id="btn-pay-now" <?php if (!$alamat_checkout): ?>disabled<?php endif; ?>>
          <span>💳</span>
          <span>Bayar Sekarang</span>
        </button>
      </div>
    </div>

    <!-- Off-Canvas Promo ITEM -->
    <div class="offcanvas-overlay" id="offcanvas-overlay-item"></div>
    <div class="offcanvas" id="offcanvas-promo-item">
      <div class="offcanvas-header">
        <h3>🎁 Promo Item</h3>
        <button class="offcanvas-close" id="offcanvas-close-item">×</button>
      </div>
      <div class="offcanvas-body">
        <div id="promo-item-container">
          <!-- Input Promo Item -->
          <div class="promo-input-group">
            <input type="text" class="promo-input" id="promo-code-item" placeholder="Masukkan kode promo item">
            <button class="btn-apply-promo" id="btn-apply-promo-item">Pakai</button>
          </div>

          <!-- Available Vouchers ITEM -->
          <div class="voucher-section-title">✨ Voucher Item Tersedia</div>

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
            <button class="btn-use-voucher" onclick="applyVoucherItem('DISKON10', 'percentage', 10)">
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
            <button class="btn-use-voucher" onclick="applyVoucherItem('GRATIS50', 'fixed', 50000)">
              Pakai
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Off-Canvas Promo GRATIS ONGKIR -->
    <div class="offcanvas-overlay" id="offcanvas-overlay-shipping"></div>
    <div class="offcanvas" id="offcanvas-promo-shipping">
      <div class="offcanvas-header">
        <h3>🚚 Gratis Ongkir</h3>
        <button class="offcanvas-close" id="offcanvas-close-shipping">×</button>
      </div>
      <div class="offcanvas-body">
        <div id="promo-shipping-container">
          <!-- Input Promo Shipping -->
          <div class="promo-input-group">
            <input type="text" class="promo-input" id="promo-code-shipping" placeholder="Masukkan kode gratis ongkir">
            <button class="btn-apply-promo" id="btn-apply-promo-shipping">Pakai</button>
          </div>

          <!-- Available Vouchers SHIPPING -->
          <div class="voucher-section-title">✨ Voucher Gratis Ongkir Tersedia</div>

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
            <button class="btn-use-voucher" onclick="applyVoucherShipping('FREEONGKIR', 'shipping', 0)">
              Pakai
            </button>
          </div>

          <!-- Voucher Shipping 50% -->
          <div class="voucher-card" data-code="ONGKIR50" data-type="shipping_percentage" data-value="50">
            <div class="voucher-left">
              <div class="voucher-icon">50%</div>
              <div class="voucher-info">
                <div class="voucher-title">Diskon Ongkir 50%</div>
                <div class="voucher-desc">Potongan 50% biaya pengiriman</div>
                <div class="voucher-valid">Berlaku hingga 20 Feb 2026</div>
              </div>
            </div>
            <button class="btn-use-voucher" onclick="applyVoucherShipping('ONGKIR50', 'shipping_percentage', 50)">
              Pakai
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Pilih Alamat -->
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
            <button class="btn-add-new-address" onclick="openModalTambahAlamat()">
              <span>➕</span>
              <span>Tambah Alamat Baru</span>
            </button>

          <?php else: ?>
            <div style="text-align: center; padding: 2rem;">
              <p style="color: var(--muted); margin-bottom: 1rem;">📍 Anda belum memiliki alamat</p>
              <button class="btn btn-primary" onclick="openModalTambahAlamat()">Tambah Alamat</button>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- MODAL TAMBAH ALAMAT -->
    <div class="modal" id="modalAlamat" aria-hidden="true">
      <div class="modal-overlay" onclick="closeModalAlamat()"></div>
      <div class="modal-content">
        <button class="modal-close" onclick="closeModalAlamat()">×</button>
        <h3 id="modalTitle">Tambah Alamat Baru</h3>

        <div class="modal-body">
          <form id="formAlamat">
            <input type="hidden" id="id_alamat">

            <div class="form-grid">
              <div class="form-group full">
                <label class="required">Nama Alamat</label>
                <input type="text" id="nama_alamat" placeholder="Contoh: Rumah, Kantor, Kos">
              </div>

              <div class="form-group">
                <label class="required">Nama Penerima</label>
                <input type="text" id="nama_penerima" placeholder="Nama lengkap penerima">
              </div>

              <div class="form-group">
                <label class="required">Nomor Telepon</label>
                <input type="tel" id="nomor_telp_penerima" placeholder="Tambahkan Nomor Telepon">
              </div>

              <div class="form-group">
                <label class="required">Provinsi</label>
                <div class="dropdown-box">
                  <div class="dropdown-selected" id="provinsiSelected" onclick="toggleDropdown('provinsi')">
                    Pilih Provinsi
                  </div>
                  <div class="dropdown-list" id="provinsiList">
                    <input type="text" placeholder="Cari provinsi..." onkeyup="filterDropdown(this,'provinsi')">
                    <div class="dropdown-items" id="provinsiItems"></div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="required">Kabupaten</label>
                <div class="dropdown-box">
                  <div class="dropdown-selected" id="kabupatenSelected" onclick="toggleDropdown('kabupaten')">
                    Pilih Kabupaten
                  </div>
                  <div class="dropdown-list" id="kabupatenList">
                    <input type="text" placeholder="Cari kabupaten..." onkeyup="filterDropdown(this,'kabupaten')">
                    <div class="dropdown-items" id="kabupatenItems"></div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="required">Kecamatan</label>
                <div class="dropdown-box">
                  <div class="dropdown-selected" id="kecamatanSelected" onclick="toggleDropdown('kecamatan')">
                    Pilih Kecamatan
                  </div>
                  <div class="dropdown-list" id="kecamatanList">
                    <input type="text" placeholder="Cari kecamatan..." onkeyup="filterDropdown(this,'kecamatan')">
                    <div class="dropdown-items" id="kecamatanItems"></div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="required">Kelurahan</label>
                <div class="dropdown-box">
                  <div class="dropdown-selected" id="kelurahanSelected" onclick="toggleDropdown('kelurahan')">
                    Pilih Kelurahan
                  </div>
                  <div class="dropdown-list" id="kelurahanList">
                    <input type="text" placeholder="Cari kelurahan..." onkeyup="filterDropdown(this,'kelurahan')">
                    <div class="dropdown-items" id="kelurahanItems"></div>
                  </div>
                </div>
              </div>

              <div class="form-group full">
                <label class="required">Detail Alamat</label>
                <input type="text" id="detail" placeholder="Nama jalan, no. rumah, patokan, dll">
              </div>

              <div class="form-group full">
                <label class="required">Kode Pos</label>
                <input type="text" id="kode_pos" placeholder="12345">
              </div>

              <div class="form-group full">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                  <input type="checkbox" id="is_default" style="width: 18px; height: 18px;">
                  <span>Jadikan sebagai alamat utama</span>
                </label>
              </div>
            </div>
          </form>
        </div>

        <div class="modal-actions">
          <button class="btn btn-secondary" onclick="closeModalAlamat()">Batal</button>
          <button class="btn btn-primary" onclick="simpanAlamat()" id="btnSimpanAlamat">
            Simpan Alamat
          </button>
        </div>
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
    </div>

    <script>
      // State - DATA DARI PHP
      const state = {
        totalBefore: <?= isset($summary) ? $summary['total_before'] : 0 ?>,
        productDiscount: <?= isset($summary) ? $summary['total_discount'] : 0 ?>,
        subtotal: <?= isset($summary) ? $summary['subtotal'] : 0 ?>,
        shipping: 25000,
        voucherDiscount: 0,
        shippingDiscount: 0,
        promoCodeItem: null, // Promo untuk item
        promoCodeShipping: null, // Promo untuk shipping
        selectedPayment: null
      };

      // Format Rupiah
      function formatRupiah(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
      }

      // Calculate Total - FIXED
      function calculateTotal() {
        // Hitung subtotal produk (ga boleh minus)
        const subtotalProduk = Math.max(0, state.subtotal - state.voucherDiscount);
        
        // Hitung subtotal ongkir (ga boleh minus)
        const subtotalOngkir = Math.max(0, state.shipping - state.shippingDiscount);
        
        // Total akhir (ga boleh minus)
        const total = Math.max(0, subtotalProduk + subtotalOngkir);
        
        return total;
      }

      function toggleSummary(section) {
        const header = document.getElementById(section + '-header');
        const body = document.getElementById(section + '-body');

        header.classList.toggle('active');
        body.classList.toggle('active');
      }


      // Update Display
      function updatePriceDisplay() {
        // Hitung subtotal produk
        const subtotalProduk = state.subtotal - state.voucherDiscount;
        const subtotalOngkir = state.shipping - state.shippingDiscount;

        // Update Subtotal Produk Section
        document.getElementById('subtotal-produk-display').textContent = formatRupiah(subtotalProduk);
        document.getElementById('total-before-detail').textContent = formatRupiah(state.totalBefore);
        document.getElementById('product-discount-detail').textContent = '- ' + formatRupiah(state.productDiscount);

        // Voucher Produk (conditional)
        const voucherProductRow = document.getElementById('voucher-product-row');
        if (state.voucherDiscount > 0) {
          voucherProductRow.style.display = 'flex';
          document.getElementById('voucher-product-detail').textContent = '- ' + formatRupiah(state.voucherDiscount);
        } else {
          voucherProductRow.style.display = 'none';
        }

        // Update Subtotal Ongkir Section
        document.getElementById('subtotal-ongkir-display').textContent = formatRupiah(subtotalOngkir);
        document.getElementById('shipping-cost-detail').textContent = formatRupiah(state.shipping);

        // Diskon Ongkir (conditional)
        const shippingDiscountRow = document.getElementById('shipping-discount-row');
        if (state.shippingDiscount > 0) {
          shippingDiscountRow.style.display = 'flex';
          document.getElementById('shipping-discount-detail').textContent = '- ' + formatRupiah(state.shippingDiscount);
        } else {
          shippingDiscountRow.style.display = 'none';
        }

        // Update Total Akhir
        document.getElementById('total-final').textContent = formatRupiah(calculateTotal());

        // Update payment modal amount (jika ada)
        const paymentAmount = document.getElementById('payment-amount-display');
        if (paymentAmount) {
          paymentAmount.textContent = formatRupiah(calculateTotal());
        }
      }

      // Apply Voucher ITEM
      function applyVoucherItem(code, type, value) {
        // Cek jika sudah ada promo item
        if (state.promoCodeItem) {
          showNotification('⚠️ Hanya bisa pakai 1 promo item! Hapus promo item yang aktif dulu.', 'error');
          return;
        }

        let desc = '';
        if (type === 'percentage') {
          const discountAmount = Math.floor(state.subtotal * (value / 100));
          state.voucherDiscount = discountAmount;
          desc = `Diskon ${value}%`;
        } else if (type === 'fixed') {
          state.voucherDiscount = value;
          desc = `Potongan Rp ${value.toLocaleString('id-ID')}`;
        }

        state.promoCodeItem = code;
        state.voucherDesc = desc; // ✅ SIMPAN DESC KE STATE!

        // Update UI - tampilkan promo applied
        const promoItemContainer = document.getElementById('promo-item-container');
        promoItemContainer.innerHTML = `
          <div class="promo-applied">
            <div class="promo-applied-info">
              <div class="promo-icon">🎉</div>
              <div class="promo-text">
                <strong>${code}</strong>
                <small>${desc} diterapkan</small>
              </div>
            </div>
            <button class="btn-remove-promo" onclick="removePromoItem()">Hapus</button>
          </div>
        `;

        // Update tombol promo item
        updatePromoItemButton(code, desc);

        updateCheckoutTotals(); // Update all displays
        showNotification('✅ Voucher item berhasil diterapkan!', 'success');
        closeOffcanvasItem();
      }

      // Update Promo Item Button
      function updatePromoItemButton(code, desc) {
        const btnPromoItem = document.getElementById('btn-open-promo-item');
        if (code) {
          btnPromoItem.classList.add('active');
          btnPromoItem.innerHTML = `
            <span class="promo-icon">✓</span>
            <span class="promo-code">${code}</span>
            <span class="promo-text">${desc}</span>
          `;
        } else {
          btnPromoItem.classList.remove('active');
          btnPromoItem.innerHTML = `
            <span class="promo-icon">🎁</span>
            <span class="promo-text">Promo Item</span>
          `;
        }
      }

      // Apply Voucher SHIPPING
      function applyVoucherShipping(code, type, value) {
        // Cek jika sudah ada promo shipping
        if (state.promoCodeShipping) {
          showNotification('⚠️ Hanya bisa pakai 1 promo ongkir! Hapus promo ongkir yang aktif dulu.', 'error');
          return;
        }

        let desc = '';
        if (type === 'shipping') {
          state.shippingDiscount = state.shipping; // GRATIS ONGKIR 100%
          desc = 'Gratis Ongkir';
        } else if (type === 'shipping_percentage') {
          state.shippingDiscount = Math.floor(state.shipping * (value / 100));
          desc = `Diskon Ongkir ${value}%`;
        }

        state.promoCodeShipping = code;
        state.shippingDesc = desc; // ✅ SIMPAN DESC KE STATE!

        // Update UI - tampilkan promo applied
        const promoShippingContainer = document.getElementById('promo-shipping-container');
        promoShippingContainer.innerHTML = `
          <div class="promo-applied">
            <div class="promo-applied-info">
              <div class="promo-icon">🎉</div>
              <div class="promo-text">
                <strong>${code}</strong>
                <small>${desc} diterapkan</small>
              </div>
            </div>
            <button class="btn-remove-promo" onclick="removePromoShipping()">Hapus</button>
          </div>
        `;

        // Update tombol promo shipping
        updatePromoShippingButton(code, desc);

        updateCheckoutTotals(); // Update all displays
        showNotification('✅ Voucher gratis ongkir berhasil diterapkan!', 'success');
        closeOffcanvasShipping();
      }

      // Update Promo Shipping Button
      function updatePromoShippingButton(code, desc) {
        const btnPromoShipping = document.getElementById('btn-open-promo-shipping');
        if (code) {
          btnPromoShipping.classList.add('active');
          btnPromoShipping.innerHTML = `
            <span class="promo-icon">✓</span>
            <span class="promo-code">${code}</span>
            <span class="promo-text">${desc}</span>
          `;
        } else {
          btnPromoShipping.classList.remove('active');
          btnPromoShipping.innerHTML = `
            <span class="promo-icon">🚚</span>
            <span class="promo-text">Gratis Ongkir</span>
          `;
        }
      }

      // Apply Promo ITEM dari input
      function applyPromoItem(code) {
        code = code.toUpperCase().trim();

        const promos = {
          'DISKON10': {
            type: 'percentage',
            value: 10
          },
          'GRATIS50': {
            type: 'fixed',
            value: 50000
          }
        };

        if (!promos[code]) {
          showNotification('❌ Kode promo item tidak valid', 'error');
          return;
        }

        const promo = promos[code];
        applyVoucherItem(code, promo.type, promo.value);
      }

      // Apply Promo SHIPPING dari input
      function applyPromoShipping(code) {
        code = code.toUpperCase().trim();

        const promos = {
          'FREEONGKIR': {
            type: 'shipping',
            value: 0
          },
          'ONGKIR50': {
            type: 'shipping_percentage',
            value: 50
          }
        };

        if (!promos[code]) {
          showNotification('❌ Kode promo ongkir tidak valid', 'error');
          return;
        }

        const promo = promos[code];
        applyVoucherShipping(code, promo.type, promo.value);
      }

      // Remove Promo ITEM
      function removePromoItem() {
        state.voucherDiscount = 0;
        state.promoCodeItem = null;
        state.voucherDesc = null; // ✅ RESET DESC JUGA!

        const promoItemContainer = document.getElementById('promo-item-container');
        promoItemContainer.innerHTML = `
          <div class="promo-input-group">
            <input type="text" class="promo-input" id="promo-code-item" placeholder="Masukkan kode promo item">
            <button class="btn-apply-promo" id="btn-apply-promo-item">Pakai</button>
          </div>

          <div class="voucher-section-title">✨ Voucher Item Tersedia</div>

          <div class="voucher-card" data-code="DISKON10" data-type="percentage" data-value="10">
            <div class="voucher-left">
              <div class="voucher-icon">10%</div>
              <div class="voucher-info">
                <div class="voucher-title">Diskon 10%</div>
                <div class="voucher-desc">Potongan 10% untuk semua produk</div>
                <div class="voucher-valid">Berlaku hingga 31 Jan 2026</div>
              </div>
            </div>
            <button class="btn-use-voucher" onclick="applyVoucherItem('DISKON10', 'percentage', 10)">
              Pakai
            </button>
          </div>

          <div class="voucher-card" data-code="GRATIS50" data-type="fixed" data-value="50000">
            <div class="voucher-left">
              <div class="voucher-icon">50K</div>
              <div class="voucher-info">
                <div class="voucher-title">Potongan Rp 50.000</div>
                <div class="voucher-desc">Untuk pembelian min. Rp 500.000</div>
                <div class="voucher-valid">Berlaku hingga 28 Feb 2026</div>
              </div>
            </div>
            <button class="btn-use-voucher" onclick="applyVoucherItem('GRATIS50', 'fixed', 50000)">
              Pakai
            </button>
          </div>
        `;

        // Reset tampilan tombol
        updatePromoItemButton(null, null);

        attachPromoItemEvents();
        updateCheckoutTotals(); // Update all displays
        showNotification('✅ Promo item berhasil dihapus', 'success');
      }

      // Remove Promo SHIPPING
      function removePromoShipping() {
        state.shippingDiscount = 0;
        state.promoCodeShipping = null;
        state.shippingDesc = null; // ✅ RESET DESC JUGA!

        const promoShippingContainer = document.getElementById('promo-shipping-container');
        promoShippingContainer.innerHTML = `
          <div class="promo-input-group">
            <input type="text" class="promo-input" id="promo-code-shipping" placeholder="Masukkan kode gratis ongkir">
            <button class="btn-apply-promo" id="btn-apply-promo-shipping">Pakai</button>
          </div>

          <div class="voucher-section-title">✨ Voucher Gratis Ongkir Tersedia</div>

          <div class="voucher-card" data-code="FREEONGKIR" data-type="shipping" data-value="0">
            <div class="voucher-left">
              <div class="voucher-icon">🚚</div>
              <div class="voucher-info">
                <div class="voucher-title">Gratis Ongkir</div>
                <div class="voucher-desc">Bebas biaya pengiriman</div>
                <div class="voucher-valid">Berlaku hingga 15 Feb 2026</div>
              </div>
            </div>
            <button class="btn-use-voucher" onclick="applyVoucherShipping('FREEONGKIR', 'shipping', 0)">
              Pakai
            </button>
          </div>

          <div class="voucher-card" data-code="ONGKIR50" data-type="shipping_percentage" data-value="50">
            <div class="voucher-left">
              <div class="voucher-icon">50%</div>
              <div class="voucher-info">
                <div class="voucher-title">Diskon Ongkir 50%</div>
                <div class="voucher-desc">Potongan 50% biaya pengiriman</div>
                <div class="voucher-valid">Berlaku hingga 20 Feb 2026</div>
              </div>
            </div>
            <button class="btn-use-voucher" onclick="applyVoucherShipping('ONGKIR50', 'shipping_percentage', 50)">
              Pakai
            </button>
          </div>
        `;

        // Reset tampilan tombol
        updatePromoShippingButton(null, null);

        attachPromoShippingEvents();
        updateCheckoutTotals(); // Update all displays
        showNotification('✅ Promo ongkir berhasil dihapus', 'success');
      }

      // HAPUS FUNGSI LAMA
      // Apply Promo
      // Off-canvas Functions - UPDATED UNTUK DUA OFFCANVAS
      function openOffcanvasItem() {
        document.getElementById('offcanvas-overlay-item').classList.add('active');
        document.getElementById('offcanvas-promo-item').classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function closeOffcanvasItem() {
        document.getElementById('offcanvas-overlay-item').classList.remove('active');
        document.getElementById('offcanvas-promo-item').classList.remove('active');
        document.body.style.overflow = '';
      }

      function openOffcanvasShipping() {
        document.getElementById('offcanvas-overlay-shipping').classList.add('active');
        document.getElementById('offcanvas-promo-shipping').classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function closeOffcanvasShipping() {
        document.getElementById('offcanvas-overlay-shipping').classList.remove('active');
        document.getElementById('offcanvas-promo-shipping').classList.remove('active');
        document.body.style.overflow = '';
      }

      // Attach Promo Events - UNTUK ITEM
      function attachPromoItemEvents() {
        const btnApplyPromo = document.getElementById('btn-apply-promo-item');
        const promoCodeInput = document.getElementById('promo-code-item');

        if (btnApplyPromo) {
          btnApplyPromo.addEventListener('click', function() {
            const code = promoCodeInput.value;
            if (code) {
              applyPromoItem(code);
            } else {
              showNotification('⚠️ Masukkan kode promo terlebih dahulu', 'error');
            }
          });
        }

        if (promoCodeInput) {
          promoCodeInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
              e.preventDefault();
              const code = promoCodeInput.value;
              if (code) {
                applyPromoItem(code);
              } else {
                showNotification('⚠️ Masukkan kode promo terlebih dahulu', 'error');
              }
            }
          });
        }
      }

      // Attach Promo Events - UNTUK SHIPPING
      function attachPromoShippingEvents() {
        const btnApplyPromo = document.getElementById('btn-apply-promo-shipping');
        const promoCodeInput = document.getElementById('promo-code-shipping');

        if (btnApplyPromo) {
          btnApplyPromo.addEventListener('click', function() {
            const code = promoCodeInput.value;
            if (code) {
              applyPromoShipping(code);
            } else {
              showNotification('⚠️ Masukkan kode promo terlebih dahulu', 'error');
            }
          });
        }

        if (promoCodeInput) {
          promoCodeInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
              e.preventDefault();
              const code = promoCodeInput.value;
              if (code) {
                applyPromoShipping(code);
              } else {
                showNotification('⚠️ Masukkan kode promo terlebih dahulu', 'error');
              }
            }
          });
        }
      }

      // Modal Functions
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
      // Process Payment - UPDATED: Ambil payment method dari dropdown
      function processPayment() {
        // Ambil metode pembayaran dari dropdown
        const paymentSelect = document.getElementById('payment-method-select');
        const selectedPayment = paymentSelect ? paymentSelect.value : null;
        
        if (!selectedPayment) {
          showNotification('⚠️ Pilih metode pembayaran terlebih dahulu', 'error');
          return;
        }
        
        // Ambil semua cart ID dari product items (semua yang tampil di halaman)
        const checkedCartIds = [];
        document.querySelectorAll('.product-item').forEach(item => {
          const cartId = item.getAttribute('data-id-cart');
          if (cartId) {
            checkedCartIds.push(cartId);
          }
        });
        
        // Validasi: harus ada minimal 1 item
        if (checkedCartIds.length === 0) {
          showNotification('⚠️ Keranjang kosong', 'error');
          return;
        }

        const btnConfirm = document.getElementById('btn-pay-now');
        const originalText = btnConfirm.innerHTML;
        btnConfirm.innerHTML = '<span class="spinner"></span> Memproses...';
        btnConfirm.disabled = true;
        btnConfirm.disabled = true;

        // Hitung total pembayaran
        const totalPembayaran = calculateTotal();
        const ongkir = state.shipping - state.shippingDiscount;

        // Map metode pembayaran ke format database
        const metodePembayaranMap = {
          'bca': 'Rekening',
          'mandiri': 'Rekening',
          'bni': 'Rekening',
          'bri': 'Rekening'
        };

        const metodePembayaran = metodePembayaranMap[selectedPayment] || 'Rekening';

        // Prepare data untuk dikirim
        const dataTransaksi = {
          total: totalPembayaran,
          metode_pembayaran: metodePembayaran,
          bayar: totalPembayaran,
          kembali: 0,
          ongkir: ongkir,
          cart_ids: checkedCartIds.join(',') // Kirim ID cart yang checked
        };

        console.log('📤 Data transaksi:', dataTransaksi);

        // Kirim ke server
        fetch("<?= base_url('index.php/transaksi/simpan') ?>", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(dataTransaksi)
          })
          .then(response => response.json())
          .then(result => {
            console.log('📥 Response dari server:', result);

            if (result.success) {
              // Simpan ID transaksi yang baru dibuat
              const idTransaksi = result.id_transaksi || result.data?.id_transaksi;

              showPaymentSuccess(idTransaksi, selectedPayment);
              showNotification('✅ Pembayaran berhasil!', 'success');
              
              // REDIRECT KE HALAMAN HOME SETELAH 2 DETIK
              setTimeout(() => {
                window.location.href = "<?= base_url('') ?>";
              }, 2000);
            } else {
              btnConfirm.innerHTML = originalText;
              btnConfirm.disabled = false;
              showNotification('❌ ' + (result.message || 'Gagal memproses pembayaran'), 'error');
            }
          })
          .catch(error => {
            console.error('❌ Error:', error);
            btnConfirm.innerHTML = originalText;
            btnConfirm.disabled = false;
            showNotification('❌ Terjadi kesalahan saat memproses pembayaran', 'error');
          });x
      }

      // Show Payment Success
      function showPaymentSuccess(idTransaksi, selectedPayment) {
        // Gunakan ID transaksi dari database atau generate fallback
        const orderId = idTransaksi || 'ORDER-' + new Date().getFullYear() + '-' + Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
        document.getElementById('generated-order-id').textContent = orderId;

        const paymentMethods = {
          'bca': 'Bank BCA',
          'mandiri': 'Bank Mandiri',
          'bni': 'Bank BNI',
          'bri': 'Bank BRI'
        };

        document.getElementById('selected-payment-method').textContent = paymentMethods[selectedPayment] || selectedPayment;
        document.getElementById('paid-amount').textContent = formatRupiah(calculateTotal());

        const now = new Date();
        const options = {
          day: 'numeric',
          month: 'short',
          year: 'numeric',
          hour: '2-digit',
          minute: '2-digit'
        };
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

      // ✅ GLOBAL FUNCTION - Recalculate & Update All Totals
      function updateCheckoutTotals() {
        // Calculate from items
        let total = 0;
        let count = 0;
        
        document.querySelectorAll('.product-item').forEach(item => {
          const price = parseFloat(item.getAttribute('data-price'));
          if (!isNaN(price) && price > 0) {
            total += price;
            count++;
          }
        });
        
        // Update state
        state.totalBefore = total;
        state.subtotal = total;
        
        // Update displays
        const finalTotal = calculateTotal();
        
        // Item counts
        document.querySelectorAll('#checked-items-count, #total-items-count').forEach(el => {
          if (el) el.textContent = count;
        });
        
        // Subtotal produk
        const subtotalEl = document.getElementById('subtotal-produk-display');
        if (subtotalEl) {
          subtotalEl.textContent = formatRupiah(Math.max(0, total - state.voucherDiscount));
        }
        
        // Total before
        const totalBeforeEl = document.getElementById('total-before-detail');
        if (totalBeforeEl) totalBeforeEl.textContent = formatRupiah(total);
        
        // Voucher row
        const voucherRow = document.getElementById('voucher-product-row');
        const voucherLabel = document.getElementById('voucher-product-label');
        const voucherDetail = document.getElementById('voucher-product-detail');
        if (voucherRow && state.voucherDiscount > 0 && state.voucherDesc) {
          voucherRow.style.display = 'flex';
          if (voucherLabel) voucherLabel.textContent = `🎁 ${state.voucherDesc}`;
          if (voucherDetail) voucherDetail.textContent = '- ' + formatRupiah(state.voucherDiscount);
        } else if (voucherRow) {
          voucherRow.style.display = 'none';
        }
        
        // Shipping discount row
        const shippingRow = document.getElementById('shipping-discount-row');
        const shippingLabel = document.getElementById('shipping-discount-label');
        const shippingDetail = document.getElementById('shipping-discount-detail');
        if (shippingRow && state.shippingDiscount > 0 && state.shippingDesc) {
          shippingRow.style.display = 'flex';
          if (shippingLabel) shippingLabel.textContent = `🎁 ${state.shippingDesc}`;
          if (shippingDetail) shippingDetail.textContent = '- ' + formatRupiah(state.shippingDiscount);
        } else if (shippingRow) {
          shippingRow.style.display = 'none';
        }
        
        // Total final
        const totalFinalEl = document.getElementById('total-final');
        if (totalFinalEl) totalFinalEl.textContent = formatRupiah(finalTotal);
        
        // Payment modal
        const paymentEl = document.getElementById('payment-amount-display');
        if (paymentEl) paymentEl.textContent = formatRupiah(finalTotal);
        
        // Button state
        const btnPayNow = document.getElementById('btn-pay-now');
        if (btnPayNow) {
          btnPayNow.disabled = (count === 0);
          btnPayNow.style.opacity = (count === 0) ? '0.5' : '1';
        }
        
        console.log('✅ Totals updated:', {total, count, finalTotal});
      }

      // Event Listeners
      document.addEventListener('DOMContentLoaded', function() {
        
        console.log('🚀 DOM Loaded - Initializing checkout...');
        
        // ✅ Calculate totals on page load
        updateCheckoutTotals();
        
        // ✨ BOTTOM SHEET - Swipe & Click Handler (Mobile Only)
        if (window.innerWidth <= 768) {
          const summaryBox = document.querySelector('.box:has(.summary-section)');
          const summaryTotal = document.querySelector('.summary-total-section');
          
          if (!summaryBox || !summaryTotal) return;
          
          // Create overlay
          const summaryOverlay = document.createElement('div');
          summaryOverlay.className = 'summary-overlay';
          document.body.appendChild(summaryOverlay);
          
          // Create visible drag handle bar
          const dragHandleBar = document.createElement('div');
          dragHandleBar.style.cssText = `
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 4px;
            background: #cbd5e1;
            border-radius: 2px;
            z-index: 1;
          `;
          summaryBox.insertBefore(dragHandleBar, summaryBox.firstChild);
          
          // Create invisible drag area (larger touch target)
          const dragHandle = document.createElement('div');
          dragHandle.className = 'summary-drag-handle';
          dragHandle.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 50px;
            cursor: grab;
            touch-action: pan-y;
            z-index: 2;
            -webkit-user-select: none;
            user-select: none;
          `;
          summaryBox.insertBefore(dragHandle, summaryBox.firstChild);
          
          let startY = 0;
          let currentY = 0;
          let isDragging = false;
          let startTime = 0;
          let isExpanded = false;
          
          // Click total section to toggle
          summaryTotal.addEventListener('click', function(e) {
            if (e.target.closest('.btn-checkout')) return;
            
            isExpanded = !isExpanded;
            summaryBox.classList.toggle('expanded', isExpanded);
            summaryOverlay.classList.toggle('active', isExpanded);
          });
          
          // Drag handle - touch events
          dragHandle.addEventListener('touchstart', function(e) {
            startY = e.touches[0].clientY;
            currentY = startY;
            isDragging = true;
            startTime = Date.now();
            dragHandle.style.cursor = 'grabbing';
            e.stopPropagation();
          }, { passive: false });
          
          dragHandle.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            
            currentY = e.touches[0].clientY;
            const diff = currentY - startY;
            
            // Visual feedback
            if (!isExpanded && diff < 0) {
              const translateY = Math.max(diff, -200);
              summaryBox.style.transform = `translateY(${translateY}px)`;
            } else if (isExpanded && diff > 0) {
              const translateY = Math.min(diff, 200);
              summaryBox.style.transform = `translateY(${translateY}px)`;
            }
            
            e.preventDefault();
            e.stopPropagation();
          }, { passive: false });
          
          dragHandle.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            
            const diff = currentY - startY;
            const duration = Date.now() - startTime;
            const velocity = Math.abs(diff) / duration;
            
            dragHandle.style.cursor = 'grab';
            summaryBox.style.transform = '';
            summaryBox.style.transition = 'max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            
            const threshold = velocity > 0.5 ? 30 : 50;
            
            if (diff > threshold) {
              isExpanded = false;
              summaryBox.classList.remove('expanded');
              summaryOverlay.classList.remove('active');
            } else if (diff < -threshold) {
              isExpanded = true;
              summaryBox.classList.add('expanded');
              summaryOverlay.classList.add('active');
            }
            
            isDragging = false;
            
            setTimeout(() => {
              summaryBox.style.transition = '';
            }, 300);
            
            e.stopPropagation();
          });
          
          // Click overlay to collapse
          summaryOverlay.addEventListener('click', function(e) {
            isExpanded = false;
            summaryBox.classList.remove('expanded');
            summaryOverlay.classList.remove('active');
          });
          
          // Prevent sheet collapse saat buka promo offcanvas
          const btnPromoItem = document.getElementById('btn-open-promo-item');
          const btnPromoShipping = document.getElementById('btn-open-promo-shipping');
          
          if (btnPromoItem) {
            btnPromoItem.addEventListener('click', function(e) {
              e.stopPropagation();
              // ✅ AUTO CLOSE sheet pas buka promo modal
              isExpanded = false;
              summaryBox.classList.remove('expanded');
              summaryOverlay.classList.remove('active');
            });
          }
          
          if (btnPromoShipping) {
            btnPromoShipping.addEventListener('click', function(e) {
              e.stopPropagation();
              // ✅ AUTO CLOSE sheet pas buka promo modal
              isExpanded = false;
              summaryBox.classList.remove('expanded');
              summaryOverlay.classList.remove('active');
            });
          }
          
          // Auto close sheet saat buka payment modal
          const btnPayNow = document.getElementById('btn-pay-now');
          if (btnPayNow) {
            btnPayNow.addEventListener('click', function(e) {
              e.stopPropagation();
              // ✅ AUTO CLOSE sheet pas buka payment modal
              isExpanded = false;
              summaryBox.classList.remove('expanded');
              summaryOverlay.classList.remove('active');
            });
          }
        }

        // OPTIMASI: Modal event listeners - passive untuk scroll performance
        const offcanvasOverlayItem = document.getElementById('offcanvas-overlay-item');
        if (offcanvasOverlayItem) {
          offcanvasOverlayItem.addEventListener('click', closeOffcanvasItem, { passive: true });
        }

        const offcanvasOverlayShipping = document.getElementById('offcanvas-overlay-shipping');
        if (offcanvasOverlayShipping) {
          offcanvasOverlayShipping.addEventListener('click', closeOffcanvasShipping, { passive: true });
        }

        // Off-canvas triggers
        const btnOpenPromoItem = document.getElementById('btn-open-promo-item');
        if (btnOpenPromoItem) {
          btnOpenPromoItem.addEventListener('click', openOffcanvasItem);
        }

        const btnOpenPromoShipping = document.getElementById('btn-open-promo-shipping');
        if (btnOpenPromoShipping) {
          btnOpenPromoShipping.addEventListener('click', openOffcanvasShipping);
        }

        // Close offcanvas item
        const offcanvasCloseItem = document.getElementById('offcanvas-close-item');
        if (offcanvasCloseItem) {
          offcanvasCloseItem.addEventListener('click', closeOffcanvasItem);
        }

        // (offcanvasOverlayItem sudah di-declare di atas)
        // if (offcanvasOverlayItem) {
        //   offcanvasOverlayItem.addEventListener('click', closeOffcanvasItem);
        // }

        // Close offcanvas shipping
        const offcanvasCloseShipping = document.getElementById('offcanvas-close-shipping');
        if (offcanvasCloseShipping) {
          offcanvasCloseShipping.addEventListener('click', closeOffcanvasShipping);
        }

        // (offcanvasOverlayShipping sudah di-declare di atas)
        // if (offcanvasOverlayShipping) {
        //   offcanvasOverlayShipping.addEventListener('click', closeOffcanvasShipping);
        // }

        // Promo events
        attachPromoItemEvents();
        attachPromoShippingEvents();

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

        // Checkout button - UPDATED: Langsung process payment (ga buka modal)
        const btnCheckout = document.getElementById('btn-pay-now');
        if (btnCheckout) {
          btnCheckout.addEventListener('click', function() {
            processPayment(); // Langsung proses payment
          });
        }

        // Keyboard
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            closeModal('alamat-modal');
            closeModal('modalAlamat');
            closeOffcanvasItem();
            closeOffcanvasShipping();
          }
        });

        // Init
        updatePriceDisplay();
      });

      // DATABASE FUNCTIONS
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
                updateCheckoutButtonState(); // TAMBAHAN: Update button state
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

        addressCards.forEach(card => {
          const button = card.querySelector('.btn-use-address');
          const addressInfo = card.querySelector('.address-info strong');

          const badges = addressInfo.querySelectorAll('span');
          badges.forEach(badge => {
            const text = badge.textContent;
            if (text.includes('Dipilih') || text.includes('✓') || text.includes('Terpilih')) {
              badge.remove();
            }
          });

          card.classList.remove('active');

          if (button) {
            button.disabled = false;
            button.textContent = 'Pilih';
          }
        });

        addressCards.forEach(card => {
          const cardId = card.getAttribute('data-id');

          if (cardId == selected_id) {
            const button = card.querySelector('.btn-use-address');
            const addressInfo = card.querySelector('.address-info strong');

            card.classList.add('active');

            if (button) {
              button.disabled = true;
              button.textContent = 'Terpilih';
            }

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

        const colors = {
          'success': '#10b981',
          'error': '#ef4444',
          'info': '#6366f1',
          'warning': '#f59e0b' // TAMBAHAN
        };

        notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1.25rem 1.75rem;
        background: ${colors[type] || colors.info};
        color: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        z-index: 10001;
        font-size: 0.9375rem;
        font-weight: 600;
        max-width: 350px;
    `;

        document.body.appendChild(notification);

        setTimeout(() => {
          notification.remove();
        }, 3500);
      }

      // ========== MODAL TAMBAH ALAMAT ==========
      let selectedProvinsi = null;
      let selectedKabupaten = null;
      let selectedKecamatan = null;
      let selectedKelurahan = null;

      function openModalTambahAlamat() {
        closeModal('alamat-modal');
        openModal('modalAlamat');
        loadProvinsi();
        resetFormAlamat();
      }

      function closeModalAlamat() {
        closeModal('modalAlamat');
        resetFormAlamat();
      }

      function resetFormAlamat() {
        document.getElementById('formAlamat').reset();
        selectedProvinsi = null;
        selectedKabupaten = null;
        selectedKecamatan = null;
        selectedKelurahan = null;

        document.getElementById('provinsiSelected').textContent = 'Pilih Provinsi';
        document.getElementById('kabupatenSelected').textContent = 'Pilih Kabupaten';
        document.getElementById('kecamatanSelected').textContent = 'Pilih Kecamatan';
        document.getElementById('kelurahanSelected').textContent = 'Pilih Kelurahan';

        document.getElementById('kabupatenItems').innerHTML = '';
        document.getElementById('kecamatanItems').innerHTML = '';
        document.getElementById('kelurahanItems').innerHTML = '';
      }

      // Toggle Dropdown
      function toggleDropdown(type) {
        const dropdown = document.getElementById(type + 'List');

        document.querySelectorAll('.dropdown-list').forEach(list => {
          if (list.id !== type + 'List') {
            list.classList.remove('active');
          }
        });

        dropdown.classList.toggle('active');
      }

      // Filter Dropdown
      function filterDropdown(input, type) {
        const filter = input.value.toUpperCase();
        const items = document.getElementById(type + 'Items');
        const divs = items.getElementsByClassName('dropdown-item');

        for (let i = 0; i < divs.length; i++) {
          const txtValue = divs[i].textContent || divs[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            divs[i].style.display = "";
          } else {
            divs[i].style.display = "none";
          }
        }
      }

      // Load Provinsi
      function loadProvinsi() {
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
          .then(response => response.json())
          .then(data => {
            const container = document.getElementById('provinsiItems');
            container.innerHTML = '';

            data.forEach(prov => {
              const div = document.createElement('div');
              div.className = 'dropdown-item';
              div.textContent = prov.name;
              div.onclick = () => selectProvinsi(prov);
              container.appendChild(div);
            });
          })
          .catch(error => {
            console.error('Error loading provinsi:', error);
            showNotification('❌ Gagal memuat data provinsi', 'error');
          });
      }

      // Select Provinsi
      function selectProvinsi(prov) {
        selectedProvinsi = prov;
        document.getElementById('provinsiSelected').textContent = prov.name;
        document.getElementById('provinsiList').classList.remove('active');

        selectedKabupaten = null;
        selectedKecamatan = null;
        selectedKelurahan = null;
        document.getElementById('kabupatenSelected').textContent = 'Pilih Kabupaten';
        document.getElementById('kecamatanSelected').textContent = 'Pilih Kecamatan';
        document.getElementById('kelurahanSelected').textContent = 'Pilih Kelurahan';

        loadKabupaten(prov.id);
      }

      // Load Kabupaten
      function loadKabupaten(provinsiId) {
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`)
          .then(response => response.json())
          .then(data => {
            const container = document.getElementById('kabupatenItems');
            container.innerHTML = '';

            data.forEach(kab => {
              const div = document.createElement('div');
              div.className = 'dropdown-item';
              div.textContent = kab.name;
              div.onclick = () => selectKabupaten(kab);
              container.appendChild(div);
            });
          })
          .catch(error => {
            console.error('Error loading kabupaten:', error);
            showNotification('❌ Gagal memuat data kabupaten', 'error');
          });
      }

      // Select Kabupaten
      function selectKabupaten(kab) {
        selectedKabupaten = kab;
        document.getElementById('kabupatenSelected').textContent = kab.name;
        document.getElementById('kabupatenList').classList.remove('active');

        selectedKecamatan = null;
        selectedKelurahan = null;
        document.getElementById('kecamatanSelected').textContent = 'Pilih Kecamatan';
        document.getElementById('kelurahanSelected').textContent = 'Pilih Kelurahan';

        loadKecamatan(kab.id);
      }

      // Load Kecamatan
      function loadKecamatan(kabupatenId) {
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabupatenId}.json`)
          .then(response => response.json())
          .then(data => {
            const container = document.getElementById('kecamatanItems');
            container.innerHTML = '';

            data.forEach(kec => {
              const div = document.createElement('div');
              div.className = 'dropdown-item';
              div.textContent = kec.name;
              div.onclick = () => selectKecamatan(kec);
              container.appendChild(div);
            });
          })
          .catch(error => {
            console.error('Error loading kecamatan:', error);
            showNotification('❌ Gagal memuat data kecamatan', 'error');
          });
      }

      // Select Kecamatan
      function selectKecamatan(kec) {
        selectedKecamatan = kec;
        document.getElementById('kecamatanSelected').textContent = kec.name;
        document.getElementById('kecamatanList').classList.remove('active');

        selectedKelurahan = null;
        document.getElementById('kelurahanSelected').textContent = 'Pilih Kelurahan';

        loadKelurahan(kec.id);
      }

      // Load Kelurahan
      function loadKelurahan(kecamatanId) {
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
          .then(response => response.json())
          .then(data => {
            const container = document.getElementById('kelurahanItems');
            container.innerHTML = '';

            data.forEach(kel => {
              const div = document.createElement('div');
              div.className = 'dropdown-item';
              div.textContent = kel.name;
              div.onclick = () => selectKelurahan(kel);
              container.appendChild(div);
            });
          })
          .catch(error => {
            console.error('Error loading kelurahan:', error);
            showNotification('❌ Gagal memuat data kelurahan', 'error');
          });
      }

      // Select Kelurahan
      function selectKelurahan(kel) {
        selectedKelurahan = kel;
        document.getElementById('kelurahanSelected').textContent = kel.name;
        document.getElementById('kelurahanList').classList.remove('active');
      }

      // Simpan Alamat - FIXED VERSION
      function simpanAlamat() {
        // Validasi
        const namaAlamat = document.getElementById('nama_alamat').value.trim();
        const namaPenerima = document.getElementById('nama_penerima').value.trim();
        const nomorTelp = document.getElementById('nomor_telp_penerima').value.trim();
        const detail = document.getElementById('detail').value.trim();
        const kodePos = document.getElementById('kode_pos').value.trim();

        if (!namaAlamat) {
          showNotification('❌ Nama alamat harus diisi!', 'error');
          return;
        }

        if (!namaPenerima) {
          showNotification('❌ Nama penerima harus diisi!', 'error');
          return;
        }

        if (!nomorTelp) {
          showNotification('❌ Nomor telepon harus diisi!', 'error');
          return;
        }

        if (!detail) {
          showNotification('❌ Detail alamat harus diisi!', 'error');
          return;
        }

        if (!kodePos) {
          showNotification('❌ Kode pos harus diisi!', 'error');
          return;
        }

        if (!selectedProvinsi) {
          showNotification('❌ Pilih provinsi terlebih dahulu!', 'error');
          return;
        }

        if (!selectedKabupaten) {
          showNotification('❌ Pilih kabupaten terlebih dahulu!', 'error');
          return;
        }

        if (!selectedKecamatan) {
          showNotification('❌ Pilih kecamatan terlebih dahulu!', 'error');
          return;
        }

        if (!selectedKelurahan) {
          showNotification('❌ Pilih kelurahan terlebih dahulu!', 'error');
          return;
        }

        // Prepare data - PERBAIKAN NAMA PARAMETER
        const data = {
          nama_alamat: namaAlamat,
          nama_penerima: namaPenerima,
          nomor_telp_penerima: nomorTelp,
          provinsi_id: selectedProvinsi.id, // FIXED: provinsi_id (bukan id_provinsi)
          kabupaten_id: selectedKabupaten.id, // FIXED: kabupaten_id (bukan id_kabupaten)
          kecamatan_id: selectedKecamatan.id, // FIXED: kecamatan_id (bukan id_kecamatan)
          kelurahan_id: selectedKelurahan.id, // FIXED: kelurahan_id (bukan id_kelurahan)
          detail: detail,
          kode_pos: kodePos,
          is_default: document.getElementById('is_default').checked ? 1 : 0
        };

        console.log('📤 Data yang dikirim:', data);

        // Show loading
        const btnSimpan = document.getElementById('btnSimpanAlamat');
        const originalText = btnSimpan.innerHTML;
        btnSimpan.innerHTML = '<span class="spinner"></span> Menyimpan...';
        btnSimpan.disabled = true;

        // Send to server
        fetch("<?= base_url('index.php/alamat/simpan') ?>", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(data)
          })
          .then(response => response.json())
          .then(result => {
            console.log('📥 Response dari server:', result);

            btnSimpan.innerHTML = originalText;
            btnSimpan.disabled = false;

            // FIXED: Controller menggunakan 'success' bukan 'status'
            if (result.success) {
              showNotification('✅ Alamat berhasil disimpan!', 'success');
              closeModalAlamat();

              // Reload halaman untuk update list alamat
              setTimeout(() => {
                location.reload();
              }, 1000);
            } else {
              showNotification('❌ ' + (result.message || 'Gagal menyimpan alamat'), 'error');
            }
          })
          .catch(error => {
            console.error('❌ Error:', error);
            btnSimpan.innerHTML = originalText;
            btnSimpan.disabled = false;
            showNotification('❌ Terjadi kesalahan saat menyimpan', 'error');
          });
      }

      // Close dropdown when clicking outside
      document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-box')) {
          document.querySelectorAll('.dropdown-list').forEach(list => {
            list.classList.remove('active');
          });
        }
      });


      // ========== UPDATE CHECKOUT BUTTON STATE ==========
      function updateCheckoutButtonState() {
        const btnCheckout = document.getElementById('btn-pay-now');
        const addressDisplay = document.getElementById('address-display-main');

        // Cek apakah ada alamat (cek dari content, bukan dari alert warning)
        const hasAddress = !addressDisplay.querySelector('.alert-warning');

        if (btnCheckout) {
          if (hasAddress) {
            btnCheckout.disabled = false;
            btnCheckout.style.cursor = 'pointer';
          } else {
            btnCheckout.disabled = true;
            btnCheckout.style.cursor = 'not-allowed';
          }
        }
        
        // Update tombol Ganti Alamat juga
        updateGantiAlamatButton(hasAddress);
      }

      // ========== UPDATE GANTI ALAMAT BUTTON ==========
      function updateGantiAlamatButton(hasAddress) {
        const btnContainer = document.getElementById('btn-ganti-alamat-container');
        
        console.log('🔍 Debug Ganti Alamat Button:');
        console.log('- hasAddress:', hasAddress);
        console.log('- btnContainer:', btnContainer);
        
        if (!btnContainer) {
          console.log('❌ btnContainer tidak ditemukan!');
          return;
        }
        
        const existingBtn = document.getElementById('btn-open-modal');
        console.log('- existingBtn:', existingBtn);
        
        if (hasAddress) {
          // Jika ada alamat dan tombol belum ada, buat tombol baru
          if (!existingBtn) {
            console.log('✅ Membuat tombol Ganti Alamat baru');
            btnContainer.innerHTML = '<button class="btn btn-link" id="btn-open-modal">Ganti Alamat</button>';
            
            // Attach event listener ke tombol yang baru dibuat
            const newBtn = document.getElementById('btn-open-modal');
            if (newBtn) {
              newBtn.addEventListener('click', function(e) {
                e.preventDefault();
                openModal('alamat-modal');
              });
              console.log('✅ Event listener attached');
            }
          } else {
            console.log('ℹ️ Tombol sudah ada dari PHP');
          }
        } else {
          // Jika tidak ada alamat, hapus tombol jika ada
          if (existingBtn) {
            console.log('🗑️ Menghapus tombol Ganti Alamat');
            btnContainer.innerHTML = '';
          }
        }
      }

      // Panggil saat halaman load
      document.addEventListener('DOMContentLoaded', function() {
        updateCheckoutButtonState(); // Ini sudah memanggil updateGantiAlamatButton di dalamnya

        // ... kode lainnya tetap sama
      });
    </script>

</body>

</html>