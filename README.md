WC Deposit Limits
==========================

This is a plugin that gives you a bit more flexibility with the WooCommerce Deposits plugin 
found here: https://woocommerce.com/products/woocommerce-deposits/

Out of the box, you can make deposits available for only specific products or for all products. 
 What I wanted to do was to only allow deposits on a handful of products unconditionally, but
 also allow deposits for all products once the cart total (counting the full amount, not just the deposit amount)
  had reached a certain amount

##Requirements

Woocommerce and WooCommerce Deposits

##Installation

Install like any other WordPress plugin...

1. Download the zip file
1. Upload the zip via your WP Dashboard Plugins->AddNew->Upload Plugin

Or

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)

##Configuration

To keep this plugin lean, there is no configuration screen, instead, the cart minimum is hardcoded. 
You can change the minimum by editing the file on line 28:

`const minimum = 4500;`