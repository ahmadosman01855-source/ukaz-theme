<?php
/**
 * UKAZ Theme Functions & Setup
 * Version: 1.4.0
 */

if (!defined('ABSPATH')) {
    exit;
}

function ukaz_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary-menu' => __('Primary Navigation Menu', 'ukaz-theme'),
        'mobile-menu'  => __('Mobile Navigation Menu', 'ukaz-theme'),
    ));
}
add_action('after_setup_theme', 'ukaz_theme_setup');

// ==========================================
// 1. DEDICATED WP ADMIN SETTINGS MENU: UKAZ সেটিংস
// ==========================================
function ukaz_add_admin_menu() {
    add_menu_page(
        'UKAZ বাটন ও শপ সেটিংস',
        'UKAZ সেটিংস',
        'manage_options',
        'ukaz-settings',
        'ukaz_render_admin_settings_page',
        'dashicons-store',
        58
    );
}
add_action('admin_menu', 'ukaz_add_admin_menu');

// Register all settings in the database
function ukaz_register_settings() {
    // Phone Call Settings
    register_setting('ukaz_settings_group', 'ukaz_phone_number');
    register_setting('ukaz_settings_group', 'ukaz_phone_label');
    register_setting('ukaz_settings_group', 'ukaz_phone_sublabel');
    register_setting('ukaz_settings_group', 'ukaz_phone_show');

    // WhatsApp Settings
    register_setting('ukaz_settings_group', 'ukaz_whatsapp_number');
    register_setting('ukaz_settings_group', 'ukaz_whatsapp_label');
    register_setting('ukaz_settings_group', 'ukaz_whatsapp_sublabel');
    register_setting('ukaz_settings_group', 'ukaz_whatsapp_show');

    // Messenger Settings
    register_setting('ukaz_settings_group', 'ukaz_messenger_user');
    register_setting('ukaz_settings_group', 'ukaz_messenger_label');
    register_setting('ukaz_settings_group', 'ukaz_messenger_sublabel');
    register_setting('ukaz_settings_group', 'ukaz_messenger_show');

    // Quick Order Settings
    register_setting('ukaz_settings_group', 'ukaz_quick_order_label');
    register_setting('ukaz_settings_group', 'ukaz_quick_order_sublabel');
    register_setting('ukaz_settings_group', 'ukaz_delivery_inside');
    register_setting('ukaz_settings_group', 'ukaz_delivery_outside');
}
add_action('admin_init', 'ukaz_register_settings');

