<?php

use Victorybiz\GeoIPLocation\GeoIPLocation;

if (!function_exists('currency_payment_Invoice')) {
    function currency_payment_Invoice()
    {
        $geoip = new GeoIPLocation();
        if ($geoip->getCountryCode() == 'EG') {
            $currency_payment = 'EGP';
        } else {

            $currency_payment = 'USD';
        }
        return $currency_payment;
    }
} //end of currency_payment
if (!function_exists('order_variable_amount_id_Invoice')) {
    function order_variable_amount_id_Invoice()
    {
        return 25;
    }
} //end of order_variable_amount_id
if (!function_exists('invoice_variable_amount_id_Invoice')) {
    function invoice_variable_amount_id_Invoice()
    {
        return 24;
    }
} //end of invoice_variable_amount_id

if (!function_exists('url_link_Invoice')) {
    function url_link_Invoice()
    {
        return "https://community.xpay.app/api/v1/payments/pay/variable-amount";
        //  return "https://staging.xpay.app/api/v1/payments/pay/variable-amount";
    }
} //end of url_link


if (!function_exists('success_url_Invoice')) {
    function success_url_Invoice()
    {
        //   $success_url = 'http://127.0.0.1:8000/customer/order/success';
        $success_url = 'https://exsab.net/customer/order/success';

        return $success_url;
    }
} //end of success_url

if (!function_exists('success_renewInvoice_url_Invoice')) {
    function success_renewInvoice_url_Invoice()
    {
        // $success_url = 'https://exsab.net/customer/invoices/success';
        $success_url = 'https://exsab.net/customer/invoices/success';
        return $success_url;
    }
} //end of success_renewInvoice_url

if (!function_exists('x_api_key_order_Invoice')) {
    function x_api_key_order_Invoice()
    {
        return 'so2WXCC4.7DaDo97kD6TRDNFyngqpCcxzRvMo0Bjr';
    }
} //end of x_api_key_order
if (!function_exists('x_api_key_invoice_Invoice')) {
    function x_api_key_invoice_Invoice()
    {
        return 'Rd0ZljSS.lay52iFwenR61NMMs1Rc4bEuihnp1amD';
    }
} //end of x_api_key_invoice

if (!function_exists('comunityId_Invoice')) {
    function comunityId_Invoice()
    {
        //   return 'YBZyk2k'; //test
        return 'P8p9O3V'; /// live
    }
} //end of comunityId
