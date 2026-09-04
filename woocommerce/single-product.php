<?php
get_header(); ?>

<style>
    .ukaz-product-actions form.cart {
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }
    .ukaz-product-actions form.cart .variations {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.65rem;
    }
    .ukaz-product-actions form.cart .variations td.label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #111111;
        padding-bottom: 0.35rem;
        display: block;
        text-transform: capitalize;
    }
    .ukaz-product-actions form.cart .variations td.value select {
        width: 100%;
        padding: 0.65rem 1rem;
        border-radius: 0.85rem;
        border: 1px solid #E5E5EA;
        background-color: #FFFFFF;
        font-size: 0.85rem;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s;
    }
    .ukaz-product-actions form.cart .variations td.value select:focus {
        border-color: #111111;
    }
    .ukaz-product-actions .woocommerce-variation-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111111;
        margin-bottom: 0.5rem;
    }
    .ukaz-product-actions form.cart .quantity {
        display: inline-block;
        margin-right: 0.5rem;
    }
    .ukaz-product-actions form.cart .quantity input.qty {
        width: 65px;
        padding: 0.65rem;
        border-radius: 0.75rem;
        border: 1px solid #E5E5EA;
        text-align: center;
        font-size: 0.95rem;
        font-weight: 600;
    }
    .ukaz-product-actions form.cart button.single_add_to_cart_button {
        background-color: #4A2B43 !important;
        color: #FFFFFF !important;
        border-radius: 0.85rem !important;
        padding: 0.75rem 1.75rem !important;
        font-weight: 600 !important;
        font-size: 0.95rem !important;
        transition: all 0.2s ease;
    }
    .ukaz-product-actions form.cart button.single_add_to_cart_button:hover {
        background-color: #381f33 !important;
    }
</style>