// Render Admin Settings Page HTML
function ukaz_render_admin_settings_page() {
    ?>
    <div class="wrap" style="max-width: 900px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif;">
        <div style="background: #111111; color: #ffffff; padding: 24px 30px; border-radius: 16px; margin: 20px 0; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 14px rgba(0,0,0,0.1);">
            <div>
                <h1 style="color: #B5945A; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: 1px;">UKAZ কুইক বাটন ও অর্ডার সেটিংস</h1>
                <p style="margin: 6px 0 0; color: #a1a1a6; font-size: 13px;">প্রোডাক্ট পেজের কল, হোয়াটসঅ্যাপ, মেসেঞ্জার বাটন এবং ডেলিভারি চার্জ সহজেই এখান থেকে পরিবর্তন করুন।</p>
            </div>
            <span style="background: #B5945A; color: #111; font-weight: bold; font-size: 11px; padding: 4px 10px; border-radius: 20px;">v1.4.0</span>
        </div>

        <?php settings_errors(); ?>

        <form method="post" action="options.php" style="background: #ffffff; padding: 30px; border-radius: 16px; border: 1px solid #e5e5ea; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
            <?php settings_fields('ukaz_settings_group'); ?>
            <?php do_settings_sections('ukaz_settings_group'); ?>

            <!-- WhatsApp Settings Card -->
            <div style="border-bottom: 1px solid #eeeeee; padding-bottom: 24px; margin-bottom: 24px;">
                <h2 style="font-size: 16px; font-weight: 700; color: #1E7B44; display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                    <span class="dashicons dashicons-format-chat" style="color: #25D366;"></span> হোয়াটসঅ্যাপ (WhatsApp) বাটন কনফিগারেশন
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 220px;"><label for="ukaz_whatsapp_show">বাটনটি দেখাবেন কি না?</label></th>
                        <td>
                            <label>
                                <input type="checkbox" name="ukaz_whatsapp_show" id="ukaz_whatsapp_show" value="1" <?php checked('1', get_option('ukaz_whatsapp_show', '1')); ?> />
                                প্রোডাক্ট পেজে হোয়াটসঅ্যাপ বাটন অন রাখুন
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_whatsapp_number">হোয়াটসঅ্যাপ নম্বর</label></th>
                        <td>
                            <input name="ukaz_whatsapp_number" type="text" id="ukaz_whatsapp_number" value="<?php echo esc_attr(get_option('ukaz_whatsapp_number', '8801855456185')); ?>" class="regular-text" placeholder="যেমন: 88018XXXXXXXX" />
                            <p class="description">কান্ট্রি কোড (88) সহ কোনো স্পেস বা ড্যাশ ছাড়া নম্বর লিখুন।</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_whatsapp_label">বাটন টেক্সট (Title)</label></th>
                        <td>
                            <input name="ukaz_whatsapp_label" type="text" id="ukaz_whatsapp_label" value="<?php echo esc_attr(get_option('ukaz_whatsapp_label', 'হোয়াটসঅ্যাপে অর্ডার করুন')); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_whatsapp_sublabel">সাব-টেক্সট (Subtitle)</label></th>
                        <td>
                            <input name="ukaz_whatsapp_sublabel" type="text" id="ukaz_whatsapp_sublabel" value="<?php echo esc_attr(get_option('ukaz_whatsapp_sublabel', 'পণ্যের তথ্যসহ বার্তা পাঠান')); ?>" class="regular-text" />
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Phone Call Settings Card -->
            <div style="border-bottom: 1px solid #eeeeee; padding-bottom: 24px; margin-bottom: 24px;">
                <h2 style="font-size: 16px; font-weight: 700; color: #B5945A; display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                    <span class="dashicons dashicons-phone"></span> ফোন কল (Call) বাটন কনফিগারেশন
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 220px;"><label for="ukaz_phone_show">বাটনটি দেখাবেন কি না?</label></th>
                        <td>
                            <label>
                                <input type="checkbox" name="ukaz_phone_show" id="ukaz_phone_show" value="1" <?php checked('1', get_option('ukaz_phone_show', '1')); ?> />
                                প্রোডাক্ট পেজে ফোন কল বাটন অন রাখুন
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_phone_number">ফোন নম্বর</label></th>
                        <td>
                            <input name="ukaz_phone_number" type="text" id="ukaz_phone_number" value="<?php echo esc_attr(get_option('ukaz_phone_number', '01855456185')); ?>" class="regular-text" placeholder="যেমন: 018XXXXXXXX" />
                            <p class="description">যে নম্বরে গ্রাহকরা সরাসরি কল দেবে।</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_phone_label">বাটন টেক্সট (Title)</label></th>
                        <td>
                            <input name="ukaz_phone_label" type="text" id="ukaz_phone_label" value="<?php echo esc_attr(get_option('ukaz_phone_label', 'ফোনে অর্ডার করুন')); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_phone_sublabel">সাব-টেক্সট (Subtitle)</label></th>
                        <td>
                            <input name="ukaz_phone_sublabel" type="text" id="ukaz_phone_sublabel" value="<?php echo esc_attr(get_option('ukaz_phone_sublabel', 'সরাসরি কথা বলে অর্ডার দিন')); ?>" class="regular-text" />
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Facebook Messenger Settings Card -->
            <div style="border-bottom: 1px solid #eeeeee; padding-bottom: 24px; margin-bottom: 24px;">
                <h2 style="font-size: 16px; font-weight: 700; color: #0064E0; display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                    <span class="dashicons dashicons-facebook-alt"></span> ফেসবুক মেসেঞ্জার বাটন কনফিগারেশন
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 220px;"><label for="ukaz_messenger_show">বাটনটি দেখাবেন কি না?</label></th>
                        <td>
                            <label>
                                <input type="checkbox" name="ukaz_messenger_show" id="ukaz_messenger_show" value="1" <?php checked('1', get_option('ukaz_messenger_show', '1')); ?> />
                                প্রোডাক্ট পেজে মেসেঞ্জার বাটন অন রাখুন
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_messenger_user">ফেসবুক পেজ ইউজারনেম</label></th>
                        <td>
                            <input name="ukaz_messenger_user" type="text" id="ukaz_messenger_user" value="<?php echo esc_attr(get_option('ukaz_messenger_user', 'qawmihaaat')); ?>" class="regular-text" placeholder="যেমন: qawmihaaat বা আপনার পেজ ইউজারনেম" />
                            <p class="description">আপনার ফেসবুক পেজের ইউজারনেম (m.me/username অনুযায়ী রিডাইরেক্ট হবে)।</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_messenger_label">বাটন টেক্সট (Title)</label></th>
                        <td>
                            <input name="ukaz_messenger_label" type="text" id="ukaz_messenger_label" value="<?php echo esc_attr(get_option('ukaz_messenger_label', 'মেসেঞ্জারে অর্ডার করুন')); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_messenger_sublabel">সাব-টেক্সট (Subtitle)</label></th>
                        <td>
                            <input name="ukaz_messenger_sublabel" type="text" id="ukaz_messenger_sublabel" value="<?php echo esc_attr(get_option('ukaz_messenger_sublabel', 'ইনবক্সে মেসেজ দিয়ে অর্ডার দিন')); ?>" class="regular-text" />
                        </td>
                    </tr>
                </table>
            </div>

            <!-- 1-Click Order & Delivery Fees Card -->
            <div style="margin-bottom: 24px;">
                <h2 style="font-size: 16px; font-weight: 700; color: #111111; display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                    <span class="dashicons dashicons-cart"></span> এক্সপ্রেস অর্ডার ও ডেলিভারি চার্জ সেটিংস
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 220px;"><label for="ukaz_quick_order_label">এক্সপ্রেস বাটন টেক্সট</label></th>
                        <td>
                            <input name="ukaz_quick_order_label" type="text" id="ukaz_quick_order_label" value="<?php echo esc_attr(get_option('ukaz_quick_order_label', 'এখনই অর্ডার করুন')); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_quick_order_sublabel">এক্সপ্রেস সাব-টেক্সট</label></th>
                        <td>
                            <input name="ukaz_quick_order_sublabel" type="text" id="ukaz_quick_order_sublabel" value="<?php echo esc_attr(get_option('ukaz_quick_order_sublabel', 'সরাসরি অর্ডার সম্পন্ন করুন')); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_delivery_inside">ঢাকার ভিতরে ডেলিভারি চার্জ (৳)</label></th>
                        <td>
                            <input name="ukaz_delivery_inside" type="number" id="ukaz_delivery_inside" value="<?php echo esc_attr(get_option('ukaz_delivery_inside', '70')); ?>" class="small-text" /> টাকা
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="ukaz_delivery_outside">ঢাকার বাইরে ডেলিভারি চার্জ (৳)</label></th>
                        <td>
                            <input name="ukaz_delivery_outside" type="number" id="ukaz_delivery_outside" value="<?php echo esc_attr(get_option('ukaz_delivery_outside', '130')); ?>" class="small-text" /> টাকা
                        </td>
                    </tr>
                </table>
            </div>

            <div style="padding-top: 15px;">
                <?php submit_button('সব পরিবর্তন সংরক্ষণ করুন', 'primary', 'submit', false, array('style' => 'background: #111111; border-color: #111111; font-weight: bold; border-radius: 8px; padding: 6px 20px; font-size: 14px;')); ?>
            </div>
        </form>
    </div>
    <?php
}

