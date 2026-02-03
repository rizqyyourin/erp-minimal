<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- SEO Meta Tags -->
    <title>Minimal ERP</title>
    <meta name="description" content="Minimal ERP is the best ERP software in Indonesia for SMEs. Manage stock, sales, purchases, invoices, and finance in one platform. 14-day free trial.">
    <meta name="keywords" content="ERP software Indonesia, SME ERP, inventory app, accounting software, sales management, online invoice, inventory system, business management software, POS app, online ERP">
    <meta name="author" content="Minimal ERP">
    <meta name="robots" content="index, follow">
    <meta name="language" content="en">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://minimal-erp.app/">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://minimal-erp.app/">
    <meta property="og:title" content="Minimal ERP - ERP Software for SMEs in Indonesia">
    <meta property="og:description" content="Complete ERP solution for SMEs in Indonesia. Manage stock, sales, invoices, and finance in one modern platform.">
    <meta property="og:image" content="https://minimal-erp.app/images/og-image.jpg">
    <meta property="og:locale" content="en_US">
    <meta property="og:site_name" content="Minimal ERP">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://minimal-erp.app/">
    <meta name="twitter:title" content="Minimal ERP - ERP Software for SMEs in Indonesia">
    <meta name="twitter:description" content="Complete ERP solution for SMEs in Indonesia. Manage stock, sales, invoices, and finance in one modern platform.">
    <meta name="twitter:image" content="https://minimal-erp.app/images/twitter-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    
    <!-- Fonts -->
    <!-- Fonts -->
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.7/cdn.min.js"></script>
    
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
@verbatim
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
        "name": "Minimal ERP",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Web",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "IDR",
            "availability": "https://schema.org/InStock"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "ratingCount": "500"
        },
        "description": "ERP Software for SMEs in Indonesia. Manage stock, sales, invoices, and finance in one modern platform.",
        "softwareVersion": "2.0",
        "author": {
            "@type": "Organization",
            "name": "Minimal ERP"
        }
    }
@endverbatim
    </script>
    
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
@verbatim
{
    "@context": "https://schema.org",
    "@type": "Organization",
        "name": "Minimal ERP",
        "url": "https://minimal-erp.app",
        "logo": "https://minimal-erp.app/images/logo.png",
        "description": "Best ERP software in Indonesia for SMEs and medium-sized businesses.",
        "foundingDate": "2024",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer support",
            "availableLanguage": "English, Indonesian"
        },
        "sameAs": [
            "https://facebook.com/minimalerp",
            "https://instagram.com/minimalerp",
            "https://linkedin.com/company/minimalerp"
        ]
    }
