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
    padding: 0 1rem;
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
    padding: 0 0.75rem;
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
    grid-template-columns: 80px 1fr;
    gap: 1rem;
    padding: 1rem;
  }

  .product-img-wrapper {
    width: 80px;
    padding-bottom: 80px;
  }

  .product-name {
    font-size: 0.9375rem;
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
  }

  /* Form grid responsive */
  .form-grid {
    grid-template-columns: 1fr;
  }

  /* Address card responsive */
  .address-card {
    flex-direction: column;
    align-items: stretch;
  }

  .address-info {
    width: 100%;
  }

  .btn-use-address {
    width: 100%;
  }

  /* Modal responsive */
  .modal-content {
    margin: 1rem;
    padding: 1.5rem;
    max-height: calc(100vh - 2rem);
  }

  .modal-close {
    right: 1rem;
    top: 1rem;
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
    max-width: 100vw;
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
    grid-template-columns: 70px 1fr;
    gap: 0.875rem;
    padding: 0.875rem;
  }

  .product-img-wrapper {
    width: 70px;
    padding-bottom: 70px;
  }

  .product-name {
    font-size: 0.875rem;
  }

  .product-variant {
    font-size: 0.8125rem;
  }

  .product-price {
    font-size: 1rem;
  }

  .product-price-original {
    font-size: 0.8125rem;
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
              ⚠️ Belum ada alamat pengiriman.
              <a href="javascript:void(0)" onclick="openModalTambahAlamat()" style="color: var(--primary); font-weight: 700; text-decoration: underline;">
                Klik di sini untuk menambah alamat
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Produk - DUMMY DATA -->
      <div class="box">
        <h3>🛍️ Pesanan Anda (3 item)</h3>

        <!-- Product 1 -->
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

        <!-- Product 2 -->
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

        <!-- Product 3 -->
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

      <!-- Ringkasan - DUMMY DATA -->

      <div class="box">

        <!-- TOMBOL PROMO -->
        <button class="btn-promo-trigger" id="btn-open-promo">
          🎁 Pakai Promo / Voucher
        </button>

        <!-- SUBTOTAL PRODUK - COLLAPSIBLE -->
        <div class="summary-section">
          <div class="summary-header" id="product-header" onclick="toggleSummary('product')">
            <div class="summary-header-left">
              <span class="summary-header-icon">▼</span>
              <span class="summary-header-title">🛍️ Subtotal Produk</span>
            </div>
            <span class="summary-header-value" id="subtotal-produk-display">Rp 5.450.000</span>
          </div>
          <div class="summary-body" id="product-body">
            <div class="summary-body-content">
              <div class="summary-detail-row">
                <span class="label">Total Harga (3 item)</span>
                <span class="value" id="total-before-detail">Rp 6.100.000</span>
              </div>
              <div class="summary-detail-row discount">
                <span class="label">💸 Diskon Produk</span>
                <span class="value" id="product-discount-detail">- Rp 650.000</span>
              </div>
              <div class="summary-detail-row voucher" id="voucher-product-row" style="display: none;">
                <span class="label">🎁 Diskon Voucher</span>
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
                <span class="label">🎁 Diskon Ongkir</span>
                <span class="value" id="shipping-discount-detail">- Rp 0</span>
              </div>
            </div>
          </div>
        </div>

        <!-- TOTAL -->
        <div class="summary-total-section">
          <div class="summary-total-row">
            <span class="label">Total Pembayaran</span>
            <span class="value" id="total-final">Rp 5.475.000</span>
          </div>
        </div>

        <button class="btn-checkout" id="btn-checkout" <?php if (!$alamat_checkout): ?>disabled<?php endif; ?>>
          <span>💳</span>
          <span>Bayar Sekarang</span>
        </button>
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
    </div>

    <script>
      // State - DUMMY PRICING
      const state = {
        totalBefore: 6100000,
        productDiscount: 650000,
        subtotal: 5450000,
        shipping: 25000,
        voucherDiscount: 0,
        shippingDiscount: 0, // TAMBAHAN UNTUK DISKON ONGKIR
        promoCode: null,
        selectedPayment: null
      };

      // Format Rupiah
      function formatRupiah(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
      }

      // Calculate Total
      function calculateTotal() {
        return state.subtotal + (state.shipping - state.shippingDiscount) - state.voucherDiscount;
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
      // Apply Promo
      function applyPromo(code) {
        code = code.toUpperCase().trim();

        const promos = {
          'DISKON10': {
            type: 'percentage',
            value: 10,
            desc: 'Diskon 10%'
          },
          'GRATIS50': {
            type: 'fixed',
            value: 50000,
            desc: 'Potongan Rp 50.000'
          },
          'FREEONGKIR': {
            type: 'shipping',
            value: 0,
            desc: 'Gratis Ongkir'
          }
        };

        if (!promos[code]) {
          showNotification('❌ Kode promo tidak valid', 'error');
          return;
        }

        const promo = promos[code];
        applyDiscount(code, promo.type, promo.value, promo.desc);
      }

      // Apply Voucher
      function applyVoucher(code, type, value) {
        let desc = '';
        if (type === 'percentage') desc = `Diskon ${value}%`;
        else if (type === 'fixed') desc = `Potongan Rp ${value.toLocaleString('id-ID')}`;
        else if (type === 'shipping') desc = 'Gratis Ongkir';

        applyDiscount(code, type, value, desc);
      }

      // Core Apply Discount
      function applyDiscount(code, type, value, description) {
        let discountAmount = 0;

        if (type === 'percentage') {
          discountAmount = Math.floor(state.subtotal * (value / 100));
          state.voucherDiscount = discountAmount;
          state.shippingDiscount = 0;
        } else if (type === 'fixed') {
          discountAmount = value;
          state.voucherDiscount = discountAmount;
          state.shippingDiscount = 0;
        } else if (type === 'shipping') {
          state.shippingDiscount = state.shipping; // GRATIS ONGKIR
          state.voucherDiscount = 0;
        }

        state.promoCode = code;

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
        closeOffcanvas();
      }

      // Remove Promo - FIXED
      function removePromo() {
        // Reset state
        state.voucherDiscount = 0;
        state.shippingDiscount = 0;
        state.promoCode = null;

        // Reset promo container UI
        const promoContainer = document.getElementById('promo-container');
        promoContainer.innerHTML = `
          <div class="promo-input-group">
            <input type="text" class="promo-input" id="promo-code" placeholder="Masukkan kode promo">
            <button class="btn-apply-promo" id="btn-apply-promo">Pakai</button>
          </div>

          <div class="voucher-section-title">✨ Voucher Tersedia</div>

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
        `;

        // Re-attach promo events
        attachPromoEvents();

        // Update display
        updatePriceDisplay();
        showNotification('✅ Promo berhasil dihapus', 'success');
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

      // Attach Promo Events - FIXED
      function attachPromoEvents() {
        const btnApplyPromo = document.getElementById('btn-apply-promo');
        const promoCodeInput = document.getElementById('promo-code');

        if (btnApplyPromo) {
          btnApplyPromo.addEventListener('click', function() {
            const code = promoCodeInput.value;
            if (code) {
              applyPromo(code);
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
                applyPromo(code);
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

      // Process Payment - FIXED: Insert ke database
      function processPayment() {
        if (!state.selectedPayment) {
          showNotification('⚠️ Pilih metode pembayaran terlebih dahulu', 'error');
          return;
        }

        const btnConfirm = document.getElementById('btn-confirm-payment');
        const originalText = btnConfirm.innerHTML;
        btnConfirm.innerHTML = '<span class="spinner"></span> Memproses...';
        btnConfirm.disabled = true;

        // Hitung total pembayaran
        const totalPembayaran = calculateTotal();
        const ongkir = state.shipping - state.shippingDiscount;

        // Map metode pembayaran ke format database
        const metodePembayaranMap = {
          'gopay': 'E-wallet',
          'ovo': 'E-wallet',
          'dana': 'E-wallet',
          'bca': 'Rekening',
          'mandiri': 'Rekening'
        };

        const metodePembayaran = metodePembayaranMap[state.selectedPayment] || 'E-wallet';

        // Prepare data untuk dikirim
        const dataTransaksi = {
          total: totalPembayaran,
          metode_pembayaran: metodePembayaran,
          bayar: totalPembayaran, // Diasumsikan bayar pas (bisa diubah sesuai kebutuhan)
          kembali: 0, // Karena bayar pas
          ongkir: ongkir
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

              closePaymentModal();
              showPaymentSuccess(idTransaksi);
              showNotification('✅ Pembayaran berhasil!', 'success');
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
          });
      }

      // Show Payment Success
      function showPaymentSuccess(idTransaksi) {
        // Gunakan ID transaksi dari database atau generate fallback
        const orderId = idTransaksi || 'ORDER-' + new Date().getFullYear() + '-' + Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
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
            closeModal('modalAlamat');
            closeOffcanvas();
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

      <?php if (isset($has_no_address) && $has_no_address): ?>
        document.addEventListener('DOMContentLoaded', function() {
          // Tampilkan notifikasi
          showNotification('📍 Silakan tambahkan alamat pengiriman terlebih dahulu', 'warning');

          // Auto-open modal tambah alamat setelah delay singkat
          setTimeout(() => {
            openModalTambahAlamat();
          }, 800);
        });
      <?php endif; ?>
      // ========== UPDATE CHECKOUT BUTTON STATE ==========
      function updateCheckoutButtonState() {
        const btnCheckout = document.getElementById('btn-checkout');
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
      }

      // Panggil saat halaman load
      document.addEventListener('DOMContentLoaded', function() {
        updateCheckoutButtonState();

        // ... kode lainnya tetap sama
      });
    </script>

</body>

</html>