<div class="max-w-6xl mx-auto px-4 py-6 md:py-12 pb-32 md:pb-12">
    <?php 
    while (have_posts()) : the_post(); 
        $product = function_exists('wc_get_product') ? wc_get_product(get_the_ID()) : null;
        $price_html = $product ? $product->get_price_html() : '';
        $product_title = get_the_title();
        $product_url   = get_permalink();

        $attachment_ids = $product ? $product->get_gallery_image_ids() : array();
        $main_img_url   = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&q=80&w=900';

        $show_wa          = get_option('ukaz_whatsapp_show', '1');
        $whatsapp_number  = get_option('ukaz_whatsapp_number', '8801855456185');
        $whatsapp_label   = get_option('ukaz_whatsapp_label', 'হোয়াটসঅ্যাপে অর্ডার করুন');
        $whatsapp_sublabel= get_option('ukaz_whatsapp_sublabel', 'পণ্যের তথ্যসহ বার্তা পাঠান');

        $wa_message = urlencode("আসসালামু আলাইকুম, আমি UKAZ থেকে এই পণ্যটি অর্ডার করতে চাই:\nপণ্য: " . $product_title . "\nলিংক: " . $product_url);
        $whatsapp_url = "https://api.whatsapp.com/send?phone=" . esc_attr($whatsapp_number) . "&text=" . $wa_message;

        $show_phone       = get_option('ukaz_phone_show', '1');
        $phone_number     = get_option('ukaz_phone_number', '01855456185');
        $phone_label      = get_option('ukaz_phone_label', 'ফোনে অর্ডার করুন');
        $phone_sublabel   = get_option('ukaz_phone_sublabel', 'সরাসরি কথা বলে অর্ডার দিন');
        $call_url         = "tel:" . esc_attr($phone_number);

        $show_messenger   = get_option('ukaz_messenger_show', '1');
        $messenger_user   = get_option('ukaz_messenger_user', 'qawmihaaat');
        $messenger_label  = get_option('ukaz_messenger_label', 'মেসেঞ্জারে অর্ডার করুন');
        $messenger_sublabel = get_option('ukaz_messenger_sublabel', 'ইনবক্সে মেসেজ দিয়ে অর্ডার দিন');
        $messenger_url    = "https://m.me/" . esc_attr($messenger_user);

        $quick_order_label    = get_option('ukaz_quick_order_label', 'এখনই অর্ডার করুন');
        $quick_order_sublabel = get_option('ukaz_quick_order_sublabel', 'সরাসরি অর্ডার সম্পন্ন করুন');
        $delivery_inside      = get_option('ukaz_delivery_inside', '70');
        $delivery_outside     = get_option('ukaz_delivery_outside', '130');
    ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-14 items-start">
            
            <!-- Gallery Showcase -->
            <div class="space-y-4">
                <div class="rounded-3xl overflow-hidden bg-neutral-100 border border-brandBorder shadow-sm aspect-[3/4] relative">
                    <img id="mainProductImage" src="<?php echo esc_url($main_img_url); ?>" class="w-full h-full object-cover transition-opacity duration-300" alt="<?php the_title(); ?>">
                    <span class="absolute top-4 left-4 bg-white/95 backdrop-blur-md text-brandDark text-[11px] font-bold px-3 py-1 rounded-full uppercase border border-white/80 shadow-sm">
                        UKAZ এক্সক্লুসিভ
                    </span>
                </div>

                <?php if (!empty($attachment_ids)) : ?>
                    <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-none">
                        <button type="button" onclick="switchMainImage('<?php echo esc_url($main_img_url); ?>', this)" class="gallery-thumb-btn w-16 h-20 rounded-xl overflow-hidden border-2 border-brandDark shrink-0 transition-all">
                            <img src="<?php echo esc_url($main_img_url); ?>" class="w-full h-full object-cover" alt="Main Thumb">
                        </button>
                        <?php foreach ($attachment_ids as $attachment_id) : 
                            $thumb_url = wp_get_attachment_image_url($attachment_id, 'large');
                        ?>
                            <button type="button" onclick="switchMainImage('<?php echo esc_url($thumb_url); ?>', this)" class="gallery-thumb-btn w-16 h-20 rounded-xl overflow-hidden border border-brandBorder shrink-0 opacity-70 hover:opacity-100 transition-all">
                                <img src="<?php echo esc_url($thumb_url); ?>" class="w-full h-full object-cover" alt="Gallery Thumb">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Product Purchase Details -->
            <div class="space-y-5">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-brandDark"><?php the_title(); ?></h1>
                    <div class="mt-2 text-2xl md:text-3xl font-bold text-[#111111]">
                        <?php echo $price_html; ?>
                    </div>
                </div>

                <?php if (has_excerpt()) : ?>
                    <p class="text-sm text-brandGrayText leading-relaxed">
                        <?php the_excerpt(); ?>
                    </p>
                <?php endif; ?>

                <div class="ukaz-product-actions border-y border-brandBorder py-4">
                    <?php 
                    if (function_exists('woocommerce_template_single_add_to_cart')) {
                        woocommerce_template_single_add_to_cart();
                    }
                    ?>
                </div>

                <!-- Multi-Channel Order Hub -->
                <div class="bg-[#FAF8F5] rounded-3xl p-5 border border-[#F0ECE1] space-y-4 shadow-sm">
                    <div class="flex items-center gap-2 text-xs font-bold text-brandDark">
                        <i data-lucide="headphones" class="w-4 h-4 text-brandGold"></i>
                        <span>আপনার যেভাবে সুবিধা, সেভাবেই অর্ডার করুন:</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <button type="button" onclick="prepareAndOpenModal()" class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-[#111111] text-white hover:bg-neutral-800 transition active:scale-[0.98] shadow-sm text-left">
                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                                <i data-lucide="zap" class="w-5 h-5 text-brandGold fill-brandGold"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-bold leading-tight"><?php echo esc_html($quick_order_label); ?></span>
                                <span class="block text-[10px] text-neutral-400 mt-0.5"><?php echo esc_html($quick_order_sublabel); ?></span>
                            </div>
                        </button>

                        <?php if ($show_wa == '1') : ?>
                            <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-[#E8F8EE] text-[#1E7B44] border border-[#CDEED8] hover:bg-[#ddf5e5] transition active:scale-[0.98] text-left">
                                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-5 h-5 text-[#25D366] fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.072-2.146-.531-1.859-.772-3.053-2.66-3.146-2.784-.093-.123-.746-.994-.746-1.895 0-.901.472-1.344.64-1.528.168-.184.367-.23.49-.23.123 0 .245.001.352.006.113.005.265-.043.414.316.153.368.523 1.277.569 1.37.046.093.076.2.015.323-.061.123-.092.2-.184.307-.092.108-.194.24-.277.323-.092.092-.188.192-.081.376.107.184.478.788 1.025 1.275.706.628 1.301.822 1.486.914.184.092.292.077.4-.046.108-.123.46-0.537.583-.721.123-.184.246-.153.414-.092.169.061 1.074.507 1.258.6.184.092.307.138.353.215.046.077.046.446-.098.851zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.301A9.957 9.957 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold leading-tight"><?php echo esc_html($whatsapp_label); ?></span>
                                    <span class="block text-[10px] text-neutral-500 mt-0.5"><?php echo esc_html($whatsapp_sublabel); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>

                        <?php if ($show_phone == '1') : ?>
                            <a href="<?php echo esc_url($call_url); ?>" class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-[#F5EFE6] text-brandDark border border-[#E8DFC9] hover:bg-[#ebe2d4] transition active:scale-[0.98] text-left">
                                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shrink-0 shadow-sm text-brandGold">
                                    <i data-lucide="phone-call" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold leading-tight"><?php echo esc_html($phone_label); ?></span>
                                    <span class="block text-[11px] font-semibold text-neutral-600 mt-0.5"><?php echo esc_html($phone_number); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>

                        <?php if ($show_messenger == '1') : ?>
                            <a href="<?php echo esc_url($messenger_url); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-[#EEF4FF] text-[#0064E0] border border-[#D5E3FF] hover:bg-[#e0ecff] transition active:scale-[0.98] text-left">
                                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-5 h-5 text-[#0084FF] fill-current" viewBox="0 0 24 24"><path d="M12 2C6.36 2 2 6.13 2 11.7c0 2.91 1.19 5.43 3.16 7.17v3.52l3.35-1.84c1.07.3 2.21.46 3.49.46 5.64 0 10-4.13 10-9.7S17.64 2 12 2zm1.06 13.06l-2.67-2.85-5.21 2.85 5.73-6.09 2.74 2.85 5.14-2.85-5.73 6.09z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold leading-tight"><?php echo esc_html($messenger_label); ?></span>
                                    <span class="block text-[10px] text-neutral-500 mt-0.5"><?php echo esc_html($messenger_sublabel); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Delivery Box -->
                <div class="bg-[#FBFBFD] rounded-2xl p-4 border border-brandBorder flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-neutral-100 flex items-center justify-center shrink-0 text-brandDark">
                        <i data-lucide="truck" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-brandGold block">ডেলিভারি</span>
                        <h4 class="text-xs font-bold text-brandDark">ডেলিভারি তথ্য</h4>
                        <p class="text-xs text-brandGrayText mt-0.5">ঢাকার ভেতরে ডেলিভারি চার্জ ৳<?php echo esc_html($delivery_inside); ?> এবং ঢাকার বাইরে ৳<?php echo esc_html($delivery_outside); ?>।</p>
                    </div>
                </div>

                <!-- Guarantees -->
                <div class="grid grid-cols-3 gap-2 text-center pt-1">
                    <div class="bg-white p-3 rounded-2xl border border-brandBorder shadow-sm flex flex-col items-center">
                        <i data-lucide="truck" class="w-4 h-4 text-brandGold mb-1"></i>
                        <span class="text-xs font-bold text-brandDark block">দ্রুত ডেলিভারি</span>
                        <span class="text-[10px] text-neutral-400">সারা দেশে</span>
                    </div>
                    <div class="bg-white p-3 rounded-2xl border border-brandBorder shadow-sm flex flex-col items-center">
                        <i data-lucide="package-check" class="w-4 h-4 text-brandGold mb-1"></i>
                        <span class="text-xs font-bold text-brandDark block">ক্যাশ অন ডেলিভারি</span>
                        <span class="text-[10px] text-neutral-400">পণ্য দেখে মূল্য</span>
                    </div>
                    <div class="bg-white p-3 rounded-2xl border border-brandBorder shadow-sm flex flex-col items-center">
                        <i data-lucide="headset" class="w-4 h-4 text-brandGold mb-1"></i>
                        <span class="text-xs font-bold text-brandDark block">অর্ডার সহায়তা</span>
                        <span class="text-[10px] text-neutral-400">যেকোনো প্রয়োজনে</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- =================================================================== -->
        <!-- ULTRA-PREMIUM APPLE FLOATING CAPSULE BAR (MOBILE ONLY)              -->
        <!-- =================================================================== -->
        <div class="md:hidden fixed bottom-[78px] left-3.5 right-3.5 z-40">
            <div class="bg-white/90 backdrop-blur-2xl border border-white/60 shadow-[0_12px_36px_rgba(0,0,0,0.18)] rounded-full px-4 py-2.5 flex items-center justify-between gap-3">
                
                <!-- Price & Assurance Tag -->
                <div class="flex flex-col pl-1">
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#B5945A]"></span>
                        <span class="text-[9px] uppercase tracking-wider text-brandGrayText font-bold">মূল্য</span>
                    </div>
                    <div class="text-[17px] font-extrabold text-brandDark leading-tight tracking-tight">
                        <?php echo $price_html; ?>
                    </div>
                </div>

                <!-- Action Group -->
                <div class="flex items-center gap-2">
                    <?php if ($show_wa == '1') : ?>
                        <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" class="w-11 h-11 rounded-full bg-[#E8F8EE] text-[#1E7B44] border border-[#CDEED8] flex items-center justify-center hover:scale-105 active:scale-95 transition shadow-sm" aria-label="WhatsApp">
                            <svg class="w-5 h-5 text-[#25D366] fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.072-2.146-.531-1.859-.772-3.053-2.66-3.146-2.784-.093-.123-.746-.994-.746-1.895 0-.901.472-1.344.64-1.528.168-.184.367-.23.49-.23.123 0 .245.001.352.006.113.005.265-.043.414.316.153.368.523 1.277.569 1.37.046.093.076.2.015.323-.061.123-.092.2-.184.307-.092.108-.194.24-.277.323-.092.092-.188.192-.081.376.107.184.478.788 1.025 1.275.706.628 1.301.822 1.486.914.184.092.292.077.4-.046.108-.123.46-0.537.583-.721.123-.184.246-.153.414-.092.169.061 1.074.507 1.258.6.184.092.307.138.353.215.046.077.046.446-.098.851zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.301A9.957 9.957 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
                        </a>
                    <?php endif; ?>
                    <button type="button" onclick="prepareAndOpenModal()" class="h-11 px-6 bg-gradient-to-r from-[#111111] to-[#222222] text-white rounded-full text-xs font-bold hover:brightness-110 active:scale-95 transition shadow-lg flex items-center gap-2">
                        <i data-lucide="zap" class="w-4 h-4 text-[#B5945A] fill-[#B5945A]"></i>
                        <span><?php echo esc_html($quick_order_label); ?></span>
                    </button>
                </div>

            </div>
        </div>

        <!-- 1-Page Express Order Modal -->
        <div id="quickOrderModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-center justify-center p-4">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-brandBorder relative overflow-hidden max-h-[92vh] overflow-y-auto">
                
                <button type="button" onclick="closeQuickOrderModal()" class="absolute top-4 right-4 p-2 text-brandGrayText hover:text-brandDark">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>

                <div id="orderFormView">
                    <div class="mb-4">
                        <span class="text-xs font-bold text-brandGold uppercase tracking-wider block mb-0.5">সহজ ১-ক্লিক অর্ডার</span>
                        <h3 class="text-xl font-bold text-brandDark">আপনার ঠিকানা দিন</h3>
                        <p class="text-xs text-brandGrayText">পণ্য হাতে পেয়ে চেক করে টাকা দিন</p>
                    </div>

                    <div id="modalVariantNotice" class="hidden text-xs py-2 px-3 rounded-xl bg-neutral-100 text-brandDark font-medium mb-3"></div>

                    <form id="ukazQuickOrderForm" class="space-y-3">
                        <input type="hidden" name="product_id" value="<?php echo get_the_ID(); ?>">
                        <input type="hidden" name="variation_id" id="modalVariationId" value="0">
                        <input type="hidden" name="order_variants_note" id="modalVariantsNote" value="">
                        <input type="hidden" name="security" value="<?php echo wp_create_nonce('ukaz_order_nonce'); ?>">

                        <div>
                            <label class="block text-xs font-semibold text-brandDark mb-1">আপনার নাম *</label>
                            <input type="text" name="billing_name" required placeholder="যেমন: আয়েশা সিদ্দিকা" class="w-full px-3.5 py-2.5 rounded-xl border border-brandBorder text-sm focus:outline-none focus:border-brandDark">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-brandDark mb-1">মোবাইল নম্বর *</label>
                            <input type="tel" name="billing_phone" required placeholder="017XXXXXXXX" class="w-full px-3.5 py-2.5 rounded-xl border border-brandBorder text-sm focus:outline-none focus:border-brandDark">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-brandDark mb-1">ডেলিভারি এলাকা *</label>
                            <div class="grid grid-cols-2 gap-2 text-xs font-medium">
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-brandBorder cursor-pointer">
                                    <input type="radio" name="delivery_area" value="inside" checked class="accent-[#111111]">
                                    <span>ঢাকার ভিতরে (৳<?php echo esc_html($delivery_inside); ?>)</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-brandBorder cursor-pointer">
                                    <input type="radio" name="delivery_area" value="outside" class="accent-[#111111]">
                                    <span>ঢাকার বাইরে (৳<?php echo esc_html($delivery_outside); ?>)</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-brandDark mb-1">পূর্ণ ঠিকানা *</label>
                            <textarea name="billing_address" required rows="2" placeholder="বাড়ি নম্বর, রোড নম্বর, এলাকা বা থানার নাম লিখুন" class="w-full px-3.5 py-2 rounded-xl border border-brandBorder text-sm focus:outline-none focus:border-brandDark"></textarea>
                        </div>

                        <div id="orderStatusMsg" class="hidden text-xs py-2 px-3 rounded-lg"></div>

                        <button type="submit" id="submitOrderBtn" class="w-full py-3.5 bg-[#111111] text-white font-bold rounded-xl text-sm hover:bg-neutral-800 transition flex items-center justify-center gap-2">
                            <span>অর্ডার নিশ্চিত করুন</span>
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>

                <div id="orderSuccessView" class="hidden text-center py-6 space-y-4">
                    <div class="w-16 h-16 rounded-full bg-green-100 text-green-600 flex items-center justify-center mx-auto shadow-sm">
                        <i data-lucide="check-circle" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-brandDark">আলহামদুলিল্লাহ, আপনার অর্ডার সফল হয়েছে!</h3>
                        <p class="text-xs text-brandGrayText mt-1">অর্ডার নম্বর: <strong id="successOrderId" class="text-brandDark">#</strong></p>
                    </div>

                    <div class="bg-[#FBFBFD] p-4 rounded-2xl border border-brandBorder text-xs text-brandGrayText text-left space-y-1">
                        <p>• শীঘ্রই আমাদের সাপোর্ট টিম আপনার নম্বরে কল দিয়ে অর্ডারটি কনফার্ম করবে।</p>
                        <p>• পণ্য হাতে পেয়ে দেখে তারপর ডেলিভারি ম্যানের কাছে মূল্য পরিশোধ করুন।</p>
                    </div>

                    <div class="pt-2 space-y-2.5">
                        <a id="successWhatsAppBtn" href="#" target="_blank" class="w-full py-3.5 rounded-xl bg-[#25D366] text-white text-xs font-bold hover:bg-[#1EBE5D] transition flex items-center justify-center gap-2 shadow-md">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.694.072-2.146-.531-1.859-.772-3.053-2.66-3.146-2.784-.093-.123-.746-.994-.746-1.895 0-.901.472-1.344.64-1.528.168-.184.367-.23.49-.23.123 0 .245.001.352.006.113.005.265-.043.414.316.153.368.523 1.277.569 1.37.046.093.076.2.015.323-.061.123-.092.2-.184.307-.092.108-.194.24-.277.323-.092.092-.188.192-.081.376.107.184.478.788 1.025 1.275.706.628 1.301.822 1.486.914.184.092.292.077.4-.046.108-.123.46-0.537.583-.721.123-.184.246-.153.414-.092.169.061 1.074.507 1.258.6.184.092.307.138.353.215.046.077.046.446-.098.851zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.301A9.957 9.957 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
                            <span>হোয়াটসঅ্যাপে অর্ডার কনফার্মেশন মেসেজ দিন</span>
                        </a>
                        <button type="button" onclick="closeQuickOrderModal()" class="w-full py-3 rounded-xl bg-neutral-100 text-brandDark text-xs font-semibold hover:bg-neutral-200 transition">
                            উইন্ডো বন্ধ করুন
                        </button>
                    </div>
                </div>

            </div>
        </div>

    <?php endwhile; ?>
</div>

<script>
    function switchMainImage(imgUrl, buttonEl) {
        const mainImg = document.getElementById('mainProductImage');
        if (!mainImg) return;
        mainImg.style.opacity = '0.3';
        setTimeout(() => {
            mainImg.src = imgUrl;
            mainImg.style.opacity = '1';
        }, 150);

        document.querySelectorAll('.gallery-thumb-btn').forEach(btn => {
            btn.classList.remove('border-2', 'border-brandDark');
            btn.classList.add('border', 'border-brandBorder', 'opacity-70');
        });
        buttonEl.classList.remove('border', 'border-brandBorder', 'opacity-70');
        buttonEl.classList.add('border-2', 'border-brandDark');
    }

    function prepareAndOpenModal() {
        const formCart = document.querySelector('form.variations_form');
        const variantNotice = document.getElementById('modalVariantNotice');
        const modalVariationId = document.getElementById('modalVariationId');
        const modalVariantsNote = document.getElementById('modalVariantsNote');

        let selectedDetails = [];

        if (formCart) {
            const selects = formCart.querySelectorAll('select');
            selects.forEach(select => {
                const attrName = select.name.replace('attribute_', '');
                const attrVal = select.value;
                if (attrVal) {
                    selectedDetails.push(attrName + ': ' + attrVal);
                }
            });

            const variationInput = formCart.querySelector('input.variation_id');
            if (variationInput && variationInput.value && variationInput.value !== '0') {
                modalVariationId.value = variationInput.value;
            }
        }

        if (selectedDetails.length > 0) {
            modalVariantsNote.value = selectedDetails.join(', ');
            variantNotice.classList.remove('hidden');
            variantNotice.innerHTML = 'নির্বাচিত ভেরিয়েন্ট: <strong>' + selectedDetails.join(', ') + '</strong>';
        } else {
            modalVariantsNote.value = '';
            variantNotice.classList.add('hidden');
        }

        const modal = document.getElementById('quickOrderModal');
        if (modal) {
            document.getElementById('orderFormView').classList.remove('hidden');
            document.getElementById('orderSuccessView').classList.add('hidden');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeQuickOrderModal() {
        const modal = document.getElementById('quickOrderModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    const orderForm = document.getElementById('ukazQuickOrderForm');
    if (orderForm) {
        orderForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = document.getElementById('submitOrderBtn');
            const msgBox = document.getElementById('orderStatusMsg');
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'অর্ডার প্রসেস হচ্ছে...';

            const formData = new FormData(this);
            formData.append('action', 'ukaz_quick_order');

            fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('orderFormView').classList.add('hidden');
                    const successView = document.getElementById('orderSuccessView');
                    successView.classList.remove('hidden');
                    document.getElementById('successOrderId').textContent = '#' + data.data.order_id;
                    
                    const waNum = "<?php echo esc_attr($whatsapp_number); ?>";
                    const pTitle = "<?php echo esc_js($product_title); ?>";
                    const confirmMsg = encodeURIComponent("আসসালামু আলাইকুম, আমি UKAZ ওয়েবসাইট থেকে একটি অর্ডার করেছি।\nঅর্ডার আইডি: #" + data.data.order_id + "\nপণ্য: " + pTitle);
                    document.getElementById('successWhatsAppBtn').href = "https://api.whatsapp.com/send?phone=" + waNum + "&text=" + confirmMsg;

                    if (typeof lucide !== 'undefined') lucide.createIcons();
                    orderForm.reset();
                } else {
                    msgBox.classList.remove('hidden');
                    msgBox.className = 'text-xs py-2.5 px-3 rounded-lg bg-red-50 text-red-700 border border-red-200 font-semibold text-center block';
                    msgBox.innerHTML = data.data.message || 'একটি সমস্যা দেখা দিয়েছে। আবার চেষ্টা করুন।';
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'অর্ডার নিশ্চিত করুন';
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'অর্ডার নিশ্চিত করুন';
                msgBox.classList.remove('hidden');
                msgBox.className = 'text-xs py-2.5 px-3 rounded-lg bg-red-50 text-red-700 border border-red-200 block text-center';
                msgBox.innerHTML = 'সার্ভারে সংযোগ করা সম্ভব হয়নি।';
            });
        });
    }
</script>

<?php get_footer(); ?>
