<?php
    if (!function_exists('formatCurrencyIDR')) {
        function formatCurrencyIDR($amount)
        {
            return "Rp " . number_format($amount, 2, ',', '.');
        }
    }
?>