function ukaz_enqueue_scripts() {
    wp_enqueue_style('ukaz-google-fonts', 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap', array(), null);
    wp_enqueue_script('ukaz-tailwind', 'https://cdn.tailwindcss.com', array(), null, false);
    wp_enqueue_script('ukaz-lucide', 'https://unpkg.com/lucide@latest', array(), null, true);
    wp_enqueue_style('ukaz-main-style', get_stylesheet_uri(), array(), '1.4.0');

    $tailwind_config = "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brandDark: '#111111',
                        brandGold: '#B5945A',
                        brandGoldHover: '#9A7B44',
                        brandBg: '#FBFBFD',
                        brandSurface: '#FFFFFF',
                        brandBorder: '#E5E5EA',
                        brandGrayText: '#6E6E73'
                    },
                    fontFamily: {
                        sans: ['Hind Siliguri', 'sans-serif']
                    }
                }
            }
        };
    ";
    wp_add_inline_script('ukaz-tailwind', $tailwind_config);
}
add_action('wp_enqueue_scripts', 'ukaz_enqueue_scripts');

function ukaz_get_cart_count() {
    if (function_exists('WC') && isset(WC()->cart) && is_object(WC()->cart)) {
        return WC()->cart->get_cart_contents_count();
    }
    return 0;
}

