<!-- Mobile Dock Navigation (Apple Style) -->
<div class="md:hidden fixed bottom-3 left-4 right-4 z-50 bg-white/90 backdrop-blur-xl border border-brandBorder/80 shadow-2xl rounded-2xl px-6 py-2.5 flex items-center justify-between">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex flex-col items-center gap-1 text-brandDark">
        <i data-lucide="home" class="w-5 h-5 text-brandDark"></i>
        <span class="text-[11px] font-semibold">হোম</span>
    </a>
    <a href="<?php echo esc_url(home_url('/#categories')); ?>" class="flex flex-col items-center gap-1 text-brandGrayText hover:text-brandDark">
        <i data-lucide="layout-grid" class="w-5 h-5"></i>
        <span class="text-[11px] font-medium">ক্যাটাগরি</span>
    </a>
    <button type="button" onclick="toggleCartDrawer(true)" class="flex flex-col items-center gap-1 text-brandGrayText hover:text-brandDark relative">
        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
        <span class="text-[11px] font-medium">ব্যাগ</span>
        <span class="absolute -top-1 right-1 bg-brandGold text-white text-[9px] w-3.5 h-3.5 rounded-full flex items-center justify-center font-bold">
            <?php echo ukaz_get_cart_count(); ?>
        </span>
    </button>
    <a href="<?php echo (function_exists('wc_get_page_id') && get_option('woocommerce_myaccount_page_id')) ? esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) : '#'; ?>" class="flex flex-col items-center gap-1 text-brandGrayText hover:text-brandDark">
        <i data-lucide="user" class="w-5 h-5"></i>
        <span class="text-[11px] font-medium">প্রোফাইল</span>
    </a>
</div>

<!-- Desktop Footer -->
<footer class="bg-white border-t border-brandBorder mt-20 pt-14 pb-12 px-4">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
        <div class="space-y-3 md:col-span-2">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-brandGold/10 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-brandGold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M4 21V10a8 8 0 0 1 16 0v11"/>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-widest text-brandDark">UKAZ</span>
            </div>
            <p class="text-sm text-brandGrayText max-w-sm leading-relaxed">
                UKAZ নিয়ে এসেছে পরিশীলিত পর্দা ও আধুনিক লাইফস্টাইলের সেরা সমন্বয়। প্রিমিয়াম ফেব্রিক এবং নিখুঁত ফিনিশিংয়ে তৈরি আমাদের প্রতিটি খিমার, আবায়া ও বোরখা কালেকশন।
            </p>
        </div>

        <div class="space-y-2">
            <h4 class="text-xs font-bold uppercase tracking-wider text-brandDark">ক্যাটাগরি</h4>
            <ul class="text-sm space-y-2 text-brandGrayText">
                <li><a href="#" class="hover:text-brandDark transition">প্রিমিয়াম খিমার</a></li>
                <li><a href="#" class="hover:text-brandDark transition">প্লাজু খিমার সেট</a></li>
                <li><a href="#" class="hover:text-brandDark transition">দুবাই চেরি বোরখা</a></li>
                <li><a href="#" class="hover:text-brandDark transition">প্রিমিয়াম হিজাব</a></li>
            </ul>
        </div>

        <div class="space-y-2">
            <h4 class="text-xs font-bold uppercase tracking-wider text-brandDark">কাস্টমার সাপোর্ট</h4>
            <ul class="text-sm space-y-2 text-brandGrayText">
                <li>ডেলিভারি এবং রিটার্ন পলিসি</li>
                <li>সাইজ গাইডলাইন</li>
                <li>অর্ডার ট্র্যাকিং</li>
            </ul>
        </div>
    </div>

    <div class="max-w-6xl mx-auto pt-6 border-t border-brandBorder flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-brandGrayText">
        <p>© <?php echo date('Y'); ?> UKAZ Lifestyle. সর্বস্বত্ব সংরক্ষিত।</p>
        <p class="text-[11px]">Designed with Apple Aesthetics & Pure Modesty</p>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

<?php wp_footer(); ?>
</body>
</html>
