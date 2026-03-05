<script setup lang="ts">
import { ref } from 'vue';
import ThemeToggle from '@/components/ThemeToggle.vue';

const mobileOpen = ref(false);

const navLinks = [
    { label: 'Home',     href: '#home'     },
    { label: 'About',    href: '#about'    },
    { label: 'Skills',   href: '#skills'   },
    { label: 'Projects', href: '#projects' },
    { label: 'Contact',  href: '#contact'  },
];
</script>

<template>
    <!-- Theme toggle fixed to top-right corner -->
    <div class="fixed top-3 right-4 z-50 hidden md:block">
        <ThemeToggle />
    </div>

    <header class="navbar-header fixed top-0 left-0 right-0 z-40 w-full">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">

            <!-- Logo + Name -->
            <a href="#home" class="logo-link flex items-center gap-3 group">
                <div class="logo-wrapper">
                    <div class="logo-glow"></div>
                    <img src="/favicon.svg" alt="ARSH26" class="logo-img" />
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="name-text">Julian Wambui</span>
                    <span class="tag-text">ARSH26</span>
                </div>
            </a>

            <!-- Desktop nav (centered) -->
            <nav class="hidden md:flex items-center gap-1">
                <a
                    v-for="(link, i) in navLinks"
                    :key="link.href"
                    :href="link.href"
                    class="nav-link"
                    :style="`--i: ${i}`"
                >
                    {{ link.label }}
                    <span class="nav-underline"></span>
                </a>
            </nav>

            <!-- Right side: spacer on desktop, toggle+hamburger on mobile -->
            <div class="flex items-center gap-1">
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="hamburger-btn"
                    aria-label="Toggle menu"
                >
                    <span class="bar" :class="{ open: mobileOpen }"></span>
                    <span class="bar" :class="{ open: mobileOpen }"></span>
                    <span class="bar" :class="{ open: mobileOpen }"></span>
                </button>
                <div class="md:hidden">
                    <ThemeToggle />
                </div>
            </div>

        </div>

        <!-- Mobile nav -->
        <Transition
            enter-active-class="mobile-enter-active"
            enter-from-class="mobile-enter-from"
            enter-to-class="mobile-enter-to"
            leave-active-class="mobile-leave-active"
            leave-from-class="mobile-leave-to"
            leave-to-class="mobile-enter-from"
        >
            <div v-if="mobileOpen" class="mobile-menu">
                <a
                    v-for="(link, i) in navLinks"
                    :key="link.href"
                    :href="link.href"
                    @click="mobileOpen = false"
                    class="mobile-link"
                    :style="`animation-delay: ${i * 60}ms`"
                >
                    <span class="mobile-dot"></span>
                    {{ link.label }}
                </a>
            </div>
        </Transition>
    </header>
</template>

<style scoped>
.navbar-header {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    transition: box-shadow 0.3s ease;
}

:root.dark .navbar-header {
    background: rgba(15, 23, 42, 0.8);
    box-shadow: 0 1px 32px rgba(14, 165, 233, 0.1);
}

.logo-wrapper {
    position: relative;
    width: 2.25rem;
    height: 2.25rem;
    flex-shrink: 0;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12), 0 4px 14px rgba(14, 165, 233, 0.25);
    animation: float 3.6s ease-in-out infinite;
    transition: box-shadow 0.3s ease;
}

.logo-link:hover .logo-wrapper {
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2), 0 8px 28px rgba(14, 165, 233, 0.4);
    animation-play-state: paused;
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
    animation: spin-glow 4s linear infinite, float 3.6s ease-in-out infinite;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.logo-link:hover .logo-glow { opacity: 0.7; }

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33%       { transform: translateY(-4px) rotate(1deg); }
    66%       { transform: translateY(-2px) rotate(-0.5deg); }
}

@keyframes spin-glow {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

.name-text {
    font-size: 0.875rem;
    font-weight: 700;
    letter-spacing: 0.02em;
    color: #0f172a;
    transition: color 0.2s;
}

.logo-link:hover .name-text { color: #0ea5e9; }
:root.dark .name-text { color: #f1f5f9; }

.tag-text {
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    color: #0ea5e9;
    text-transform: uppercase;
}

.nav-link {
    position: relative;
    padding: 0.375rem 0.875rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #475569;
    text-decoration: none;
    overflow: hidden;
    transition: color 0.2s ease, background 0.2s ease;
    animation: nav-fade-in 0.4s ease both;
    animation-delay: calc(var(--i) * 70ms + 100ms);
}

.nav-link::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 0.5rem;
    background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(99, 102, 241, 0.1));
    opacity: 0;
    transition: opacity 0.2s ease;
}

.nav-link:hover::before { opacity: 1; }
.nav-link:hover { color: #0ea5e9; }

.nav-underline {
    position: absolute;
    bottom: 4px;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #0ea5e9, #6366f1);
    border-radius: 1px;
    transform: translateX(-50%);
    transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-link:hover .nav-underline { width: calc(100% - 1.5rem); }

:root.dark .nav-link { color: #94a3b8; }
:root.dark .nav-link:hover { color: #e2e8f0; }

@keyframes nav-fade-in {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Hamburger — hidden on desktop, visible on mobile */
.hamburger-btn {
    display: none;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 5px;
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 0.5rem;
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 6px;
    transition: background 0.2s ease;
}

@media (max-width: 767px) {
    .hamburger-btn { display: flex; }
}

.hamburger-btn:hover { background: rgba(14, 165, 233, 0.08); }

.bar {
    display: block;
    width: 20px;
    height: 2px;
    background: #64748b;
    border-radius: 2px;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease, width 0.3s ease;
    transform-origin: center;
}

.bar:nth-child(2) { width: 14px; }
.bar.open:nth-child(1) { transform: translateY(7px) rotate(45deg); width: 20px; }
.bar.open:nth-child(2) { opacity: 0; transform: scaleX(0); }
.bar.open:nth-child(3) { transform: translateY(-7px) rotate(-45deg); width: 20px; }

/* Mobile menu — only shown on mobile */
.mobile-menu {
    display: none;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    padding: 0.75rem 1rem;
    flex-direction: column;
    gap: 2px;
}

@media (max-width: 767px) {
    .mobile-menu { display: flex; }
}

:root.dark .mobile-menu { background: rgba(15, 23, 42, 0.95); }

.mobile-link {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.625rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #475569;
    text-decoration: none;
    transition: color 0.2s ease, background 0.2s ease, transform 0.2s ease;
    animation: slide-in 0.25s ease both;
}

.mobile-link:hover {
    color: #0ea5e9;
    background: rgba(14, 165, 233, 0.07);
    transform: translateX(4px);
}

:root.dark .mobile-link { color: #94a3b8; }
:root.dark .mobile-link:hover { color: #e2e8f0; }

.mobile-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0ea5e9, #6366f1);
    flex-shrink: 0;
    opacity: 0.5;
    transition: opacity 0.2s, transform 0.2s;
}

.mobile-link:hover .mobile-dot { opacity: 1; transform: scale(1.4); }

@keyframes slide-in {
    from { opacity: 0; transform: translateX(-10px); }
    to   { opacity: 1; transform: translateX(0); }
}

.mobile-enter-active { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
.mobile-leave-active { transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1); }
.mobile-enter-from   { opacity: 0; transform: translateY(-8px); }
.mobile-enter-to     { opacity: 1; transform: translateY(0); }
</style>