<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-brandBg text-brandDark font-sans antialiased selection:bg-brandGold selection:text-white pb-24 md:pb-0'); ?>>

<!-- Top Announcement Banner -->
<div class="bg-brandDark text-white text-[11px] md:text-xs py-2 text-center font-medium tracking-wide px-4">
    সারাদেশে ক্যাশ অন ডেলিভারি এবং দ্রুততম ডেলিভারি সুবিধা ✨
</div>

<!-- Apple-inspired Frosted Sticky Header -->
<header class="sticky top-0 z-50 bg-brandBg/80 backdrop-blur-xl border-b border-brandBorder transition-all duration-300">
    <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
        
        <div class="flex items-center gap-3">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded-full border border-brandGold/40 flex items-center justify-center bg-brandGold/10 group-hover:bg-brandGold group-hover:text-white transition-all">
                    <svg class="w-4 h-4 text-brandGold group-hover:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 21V10a8 8 0 0 1 16 0v11"/>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold tracking-widest text-brandDark uppercase font-sans">UKAZ</span>
                    <span class="text-[9px] text-brandGold tracking-wider -mt-1 font-semibold">MODEST WEAR</span>
                </div>
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-brandGrayText">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-brandDark transition">হোম</a>
            <a href="<?php echo esc_url(home_url('/#categories')); ?>" class="hover:text-brandDark transition">খিমার</a>
            <a href="<?php echo esc_url(home_url('/#categories')); ?>" class="hover:text-brandDark transition">প্লাজু খিমার</a>
            <a href="<?php echo esc_url(home_url('/#categories')); ?>" class="hover:text-brandDark transition">বোরখা</a>
            <a href="<?php echo esc_url(home_url('/#categories')); ?>" class="hover:text-brandDark transition">হিজাব</a>
        </nav>

        <div class="flex items-center gap-2 md:gap-4">
            <!-- Trigger Cart Drawer -->
            <button type="button" onclick="toggleCartDrawer(true)" class="relative p-2.5 rounded-full bg-white border border-brandBorder shadow-sm text-brandDark hover:border-brandGold transition flex items-center justify-center" aria-label="Cart">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                <span id="headerCartCount" class="cart-count-badge absolute -top-1 -right-1 bg-brandGold text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold">
                    <?php echo ukaz_get_cart_count(); ?>
                </span>
            </button>
        </div>
    </div>
</header>

<!-- Slide-Over Side Cart Drawer (Apple Minimal Style) -->
<div id="cartDrawerBackdrop" onclick="toggleCartDrawer(false)" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 opacity-0 pointer-events-none transition-opacity duration-300"></div>

<aside id="cartDrawer" class="fixed top-0 right-0 bottom-0 w-full max-w-sm bg-white z-50 shadow-2xl border-l border-brandBorder transform translate-x-full transition-transform duration-300 flex flex-col justify-between p-6">
    <div class="flex items-center justify-between pb-4 border-b border-brandBorder">
        <div class="flex items-center gap-2">
            <i data-lucide="shopping-bag" class="w-5 h-5 text-brandGold"></i>
            <h3 class="font-bold text-base text-brandDark">আপনার শপিং ব্যাগ</h3>
        </div>
        <button type="button" onclick="toggleCartDrawer(false)" class="p-1 rounded-full text-brandGrayText hover:text-brandDark">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    <!-- Dynamic Cart Items Container -->
    <div class="flex-1 overflow-y-auto py-4 space-y-3" id="cartDrawerItems">
        <?php if (function_exists('WC') && WC()->cart && !WC()->cart->is_empty()) : ?>
            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : 
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>
                <div class="flex items-center gap-3 p-2.5 rounded-2xl bg-[#FBFBFD] border border-brandBorder">
                    <div class="w-14 h-16 rounded-xl overflow-hidden bg-neutral-100 shrink-0">
                        <?php echo $_product->get_image('thumbnail', array('class' => 'w-full h-full object-cover')); ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs font-bold text-brandDark truncate"><?php echo $_product->get_name(); ?></h4>
                        <span class="text-xs text-brandGold font-semibold"><?php echo WC()->cart->get_product_price($_product); ?></span>
                        <span class="text-[11px] text-brandGrayText block">পরিমাণ: <?php echo $cart_item['quantity']; ?></span>
                    </div>
                    <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>" class="text-neutral-400 hover:text-red-500 p-1">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </a>
                </div>
            <?php 
                endif; 
            endforeach; 
            ?>
        <?php else : ?>
            <div class="text-center py-16 space-y-2">
                <div class="w-12 h-12 rounded-full bg-neutral-100 flex items-center justify-center mx-auto text-neutral-400">
                    <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                </div>
                <p class="text-xs text-brandGrayText">আপনার ব্যাগে কোনো পণ্য নেই।</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Cart Drawer Footer -->
    <div class="pt-4 border-t border-brandBorder space-y-3">
        <div class="flex items-center justify-between text-sm font-bold">
            <span>সর্বমোট:</span>
            <span class="text-brandDark"><?php echo (function_exists('WC') && WC()->cart) ? WC()->cart->get_cart_total() : '৳০'; ?></span>
        </div>
        <a href="<?php echo function_exists('wc_get_checkout_url') ? esc_url(wc_get_checkout_url()) : '#'; ?>" class="w-full py-3.5 bg-brandDark text-white font-bold rounded-2xl text-xs hover:bg-neutral-800 transition flex items-center justify-center gap-2 shadow-md">
            <span>চেকআউট সম্পন্ন করুন</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>
</aside>

<script>
    function toggleCartDrawer(open) {
        const drawer = document.getElementById('cartDrawer');
        const backdrop = document.getElementById('cartDrawerBackdrop');
        if (open) {
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
            backdrop.classList.add('opacity-100', 'pointer-events-auto');
            drawer.classList.remove('translate-x-full');
            drawer.classList.add('translate-x-0');
        } else {
            backdrop.classList.remove('opacity-100', 'pointer-events-auto');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
            drawer.classList.remove('translate-x-0');
            drawer.classList.add('translate-x-full');
        }
    }
</script>
