=== SKU Generator for WooCommerce ===
Contributors: algoritmika,anbinder
Tags: woocommerce,sku,stock keeping unit
Requires at least: 4.4
Tested up to: 4.7
Stable tag: 1.2.0
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

SKU Generator for WooCommerce plugin adds full Stock Keeping Unit (SKU) support to your WooCommerce shop.

== Description ==

Add full SKU support to WooCommerce:

* Set SKU by custom format (prefix, suffix, number length, category, tag) automatically for new products.
* Regenerate SKUs for all existing products (or regenerate only for products with no SKU).
* Add product searching by SKU on frontend.
* Add SKU to customer emails.
* Allow Duplicate SKUs.

= Feedback =
* We are open to your suggestions and feedback, and thank you for using or trying out one of our plugins!
* Drop us a line at [www.algoritmika.com](http://www.algoritmika.com).

= More =
* Visit the [SKU Generator for WooCommerce plugin page](https://wpcodefactory.com/item/sku-generator-for-woocommerce-plugin/).

== Installation ==

1. Upload the entire 'sku-for-woocommerce' folder to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to WooCommerce > Settings > SKU.

== Frequently Asked Questions ==

= What options are in Pro version? =

[SKU Generator for WooCommerce Pro](https://wpcodefactory.com/item/sku-generator-for-woocommerce-plugin/) includes options to generate SKUs sequentially or randomly. Also there are additional SKU format options for variable products.

== Screenshots ==

1. SKU Generator for WooCommerce - SKU Format Options.
2. SKU Generator for WooCommerce - More Options.
3. SKU Generator for WooCommerce - Categories Options.
4. SKU Generator for WooCommerce - Tags Options.
5. SKU Generator for WooCommerce - SKU Regenerator Tool.

== Changelog ==

= 1.2.0 - 18/04/2017 =
* Dev - WooCommerce v3.0.0 compatibility - `get_child()` replaced with `wc_get_product()`.
* Dev - "Template" option added.
* Dev - "Pseudorandom - Hash (max 10 digits)" option added to "Number Generation".
* Dev - "Generate SKUs Only for Products with Empty SKU" option added.
* Dev - "Categories Options" section added.
* Dev - "Tags Options" section added.
* Dev - "Search by SKU" option added.
* Dev - "Add SKU to Customer Emails" option added.
* Dev - "Automatically Generate SKU for New Products" option added.
* Dev - "Reset Section Settings" option added.
* Dev - `WP_Query` optimized to return `ids` only.
* Tweak - Plugin link updated from `coder.fm` to `wpcodefactory.com`.
* Tweak - `general` section cleanup.
* Tweak - Default values added to all `get_option()` calls.
* Tweak - Filter rewritten.

= 1.1.3 - 21/12/2016 =
* Fix - `load_plugin_textdomain()` moved from `init` hook to constructor.
* Fix - Generating SKU on "duplicate product" action.
* Dev - Language (POT) file updated.

= 1.1.2 - 21/08/2016 =
* Dev - "Allow duplicate SKUs" option added.
* Dev - Version system added.
* Tweak - Plugin renamed.
* Tweak - Contributors changed.
* Tweak - Option filter added.

= 1.1.1 - 13/06/2016 =
* Dev - `get_available_variations` replaced with `get_all_variations`.
* Dev - SKU Regenerator tool - No auto preview after generation.

= 1.1.0 - 10/06/2016 =
* Dev - Sequential SKU number format option added.
* Dev - Language (POT) file added.
* Dev - Multisite support added.
* Dev - Description added to "SKU Format Options".

= 1.0.0 - 06/08/2015 =
* Initial Release.

== Upgrade Notice ==

= 1.0.0 =
This is the first release of the plugin.
