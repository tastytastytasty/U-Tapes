<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ULTRA SIMPLE TEST CONTROLLER
 * Letakkan di: application/controllers/Testpembayaran.php
 * 
 * Test URLs:
 * 1. http://yoursite.com/index.php/testpembayaran
 * 2. http://yoursite.com/index.php/testpembayaran/coba
 * 3. http://yoursite.com/index.php/testpembayaran/coba/TRX001
 */
class Testpembayaran extends CI_Controller {
    
    /**
     * Test 1: Apakah controller ke-load?
     * URL: /testpembayaran
     */
    public function index() {
        echo "<h1 style='color: green;'>✅ CONTROLLER WORKS!</h1>";
        echo "<p>File: " . __FILE__ . "</p>";
        echo "<p>Class: " . get_class($this) . "</p>";
        echo "<hr>";
        
        echo "<h2>Test Links:</h2>";
        echo "<ul>";
        echo "<li><a href='" . site_url('testpembayaran/coba/TRX001') . "'>Test dengan parameter TRX001</a></li>";
        echo "<li><a href='" . site_url('testpembayaran/coba/12345') . "'>Test dengan parameter angka</a></li>";
        echo "<li><a href='" . site_url('pembayaran/TRX001') . "'>Test pembayaran/TRX001 (REAL URL)</a></li>";
        echo "</ul>";
        
        echo "<hr>";
        echo "<h2>Config Check:</h2>";
        echo "<p>Base URL: " . base_url() . "</p>";
        echo "<p>Site URL: " . site_url() . "</p>";
    }
    
    /**
     * Test 2: Apakah parameter ke-terima?
     * URL: /testpembayaran/coba/TRX001
     */
    public function coba($id = null) {
        if (!$id) {
            echo "<h1 style='color: red;'>❌ NO PARAMETER!</h1>";
        } else {
            echo "<h1 style='color: green;'>✅ PARAMETER RECEIVED!</h1>";
            echo "<p style='font-size: 24px;'>ID: <strong>{$id}</strong></p>";
        }
        
        echo "<hr>";
        echo "<p><a href='" . site_url('testpembayaran') . "'>Back to test page</a></p>";
    }
}