@endverbatim
    </script>
    
    <!-- Styles -->
    @verbatim
    <style>
        [x-cloak] { display: none !important; }
        
        .floating-element {
            animation: floating 3s ease-in-out infinite;
        }
        
        .floating-element-delayed {
            animation: floating 3s ease-in-out 1.5s infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .blob {
            animation: blob-bounce 5s infinite;
        }
        
        @keyframes blob-bounce {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        .popular-tag {
            position: absolute;
            top: 20px;
            right: -35px;
            background: linear-gradient(135deg, #1e293b, #475569);
            color: white;
            padding: 5px 40px;
            font-size: 12px;
            font-weight: 700;
            transform: rotate(45deg);
        }
        
        .accordion-content {
            transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
        
        .nav-scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .review-scroll {
            position: relative;
        }
        
        .review-scroll-inner {
            display: flex;
            flex-direction: column;
            animation: scrollText 15s linear infinite;
        }
        
        .review-scroll:hover .review-scroll-inner {
            animation-play-state: paused;
        }

        @keyframes scrollText {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }

        .testimonial-wrapper {
            position: relative;
            overflow: hidden;
            padding: 20px 0;
        }
        
        .testimonial-scroll {
            overflow: visible;
        }
        
        .testimonial-track {
            animation: scrollCards 40s linear infinite;
            display: flex;
            gap: 24px;
        }

        .testimonial-scroll:hover .testimonial-track {
            animation-play-state: paused;
        }

        .testimonial-card {
            flex-shrink: 0;
            width: 380px;
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px -10px rgba(0,0,0,0.15);
        }

        @keyframes scrollCards {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
    @endverbatim
</head>
<body class="font-sans text-slate-800 antialiased" x-data="landingApp()">
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" :class="{ 'nav-scrolled': scrolled }" x-on:scroll.window="scrolled = window.pageYOffset > 50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <a href="#" class="flex items-center gap-3">
                    <img src="https://img.freepik.com/vektor-premium/logo-erp-huruf-erp-desain-logo-huruf-erp-inisial-logo-erp-terhubung-dengan-lingkaran-dan-logo-monogram-huruf-besar-tipografi-erp-untuk-bisnis-teknologi-dan-merek-real-estat_229120-74568.jpg" alt="Logo" class="h-10 w-10 rounded-xl object-cover">
                    <span class="text-xl font-bold text-slate-900">Minimal ERP</span>
                </a>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">How It Works</a>
                    <a href="#testimonials" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Testimonials</a>
                    <a href="#pricing" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">Pricing</a>
                    <a href="#faq" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">FAQ</a>
                </div>
                
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-800 transition-all">
                        Try for Free
                    </a>
                </div>
                
                <button class="md:hidden p-2" x-on:click="mobileMenuOpen = !mobileMenuOpen">
                    <i class="ph ph-list text-2xl text-slate-700"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-white border-t border-slate-100" x-on:click.away="mobileMenuOpen = false">
            <div class="px-4 py-4 space-y-3">
                <a href="#features" class="block py-2 text-slate-600 font-medium" x-on:click="mobileMenuOpen = false">Features</a>
                <a href="#how-it-works" class="block py-2 text-slate-600 font-medium" x-on:click="mobileMenuOpen = false">How It Works</a>
                <a href="#testimonials" class="block py-2 text-slate-600 font-medium" x-on:click="mobileMenuOpen = false">Testimonials</a>
                <a href="#pricing" class="block py-2 text-slate-600 font-medium" x-on:click="mobileMenuOpen = false">Pricing</a>
                <a href="#faq" class="block py-2 text-slate-600 font-medium" x-on:click="mobileMenuOpen = false">FAQ</a>
                <div class="pt-3 border-t border-slate-100 space-y-2">
                    <a href="{{ route('login') }}" class="block py-2 text-center text-slate-600 font-semibold">Login</a>
                    <a href="{{ route('register') }}" class="block py-2 text-center bg-slate-900 text-white rounded-full font-semibold">Try for Free</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="hero-gradient pt-32 pb-20 lg:pt-40 lg:pb-32 relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-slate-200/30 rounded-full blur-3xl floating-element"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-slate-100/30 rounded-full blur-3xl floating-element-delayed"></div>
        <div class="absolute top-40 left-1/4 w-20 h-20 bg-slate-400/20 rounded-2xl blob floating-element"></div>
        <div class="absolute bottom-40 right-1/4 w-16 h-16 bg-slate-300/20 rounded-full floating-element-delayed"></div>
        
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up" data-aos-duration="1000">
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 mb-6">
                    <span class="gradient-text">Best</span> ERP Software<br>for SMEs in Indonesia
                </h1>
                
                <p class="mx-auto max-w-2xl text-lg sm:text-xl text-slate-600 mb-10">
                    Manage stock, sales, purchases, invoices, and finance in one modern platform. 
                    A complete solution for your business.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}" class="group relative inline-flex items-center gap-2 rounded-full bg-slate-900 px-8 py-4 text-lg font-semibold text-white hover:bg-slate-800 transition-all overflow-hidden border border-slate-700">
                        <span class="relative z-10">Start 14-Day Free Trial</span>
                        <i class="ph ph-arrow-right text-xl relative z-10 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#demo" class="inline-flex items-center gap-2 rounded-full border-2 border-slate-200 bg-white px-8 py-4 text-lg font-semibold text-slate-700 hover:border-slate-300 hover:bg-slate-50 transition-all">
                        <i class="ph ph-play-circle text-2xl text-slate-900"></i>
                        <span>View Demo</span>
                    </a>
                </div>
                
                <p class="mt-4 text-sm text-slate-500">No credit card required • Setup in 5 minutes</p>
            </div>
            
            <!-- Dashboard Preview -->
            <div class="mt-16 lg:mt-20" data-aos="fade-up" data-aos-delay="200">
                <div class="relative mx-auto max-w-5xl">
                    <div class="absolute -inset-1 bg-gradient-to-r from-slate-200 to-slate-300 rounded-2xl blur opacity-30"></div>
                    <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-200">
                        <div class="bg-slate-100 px-4 py-3 flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            <div class="ml-4 px-3 py-1 bg-white rounded-md text-xs text-slate-500 flex-1 text-center">app.minimal-erp.app</div>
                        </div>
                        <div class="p-6 bg-white">
                            <div class="grid grid-cols-4 gap-4 mb-6">
                                <div class="col-span-1 bg-slate-50 rounded-xl p-4">
                                    <div class="w-8 h-8 bg-slate-100 rounded-lg mb-3 flex items-center justify-center">
                                        <i class="ph ph-chart-bar text-slate-700 text-lg"></i>
                                    </div>
                                    <div class="text-sm text-slate-500">Sales</div>
                                    <div class="text-xl font-bold text-slate-900">Rp 45.2M</div>
                                </div>
                                <div class="col-span-1 bg-slate-50 rounded-xl p-4">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg mb-3 flex items-center justify-center">
                                        <i class="ph ph-trend-up text-green-600 text-lg"></i>
                                    </div>
                                    <div class="text-sm text-slate-500">Profit</div>
                                    <div class="text-xl font-bold text-slate-900">Rp 12.8jt</div>
                                </div>
                                <div class="col-span-1 bg-slate-50 rounded-xl p-4">
                                    <div class="w-8 h-8 bg-orange-100 rounded-lg mb-3 flex items-center justify-center">
                                        <i class="ph ph-package text-orange-600 text-lg"></i>
                                    </div>
                                    <div class="text-sm text-slate-500">Stock Items</div>
                                    <div class="text-xl font-bold text-slate-900">1,247</div>
                                </div>
                                <div class="col-span-1 bg-slate-50 rounded-xl p-4">
                                    <div class="w-8 h-8 bg-slate-100 rounded-lg mb-3 flex items-center justify-center">
                                        <i class="ph ph-users text-blue-600 text-lg"></i>
                                    </div>
                                    <div class="text-sm text-slate-500">Customers</div>
                                    <div class="text-xl font-bold text-slate-900">328</div>
                                </div>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 h-32 flex items-end justify-around">
                                <div class="w-8 bg-slate-800 rounded-t" style="height: 40%"></div>
                                <div class="w-8 bg-slate-800 rounded-t" style="height: 65%"></div>
                                <div class="w-8 bg-slate-800 rounded-t" style="height: 45%"></div>
                                <div class="w-8 bg-slate-800 rounded-t" style="height: 80%"></div>
                                <div class="w-8 bg-slate-800 rounded-t" style="height: 55%"></div>
                                <div class="w-8 bg-slate-500 rounded-t" style="height: 70%"></div>
                                <div class="w-8 bg-slate-500 rounded-t" style="height: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div id="stats-section" class="grid grid-cols-2 lg:grid-cols-4 gap-8" data-aos="fade-up">
                <div class="text-center">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-900 mb-4 transition-transform hover:scale-110">
                        <i class="ph-fill ph-storefront text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-slate-900 leading-tight" x-text="animatedStats.businesses">0</div>
                    <div class="text-slate-600 mt-2 font-medium text-sm lg:text-base">Active Businesses</div>
                </div>
                <div class="text-center">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-900 mb-4 transition-transform hover:scale-110">
                        <i class="ph-fill ph-file-text text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-slate-900 leading-tight" x-text="animatedStats.invoices">0</div>
                    <div class="text-slate-600 mt-2 font-medium text-sm lg:text-base">Invoices Created</div>
                </div>
                <div class="text-center">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-900 mb-4 transition-transform hover:scale-110">
                        <i class="ph-fill ph-lightning text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-slate-900 leading-tight" x-text="animatedStats.transactions">0</div>
                    <div class="text-slate-600 mt-2 font-medium text-sm lg:text-base">Transactions/Month</div>
                </div>
                <div class="text-center">
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-900 mb-4 transition-transform hover:scale-110">
                        <i class="ph-fill ph-shield-check text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold text-slate-900 leading-tight" x-text="animatedStats.uptime">0%</div>
                    <div class="text-slate-600 mt-2 font-medium text-sm lg:text-base">Uptime</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section id="features" class="py-20 bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block rounded-full bg-slate-900 px-4 py-1 text-sm font-semibold text-white mb-4">Complete Features</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Everything You Need</h2>
                <p class="max-w-2xl mx-auto text-lg text-slate-600">From stock management to financial reporting, everything is available in one platform.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 auto-rows-[280px]">
                <!-- Item 1: Stock Management (Wide - 2 columns) -->
                <div class="group relative lg:col-span-2 bg-white rounded-3xl p-10 border border-slate-100 shadow-sm overflow-hidden hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500" data-aos="fade-up">
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-slate-900 group-hover:text-white transition-all duration-500 group-hover:scale-110 group-hover:rotate-3">
                                <i class="ph ph-package text-3xl"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-900 mb-4 tracking-tight">Stock Management</h3>
                            <p class="text-slate-600 text-lg max-w-md leading-relaxed">Monitor stock real-time, set minimum stock levels, and get notified when stock is low.</p>
                        </div>
                        <div class="flex gap-3 mt-6 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 delay-100">
                            <span class="px-4 py-1.5 bg-slate-100 rounded-full text-xs font-bold text-slate-600 uppercase tracking-wider">Real-time Sync</span>
                            <span class="px-4 py-1.5 bg-slate-100 rounded-full text-xs font-bold text-slate-600 uppercase tracking-wider">Low Stock Alert</span>
                        </div>
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-slate-50 rounded-full opacity-50 group-hover:scale-125 transition-transform duration-1000"></div>
                </div>

                <!-- Item 2: Digital Invoices (Standard - 1 column) -->
                <div class="group relative lg:col-span-1 bg-white rounded-3xl p-10 border border-slate-100 shadow-sm overflow-hidden hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative z-10 h-full flex flex-col">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-slate-900 group-hover:text-white transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                            <i class="ph ph-currency-circle-dollar text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Digital Invoices</h3>
                        <p class="text-slate-600 leading-relaxed">Create professional invoices in seconds.</p>

                    </div>
                </div>

                <!-- Item 3: CRM System (Standard - 1 column) -->
                <div class="group relative lg:col-span-1 bg-white rounded-3xl p-10 border border-slate-100 shadow-sm overflow-hidden hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative z-10 h-full flex flex-col">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-slate-900 group-hover:text-white transition-all duration-500 group-hover:scale-110">
                            <i class="ph ph-users-three text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4 tracking-tight">CRM System</h3>
                        <p class="text-slate-600 leading-relaxed">Complete customer database & history.</p>

                    </div>
                </div>

                <!-- Item 4: Financial Reports (Wide - 2 columns) -->
                <div class="group relative lg:col-span-2 bg-slate-900 rounded-3xl p-10 shadow-2xl overflow-hidden hover:bg-slate-950 transition-all duration-500" data-aos="fade-up" data-aos-delay="300">
                    <!-- Glow effect -->
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/5 rounded-full blur-3xl group-hover:bg-white/10 transition-colors duration-700"></div>
                    
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div class="max-w-xs">
                                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-6 text-white group-hover:scale-110 transition-transform duration-500 border border-white/20">
                                    <i class="ph ph-chart-line-up text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-4">Financial Reports</h3>
                                <p class="text-slate-400 leading-relaxed">Profit/loss & cash flow with one click.</p>
                            </div>
                            <div class="hidden sm:block space-y-4 w-48 mt-4">
                                <div class="space-y-2">
                                    <div class="flex justify-between text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                        <span>Revenue</span>
                                        <span class="text-white">+85%</span>
                                    </div>
                                    <div class="h-1 w-full bg-white/5 rounded-full overflow-hidden">
                                        <div class="h-full bg-white rounded-full w-[85%] transition-all duration-1000 group-hover:w-[95%]"></div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                        <span>Growth</span>
                                        <span class="text-white">92%</span>
                                    </div>
                                    <div class="h-1 w-full bg-white/5 rounded-full overflow-hidden">
                                        <div class="h-full bg-slate-500 rounded-full w-[92%]"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 5: Role-Based Access (Wide - 2 columns) -->
                <div class="group relative lg:col-span-2 bg-white rounded-3xl p-10 border border-slate-100 shadow-sm overflow-hidden hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative z-10 flex items-center h-full gap-12">
                        <div class="flex-1">
                            <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-slate-900 group-hover:text-white transition-all duration-500 group-hover:scale-110">
                                <i class="ph ph-users-four text-3xl"></i>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-900 mb-4 tracking-tight">Role-Based Access</h3>
                            <p class="text-slate-600 text-lg max-w-sm leading-relaxed">Control team access with customizable permission levels.</p>
                        </div>
                        <div class="hidden lg:flex w-32 h-32 bg-slate-50 rounded-[40px] items-center justify-center relative">
                            <div class="absolute inset-0 bg-slate-100 rounded-[40px] scale-90 group-hover:scale-100 transition-transform duration-500"></div>
                            <i class="ph ph-shield-check text-5xl text-slate-400 group-hover:text-slate-900 transition-all duration-500 relative z-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- How It Works -->
    <section id="how-it-works" class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block rounded-full bg-slate-900 px-4 py-1 text-sm font-semibold text-white mb-4">How It Works</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Start in 3 Steps</h2>
                <p class="max-w-2xl mx-auto text-lg text-slate-600">Quick and easy setup. No long training required.</p>
            </div>
            
            <div class="relative">
                <!-- Connector Line -->
                <div class="hidden lg:block absolute top-[45px] left-0 right-0 h-0.5 bg-slate-100 relative z-0"></div>
                
                <div class="grid md:grid-cols-3 gap-8 lg:gap-12 relative z-10">
                    <!-- Step 1 -->
                    <div class="group h-full" data-aos="fade-up" data-aos-delay="0">
                        <div class="bg-white rounded-3xl p-10 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 text-center h-full flex flex-col items-center">
                            <div class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center mb-8 text-white text-2xl font-bold shadow-xl shadow-slate-900/20 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">1</div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Register Account</h3>
                            <p class="text-slate-600 leading-relaxed">Fill out the registration form with your business data. Process only takes 2 minutes.</p>
                        </div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="group h-full" data-aos="fade-up" data-aos-delay="150">
                        <div class="bg-white rounded-3xl p-10 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 text-center h-full flex flex-col items-center">
                            <div class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center mb-8 text-white text-2xl font-bold shadow-xl shadow-slate-900/20 group-hover:scale-110 group-hover:-rotate-3 transition-all duration-500">2</div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Import Data</h3>
                            <p class="text-slate-600 leading-relaxed">Easily upload product, customer, and supplier data via Excel or manual input.</p>
                        </div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="group h-full" data-aos="fade-up" data-aos-delay="300">
                        <div class="bg-white rounded-3xl p-10 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 text-center h-full flex flex-col items-center">
                            <div class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center mb-8 text-white text-2xl font-bold shadow-xl shadow-slate-900/20 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">3</div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">Start Operations</h3>
                            <p class="text-slate-600 leading-relaxed">System is ready to use! Create your first invoice and monitor your business in real-time.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
    <section id="testimonials" class="py-20 bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block rounded-full bg-slate-900 px-4 py-1 text-sm font-semibold text-white mb-4">Testimonials</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">What Do They Say?</h2>
                <p class="max-w-2xl mx-auto text-lg text-slate-600">Businesses from various industries have felt the benefits of Minimal ERP.</p>
            </div>
            
            <div class="testimonial-wrapper">
                <div class="testimonial-scroll flex gap-6">
                    <div class="flex gap-6 testimonial-track">
                        <!-- Card 1 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"Minimal ERP has been very helpful in managing our 3 retail stores. Stock is synchronized in real-time, and invoices are generated quickly. The support team is also responsive!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">AD</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Andi Darmawan</div>
                                    <div class="text-sm text-slate-500">Owner, Jaya Electronics Store</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"As a food distributor, we need strict stock control. Minimal ERP makes it easy to track batches and product expiration dates. Highly recommended!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">SR</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Siti Rahayu</div>
                                    <div class="text-sm text-slate-500">Director, Healthy Food Co.</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"From manual to automatic! Financial reports that used to take 3 days now take just one click. Saves time and operational costs."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">BW</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Budi Wijaya</div>
                                    <div class="text-sm text-slate-500">CEO, Fashion Indonesia</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"The best investment for our business. Customer management and invoicing have never been easier. Highly recommended for SMEs!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">DP</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Dewi Putri</div>
                                    <div class="text-sm text-slate-500">Manager, Toko Buku Maju</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 5 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"Finally, an ERP system that's easy to use and affordable. Our team learned it in just 2 days. Amazing experience!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">RK</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Rudi Kurniawan</div>
                                    <div class="text-sm text-slate-500">Founder, Grosir Surabaya</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 6 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"Multi-branch management is now a breeze. Sales data from all stores is consolidated in real-time. Very satisfied!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">ML</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Maya Lestari</div>
                                    <div class="text-sm text-slate-500">Director, Ayam Goreng SR</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 7 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"Customer support is top-notch. Whenever we have questions, they respond quickly and helpfully. Great service!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">TN</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Toni Nugroho</div>
                                    <div class="text-sm text-slate-500">Owner, Elektro Solution</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 8 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"We increased our productivity by 40% after switching to Minimal ERP. The inventory tracking feature is a game changer!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">HS</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Hendra Setiawan</div>
                                    <div class="text-sm text-slate-500">Manager, Mandiri Jaya</div>
                                </div>
                            </div>
                        </div>
                        <!-- Duplicate Cards for Infinite Scroll -->
                        <!-- Card 1 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"Minimal ERP has been very helpful in managing our 3 retail stores. Stock is synchronized in real-time, and invoices are generated quickly. The support team is also responsive!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">AD</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Andi Darmawan</div>
                                    <div class="text-sm text-slate-500">Owner, Jaya Electronics Store</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"As a food distributor, we need strict stock control. Minimal ERP makes it easy to track batches and product expiration dates. Highly recommended!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">SR</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Siti Rahayu</div>
                                    <div class="text-sm text-slate-500">Director, Healthy Food Co.</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"From manual to automatic! Financial reports that used to take 3 days now take just one click. Saves time and operational costs."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">BW</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Budi Wijaya</div>
                                    <div class="text-sm text-slate-500">CEO, Fashion Indonesia</div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 4 -->
                        <div class="testimonial-card flex-shrink-0 w-96 bg-white rounded-2xl p-8 shadow-lg">
                            <div class="flex items-center gap-1 mb-4">
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                                <i class="ph-fill ph-star text-yellow-400 text-xl"></i>
                            </div>
                            <p class="text-slate-700 mb-6">"The best investment for our business. Customer management and invoicing have never been easier. Highly recommended for SMEs!"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span class="text-slate-700 font-bold">DP</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">Dewi Putri</div>
                                    <div class="text-sm text-slate-500">Manager, Toko Buku Maju</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Pricing -->
    <section id="pricing" class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block rounded-full bg-slate-900 px-4 py-1 text-sm font-semibold text-white mb-4">Pricing</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Choose the Right Plan for You</h2>
                <p class="max-w-2xl mx-auto text-lg text-slate-600">All plans include 24/7 support and free feature updates.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Starter -->
                <div class="bg-white rounded-2xl p-8 border-2 border-slate-100" data-aos="fade-up" data-aos-delay="0">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Starter</h3>
                    <p class="text-slate-500 mb-6">Best for new businesses</p>
                    <div class="mb-6">
                        <span class="text-4xl font-extrabold text-slate-900">Rp 0</span>
                        <span class="text-slate-500">/month</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-green-500 text-xl"></i>
                            <span class="text-slate-600">Max 100 products</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-green-500 text-xl"></i>
                            <span class="text-slate-600">1 user</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-green-500 text-xl"></i>
                            <span class="text-slate-600">Invoices & stock</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-green-500 text-xl"></i>
                            <span class="text-slate-600">Basic reports</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full text-center py-3 rounded-full border-2 border-slate-200 font-semibold text-slate-700 hover:border-primary-500 hover:text-primary-600 transition-colors">
                        Start for Free
                    </a>
                </div>
                
                <!-- Business (Popular) -->
                <div class="pricing-popular bg-slate-900 rounded-2xl p-8 text-white" data-aos="fade-up" data-aos-delay="150">
                    <h3 class="text-xl font-bold mb-2">Business</h3>
                    <p class="text-white/80 mb-6">Most popular for SMEs</p>
                    <div class="mb-6">
                        <span class="text-4xl font-extrabold">Rp 299k</span>
                        <span class="text-white/80">/month</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-white text-xl"></i>
                            <span class="text-white/90">Unlimited products</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-white text-xl"></i>
                            <span class="text-white/90">5 users</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-white text-xl"></i>
                            <span class="text-white/90">Multi-branch</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-white text-xl"></i>
                            <span class="text-white/90">Full reports</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-white text-xl"></i>
                            <span class="text-white/90">Support priority</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full text-center py-3 rounded-full bg-white font-semibold text-slate-900 hover:bg-slate-50 transition-colors">
                        Select Plan
                    </a>
                </div>
                
                <!-- Enterprise -->
                <div class="bg-white rounded-2xl p-8 border-2 border-slate-100" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Enterprise</h3>
                    <p class="text-slate-500 mb-6">For large businesses</p>
                    <div class="mb-6">
                        <span class="text-4xl font-extrabold text-slate-900">Custom</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-green-500 text-xl"></i>
                            <span class="text-slate-600">Unlimited users</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-green-500 text-xl"></i>
                            <span class="text-slate-600">API access</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-green-500 text-xl"></i>
                            <span class="text-slate-600">Custom integrations</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph-fill ph-check-circle text-green-500 text-xl"></i>
                            <span class="text-slate-600">Dedicated support</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full text-center py-3 rounded-full border-2 border-slate-200 font-semibold text-slate-700 hover:border-slate-900 hover:text-slate-900 transition-colors">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-slate-50">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block rounded-full bg-slate-900 px-4 py-1 text-sm font-semibold text-white mb-4">FAQ</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-slate-600">Find answers to common questions about Minimal ERP.</p>
            </div>
            
            <div class="space-y-4" x-data="{ active: 0 }">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden" data-aos="fade-up" data-aos-delay="0">
                    <button x-on:click="active = active === 0 ? null : 0" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-slate-900 pr-4">What is Minimal ERP?</span>
                        <i class="ph ph-caret-down text-slate-500 text-xl transition-transform" :class="{ 'rotate-180': active === 0 }"></i>
                    </button>
                    <div x-show="active === 0" x-collapse class="px-6 pb-6">
                        <p class="text-slate-600">Minimal ERP is a cloud-based business management software specifically designed for SMEs in Indonesia. The platform integrates stock management, sales, purchases, invoices, and accounting into one easy-to-use system.</p>
                    </div>
                </div>
                
                <!-- FAQ 2 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <button x-on:click="active = active === 1 ? null : 1" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-slate-900 pr-4">Is there a free version?</span>
                        <i class="ph ph-caret-down text-slate-500 text-xl transition-transform" :class="{ 'rotate-180': active === 1 }"></i>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-6 pb-6">
                        <p class="text-slate-600">Yes! We provide a Starter plan that is completely free forever. This plan is suitable for new businesses with a maximum of 100 products and 1 user. No hidden fees or trial expiration.</p>
                    </div>
                </div>
                
                <!-- FAQ 3 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <button x-on:click="active = active === 2 ? null : 2" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-slate-900 pr-4">How do I migrate data from an old system?</span>
                        <i class="ph ph-caret-down text-slate-500 text-xl transition-transform" :class="{ 'rotate-180': active === 2 }"></i>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-6 pb-6">
                        <p class="text-slate-600">We provide an easy-to-use Excel template. You simply fill in product, customer, and supplier data into the template and upload it to the system. The import process only takes a few minutes.</p>
                    </div>
                </div>
                
                <!-- FAQ 4 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <button x-on:click="active = active === 3 ? null : 3" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-slate-900 pr-4">What reports are available?</span>
                        <i class="ph ph-caret-down text-slate-500 text-xl transition-transform" :class="{ 'rotate-180': active === 3 }"></i>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-6 pb-6">
                        <p class="text-slate-600">We provide comprehensive financial reports including revenue, expenses, profit/loss statements, cash flow analysis, and top product performance. All reports can be filtered by period and exported to PDF.</p>
                    </div>
                </div>
                
                <!-- FAQ 5 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <button x-on:click="active = active === 4 ? null : 4" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-slate-900 pr-4">Can I control user access permissions?</span>
                        <i class="ph ph-caret-down text-slate-500 text-xl transition-transform" :class="{ 'rotate-180': active === 4 }"></i>
                    </button>
                    <div x-show="active === 4" x-collapse class="px-6 pb-6">
                        <p class="text-slate-600">Yes! With our role-based access control, you can create custom roles with specific permissions. Assign different access levels to team members such as Admin, Manager, Staff, or Viewer.</p>
                    </div>
                </div>
                
                <!-- FAQ 6 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden" data-aos="fade-up" data-aos-delay="500">
                    <button x-on:click="active = active === 5 ? null : 5" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-semibold text-slate-900 pr-4">How does the support system work?</span>
                        <i class="ph ph-caret-down text-slate-500 text-xl transition-transform" :class="{ 'rotate-180': active === 5 }"></i>
                    </button>
                    <div x-show="active === 5" x-collapse class="px-6 pb-6">
                        <p class="text-slate-600">We provide 24/7 support via WhatsApp and email. For Business and Enterprise plans, you get priority support with faster response times. We also provide complete documentation and video tutorials.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    
    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img src="https://img.freepik.com/vektor-premium/logo-erp-huruf-erp-desain-logo-huruf-erp-inisial-logo-erp-terhubung-dengan-lingkaran-dan-logo-monogram-huruf-besar-tipografi-erp-untuk-bisnis-teknologi-dan-merek-real-estat_229120-74568.jpg" alt="Logo" class="h-10 w-10 rounded-xl object-cover grayscale brightness-200">
                        <span class="text-xl font-bold text-white">Minimal ERP</span>
                    </div>
                    <p class="text-slate-400 mb-6">Modern ERP software for SMEs in Indonesia. Manage your business more efficiently and organized.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-slate-700 transition-colors">
                            <i class="ph-fill ph-facebook-logo text-xl"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-slate-700 transition-colors">
                            <i class="ph-fill ph-instagram-logo text-xl"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-slate-700 transition-colors">
                            <i class="ph-fill ph-linkedin-logo text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Product -->
                <div>
                    <h4 class="text-white font-semibold mb-6">Product</h4>
                    <ul class="space-y-4">
                        <li><a href="#features" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#pricing" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Integrations</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Updates</a></li>
                    </ul>
                </div>
                
                <!-- Company -->
                <div>
                    <h4 class="text-white font-semibold mb-6">Company</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-white font-semibold mb-6">Contact</h4>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <i class="ph ph-envelope text-slate-400"></i>
                            <span class="text-slate-400">support@minimalerp.id</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph ph-phone text-slate-400"></i>
                            <span class="text-slate-400">+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="ph ph-map-pin text-slate-400"></i>
                            <span class="text-slate-400">Jakarta, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500">© {{ date('Y') }} Minimal ERP. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-slate-500 hover:text-white transition-colors text-sm">Privacy Policy</a>
                    <a href="#" class="text-slate-500 hover:text-white transition-colors text-sm">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
        
        // Alpine.js Data
        function landingApp() {
            return {
                scrolled: false,
                mobileMenuOpen: false,
                animatedStats: {
                    businesses: '0',
                    invoices: '0',
                    transactions: '0',
                    uptime: '0%'
                },
                init() {
                    const observer = new IntersectionObserver((entries) => {
                        if (entries[0].isIntersecting) {
                            this.animateStats();
                            observer.disconnect();
                        }
                    }, { threshold: 0.1 });
                    
                    this.$nextTick(() => {
                        const statsSection = document.getElementById('stats-section');
                        if (statsSection) observer.observe(statsSection);
                    });
                },
                animateStats() {
                    const targets = {
                        businesses: { val: 500, suffix: '', decimals: 0 },
                        invoices: { val: 50000, suffix: '+', decimals: 0 },
                        transactions: { val: 1000000, suffix: '+', decimals: 0 },
                        uptime: { val: 99.9, suffix: '%', decimals: 1 }
                    };
                    
                    const duration = 2000;
                    const startTime = performance.now();
                    
                    const animate = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        
                        // Ease out quartic
                        const ease = 1 - Math.pow(1 - progress, 4);
                        
                        Object.keys(targets).forEach(key => {
                            const target = targets[key];
                            const currentVal = target.val * ease;
                            
                            if (key === 'uptime') {
                                this.animatedStats[key] = currentVal.toFixed(target.decimals) + target.suffix;
                            } else {
                                let formatted = Math.floor(currentVal).toLocaleString('en-US');
                                if (progress === 1) formatted += target.suffix;
                                this.animatedStats[key] = formatted;
                            }
                        });
                        
                        if (progress < 1) {
                            requestAnimationFrame(animate);
                        }
                    };
                    
                    requestAnimationFrame(animate);
                }
            }
        }
    </script>
</body>
</html>
