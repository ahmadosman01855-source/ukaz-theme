<?php
/**
 * UKAZ Front Page
 * Version: 1.0.2
 */

get_header(); ?>

<main class="w-full">
    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-4 pt-4 md:pt-8">
        <div class="bg-gradient-to-b from-[#F2F2F7] to-white rounded-[32px] p-6 md:p-14 border border-brandBorder relative overflow-hidden shadow-sm flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="w-full md:w-1/2 space-y-5 text-center md:text-left z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white border border-brandBorder rounded-full shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-brandGold animate-pulse"></span>
                    <span class="text-xs font-semibold text-brandDark tracking-wide">নতুন সিজন কালেকশন ২০২৬</span>
                </div>

                <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-brandDark leading-[1.25]">
                    আপনার শালীনতায় <br class="hidden md:block"/>
                    <span class="text-brandGold">আভিজাত্যের</span> নিখুঁত ছোঁয়া।
                </h1>

                <p class="text-brandGrayText text-sm md:text-base leading-relaxed max-w-md mx-auto md:mx-0">
                    প্রিমিয়াম দুবাই চেরি ও সফট জর্জেটের অতুলনীয় ফিনিশিং। আধুনিক কাট এবং আরামদায়ক ফিটিংসে প্রতিদিনের পর্দা এখন আরও স্বস্তিদায়ক।
                </p>

                <div class="pt-3 flex flex-wrap items-center justify-center md:justify-start gap-3">
                    <a href="#featured" class="px-7 py-3.5 bg-brandDark text-white rounded-full text-sm font-semibold hover:bg-neutral-800 transition active:scale-95 shadow-md flex items-center gap-2">
                        <span>কালেকশন দেখুন</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <a href="#categories" class="px-6 py-3.5 bg-white text-brandDark border border-brandBorder rounded-full text-sm font-semibold hover:bg-neutral-50 transition active:scale-95 shadow-sm">
                        ক্যাটাগরি সমূহ
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center relative">
                <div class="relative w-72 h-96 md:w-80 md:h-[440px] rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-neutral-100">
                    <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&q=80&w=900" alt="UKAZ Khimar" class="w-full h-full object-cover object-center">
                    <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-md p-3.5 rounded-2xl border border-white/40 shadow-lg flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold text-brandGold uppercase block">প্রিমিয়াম চয়েস</span>
                            <span class="text-xs font-bold text-brandDark block">ক্লাসিক দুবাই খিমার</span>
                        </div>
                        <span class="text-xs font-bold bg-brandDark text-white px-2.5 py-1 rounded-full">৳ ১,৮৫০</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section id="categories" class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-bold uppercase tracking-wider text-brandDark">ক্যাটাগরি অনুযায়ী খুঁজুন</h2>
            <span class="text-xs text-brandGrayText">হালকা সোয়াইপ করুন →</span>
        </div>
        <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-none">
            <a href="#featured" class="px-5 py-2.5 rounded-full text-xs font-semibold bg-brandDark text-white shadow-sm whitespace-nowrap active:scale-95 transition">সবগুলো পোশাক</a>
            <a href="#featured" class="px-5 py-2.5 rounded-full text-xs font-semibold bg-white text-brandDark border border-brandBorder shadow-sm whitespace-nowrap hover:border-brandGold active:scale-95 transition">খিমার কালেকশন</a>
            <a href="#featured" class="px-5 py-2.5 rounded-full text-xs font-semibold bg-white text-brandDark border border-brandBorder shadow-sm whitespace-nowrap hover:border-brandGold active:scale-95 transition">প্লাজু খিমার সেট</a>
            <a href="#featured" class="px-5 py-2.5 rounded-full text-xs font-semibold bg-white text-brandDark border border-brandBorder shadow-sm whitespace-nowrap hover:border-brandGold active:scale-95 transition">প্রিমিয়াম বোরখা</a>
            <a href="#featured" class="px-5 py-2.5 rounded-full text-xs font-semibold bg-white text-brandDark border border-brandBorder shadow-sm whitespace-nowrap hover:border-brandGold active:scale-95 transition">ডিজাইনার হিজাব</a>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="max-w-6xl mx-auto px-4 py-6">
        <div class="flex items-end justify-between mb-6">
            <div>
                <span class="text-xs font-bold text-brandGold uppercase tracking-wider block mb-1">UKAZ সিলেকশন</span>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-brandDark">জনপ্রিয় কালেকশন</h2>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6">
            <?php
            $has_wc = function_exists('wc_get_product');
            $products_found = false;

            if ($has_wc) {
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 8,
                    'status'         => 'publish'
                );
                $loop = new WP_Query($args);

                if ($loop->have_posts()) {
                    $products_found = true;
                    while ($loop->have_posts()) {
                        $loop->the_post();
                        $product = wc_get_product(get_the_ID());
                        if (!$product) continue;
            ?>
                <div class="bg-white rounded-3xl p-3 md:p-3.5 border border-brandBorder flex flex-col justify-between hover:shadow-xl hover:border-brandGold/40 transition-all duration-300 group">
                    <div>
                        <a href="<?php the_permalink(); ?>" class="block rounded-2xl overflow-hidden bg-neutral-100 relative aspect-[3/4] mb-3">
                            <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500'));
                            } else {
                                echo '<img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Placeholder">';
                            }
                            ?>
                        </a>
                        <h3 class="font-bold text-xs md:text-sm text-brandDark line-clamp-1 group-hover:text-brandGold transition">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="text-[11px] text-brandGrayText mt-0.5">প্রিমিয়াম চেরি ফেব্রিক</p>
                    </div>
                    <div class="mt-4 pt-2 border-t border-neutral-100 flex items-center justify-between">
                        <div class="text-brandDark font-bold text-xs md:text-sm">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="w-8 h-8 rounded-full bg-brandDark text-white flex items-center justify-center hover:bg-brandGold transition active:scale-90" aria-label="Order Now">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            <?php 
                    }
                    wp_reset_postdata();
                }
            }

            if (!$products_found):
                for ($i = 1; $i <= 4; $i++):
            ?>
                <div class="bg-white rounded-3xl p-3 md:p-3.5 border border-brandBorder flex flex-col justify-between hover:shadow-xl transition-all duration-300">
                    <div>
                        <div class="rounded-2xl overflow-hidden bg-neutral-100 relative aspect-[3/4] mb-3">
                            <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover" alt="Khimar Sample">
                            <span class="absolute top-2.5 left-2.5 bg-white/90 backdrop-blur-md text-[10px] font-bold px-2 py-0.5 rounded-full text-brandDark">
                                ডেমো স্যাম্পল
                            </span>
                        </div>
                        <h3 class="font-bold text-xs md:text-sm text-brandDark line-clamp-1">
                            লং ফ্লেয়ার দুবাই খিমার <?php echo $i; ?>
                        </h3>
                        <p class="text-[11px] text-brandGrayText mt-0.5">আরামদায়ক ও নন-ট্রান্সপারেন্ট</p>
                    </div>
                    <div class="mt-4 pt-2 border-t border-neutral-100 flex items-center justify-between">
                        <div class="text-brandDark font-bold text-xs md:text-sm">৳ ১,৪৫০</div>
                        <button class="w-8 h-8 rounded-full bg-brandDark text-white flex items-center justify-center hover:bg-brandGold transition">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            <?php 
                endfor;
            endif; 
            ?>
        </div>
    </section>

    <!-- Trust Badges -->
    <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white rounded-[28px] border border-brandBorder p-6 md:p-10 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-brandGold/10 text-brandGold flex items-center justify-center shrink-0">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm md:text-base text-brandDark">সেরা মানের ফেব্রিক নিশ্চয়তা</h3>
                        <p class="text-xs text-brandGrayText mt-1">১০০% অরিজিনাল দুবাই চেরি ও প্রিমিয়াম জর্জেট ফেব্রিক।</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-brandGold/10 text-brandGold flex items-center justify-center shrink-0">
                        <i data-lucide="truck" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm md:text-base text-brandDark">সারাদেশে হোম ডেলিভারি</h3>
                        <p class="text-xs text-brandGrayText mt-1">ঢাকার ভেতর ১-২ দিন এবং ঢাকার বাইরে ৩-৫ দিনে নিরাপদ ডেলিভারি।</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-brandGold/10 text-brandGold flex items-center justify-center shrink-0">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm md:text-base text-brandDark">সহজ রিটার্ন ও এক্সচেঞ্জ</h3>
                        <p class="text-xs text-brandGrayText mt-1">ডেলিভারির সময় দেখে নেওয়ার ও সাইজ অমিল হলে এক্সচেঞ্জের সুযোগ।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
