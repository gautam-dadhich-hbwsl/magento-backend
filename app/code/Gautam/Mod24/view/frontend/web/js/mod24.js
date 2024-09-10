define([
    'jquery',
    'mage/url',
    'Magento_Customer/js/customer-data'
], function ($, urlBuilder, customerData) {
    'use strict';

    return function (config) {
        // Log the configuration data
        console.log('Sales Emails:', config.salesEmails);
        console.log('Payment Methods:', config.paymentMethods);
        console.log('Shipping Config:', config.shippingConfig);
        console.log('Tax Config:', config.taxConfig);
        console.log('Store Information:', config.storeInformation);
        console.log('General Config:', config.generalConfig);

        // Example: Using the configuration for some purpose
        // e.g., sending an AJAX request or manipulating the DOM
    };
});