// Dynamic 1-Click Fast Direct Checkout AJAX Endpoint
function ukaz_process_quick_order() {
    check_ajax_referer('ukaz_order_nonce', 'security');

    $product_id   = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $variation_id = isset($_POST['variation_id']) ? intval($_POST['variation_id']) : 0;
    $name         = isset($_POST['billing_name']) ? sanitize_text_field($_POST['billing_name']) : '';
    $phone        = isset($_POST['billing_phone']) ? sanitize_text_field($_POST['billing_phone']) : '';
    $address      = isset($_POST['billing_address']) ? sanitize_textarea_field($_POST['billing_address']) : '';
    $area         = isset($_POST['delivery_area']) ? sanitize_text_field($_POST['delivery_area']) : 'inside';
    $custom_notes = isset($_POST['order_variants_note']) ? sanitize_text_field($_POST['order_variants_note']) : '';

    if (!$product_id || empty($name) || empty($phone) || empty($address)) {
        wp_send_json_error(array('message' => 'সবগুলো প্রয়োজনীয় তথ্য প্রদান করুন।'));
    }

    if (!function_exists('wc_create_order')) {
        wp_send_json_error(array('message' => 'WooCommerce সক্রিয় নেই।'));
    }

    $product = wc_get_product($variation_id ? $variation_id : $product_id);
    if (!$product) {
        wp_send_json_error(array('message' => 'পণ্যটি খুঁজে পাওয়া যায়নি।'));
    }

    // Read delivery fee from options
    $inside_fee  = intval(get_option('ukaz_delivery_inside', '70'));
    $outside_fee = intval(get_option('ukaz_delivery_outside', '130'));
    $shipping_cost = ($area === 'outside') ? $outside_fee : $inside_fee;

    $order = wc_create_order();
    $order->add_product($product, 1);

    $address_args = array(
        'first_name' => $name,
        'phone'      => $phone,
        'address_1'  => $address,
        'country'    => 'BD'
    );
    $order->set_address($address_args, 'billing');
    $order->set_address($address_args, 'shipping');

    // Add shipping item
    $shipping_item = new WC_Order_Item_Shipping();
    $shipping_item->set_method_title(($area === 'outside') ? 'ঢাকার বাইরে ডেলিভারি' : 'ঢাকার ভেতরে ডেলিভারি');
    $shipping_item->set_method_id('flat_rate');
    $shipping_item->set_total($shipping_cost);
    $order->add_item($shipping_item);

    if (!empty($custom_notes)) {
        $order->add_order_note('ভেরিয়েন্ট তথ্য: ' . $custom_notes);
    }
    
    $order->set_payment_method('cod');
    $order->set_payment_method_title('ক্যাশ অন ডেলিভারি');
    $order->calculate_totals();
    $order->update_status('processing', 'UKAZ ১-ক্লিক এক্সপ্রেস অর্ডারের মাধ্যমে সম্পন্ন হয়েছে।');

    wp_send_json_success(array(
        'message'  => 'ধন্যবাদ! আপনার অর্ডারটি সফলভাবে সম্পন্ন হয়েছে।',
        'order_id' => $order->get_id()
    ));
}
add_action('wp_ajax_ukaz_quick_order', 'ukaz_process_quick_order');
add_action('wp_ajax_nopriv_ukaz_quick_order', 'ukaz_process_quick_order');
