<script setup lang="ts">
const year = new Date().getFullYear();

const navLinks = [
    { label: 'Home',     href: '#home'     },
    { label: 'About',    href: '#about'    },
    { label: 'Skills',   href: '#skills'   },
    { label: 'Projects', href: '#projects' },
    { label: 'Contact',  href: '#contact'  },
];

const socials = [
    {
        label: 'GitHub',
        href: 'https://github.com/Wanjiru-Julian-wambui',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>`
    },
];
</script>

<template>
    <footer class="footer-root w-full border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
        <div class="mx-auto max-w-6xl px-6 py-12">

            <!-- Top row -->
            <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-8">

                <!-- Brand -->
                <div class="fade-up flex flex-col items-center md:items-start gap-2" style="--delay: 0ms">
                    <a href="#home" class="logo-link flex items-center gap-2.5 group">
                        <div class="logo-wrapper">
                            <div class="logo-glow"></div>
                            <img src="/favicon.svg" alt="ARSH26" class="logo-img" />
                        </div>
                        <div class="flex flex-col leading-tight">
                            <span class="text-sm font-bold text-slate-900 dark:text-white">Julian Wambui</span>
                            <span class="text-xs text-sky-500 font-medium tracking-widest uppercase">ARSH26</span>
                        </div>
                    </a>
                    <p class="text-xs text-slate-400 dark:text-slate-500 max-w-xs text-center md:text-left">
                        Building clean, thoughtful digital experiences one project at a time.
                    </p>
                </div>

                <!-- Nav links -->
                <div class="fade-up flex flex-col items-center md:items-start gap-2" style="--delay: 100ms">
                    <span class="text-xs font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-1">Navigation</span>
                    <a
                        v-for="link in navLinks"
                        :key="link.href"
                        :href="link.href"
                        class="nav-item text-sm text-slate-500 dark:text-slate-400 hover:text-sky-500 dark:hover:text-sky-400 transition-colors"
                    >
                        {{ link.label }}
                    </a>
                </div>

                <!-- Socials -->
                <div class="fade-up flex flex-col items-center md:items-start gap-3" style="--delay: 200ms">
                    <span class="text-xs font-semibold uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-1">Find me on</span>
                    <a
                        v-for="social in socials"
                        :key="social.href"
                        :href="social.href"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-link flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 hover:text-sky-500 dark:hover:text-sky-400 transition-colors group"
                    >
                        <span class="h-4 w-4 shrink-0 group-hover:scale-125 transition-transform duration-200" v-html="social.icon" />
                        {{ social.label }}
                    </a>
                </div>

            </div>

            <!-- Divider with animated gradient line -->
            <div class="mt-10 pt-6 relative">
                <div class="gradient-line"></div>

                <!-- Copyright -->
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
                    <p class="text-xs text-slate-400 dark:text-slate-500">
                        © {{ year }} ARSH26. All rights reserved.
                    </p>
                </div>

                <!-- Centered floating Created by -->
                <div class="flex justify-center">
                    <p class="created-by text-sm text-slate-400 dark:text-slate-500 flex items-center gap-1.5">
                        Created by
                        <a
                            href="https://github.com/Wanjiru-Julian-wambui"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="shimmer-text font-bold text-sm hover:opacity-80 transition-opacity"
                        >
                            ARSH26
                        </a>
                    </p>
                </div>
            </div>

        </div>
    </footer>
</template>

<style scoped>
/* ── Fade up on load ── */
.fade-up {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.6s ease forwards;
    animation-delay: var(--delay, 0ms);
}

@keyframes fadeUp {
    to { opacity: 1; transform: translateY(0); }
}

/* ── Nav item hover slide ── */
.nav-item {
    position: relative;
    padding-left: 0;
    transition: padding-left 0.2s ease, color 0.2s ease;
}

.nav-item:hover {
    padding-left: 8px;
}

.nav-item::before {
    content: '›';
    position: absolute;
    left: -2px;
    opacity: 0;
    color: #0ea5e9;
    transition: opacity 0.2s ease, left 0.2s ease;
}

.nav-item:hover::before {
    opacity: 1;
    left: 0px;
}

/* ── Animated gradient divider ── */
.gradient-line {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #0ea5e9, #6366f1, #ec4899, transparent);
    background-size: 200% 100%;
    animation: shimmer-line 3s linear infinite;
}

@keyframes shimmer-line {
    0%   { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* ── Floating logo ── */
.logo-wrapper {
    position: relative;
    width: 2.25rem;
    height: 2.25rem;
    flex-shrink: 0;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
    animation: float 3.6s ease-in-out infinite;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12), 0 4px 14px rgba(14, 165, 233, 0.25);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}

.logo-link:hover .logo-wrapper {
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2), 0 8px 28px rgba(14, 165, 233, 0.4);
    transform: scale(1.06);
}

.logo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.logo-glow {
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    background: conic-gradient(from 0deg, #0ea5e9, #6366f1, #ec4899, #0ea5e9);
    opacity: 0;
    filter: blur(6px);
    animation: spin-glow 4s linear infinite;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.logo-link:hover .logo-glow { opacity: 0.7; }

@keyframes spin-glow {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

/* ── Floating logo ── */
.logo-float {
    animation: float 3.6s ease-in-out infinite;
}

/* ── Floating created by ── */
.created-by {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50%       { transform: translateY(-6px); }
}

/* ── Shimmer text ── */
.shimmer-text {
    background: linear-gradient(90deg, #0ea5e9, #6366f1, #ec4899, #0ea5e9);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shimmer-text 3s linear infinite;
}

@keyframes shimmer-text {
    0%   { background-position: 0% center; }
    100% { background-position: 200% center; }
}
</style>