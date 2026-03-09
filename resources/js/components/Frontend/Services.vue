<script setup lang="ts">
const services = [
    {
        title: 'Frontend Development',
        description: 'Building responsive, fast, and accessible user interfaces using Vue.js, React, and modern CSS. Every pixel crafted with attention to detail.',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" /></svg>`,
        color: '#0ea5e9',
        gradient: 'linear-gradient(135deg, rgba(14,165,233,0.12), rgba(99,102,241,0.06))',
    },
    {
        title: 'Backend Development',
        description: 'Designing robust, scalable server-side systems with Laravel and Node.js. Clean architecture, secure APIs, and reliable business logic.',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 17.25v.75a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25v-.75M3.75 12.75V12a2.25 2.25 0 0 1 2.25-2.25h12A2.25 2.25 0 0 1 20.25 12v.75M3.75 6.75V6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v.75M3.75 6.75h16.5M3.75 12.75h16.5" /></svg>`,
        color: '#6366f1',
        gradient: 'linear-gradient(135deg, rgba(99,102,241,0.12), rgba(236,72,153,0.06))',
    },
    {
        title: 'Full Stack Development',
        description: 'End-to-end ownership of features from database schema to polished UI. Bridging the gap between design and infrastructure seamlessly.',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>`,
        color: '#ec4899',
        gradient: 'linear-gradient(135deg, rgba(236,72,153,0.12), rgba(14,165,233,0.06))',
    },
    {
        title: 'Database Design',
        description: 'Structuring efficient relational databases with MySQL and SQLite. Optimised queries, clean schemas, and migrations that scale with your product.',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>`,
        color: '#10b981',
        gradient: 'linear-gradient(135deg, rgba(16,185,129,0.12), rgba(14,165,233,0.06))',
    },
    {
        title: 'API Development',
        description: 'Creating clean, well-documented RESTful APIs that are a pleasure to integrate with. Authentication, rate limiting, and versioning handled properly.',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>`,
        color: '#f59e0b',
        gradient: 'linear-gradient(135deg, rgba(245,158,11,0.12), rgba(99,102,241,0.06))',
    },
    {
        title: 'UI/UX Design',
        description: 'Translating ideas into intuitive, visually compelling interfaces. Wireframes, prototypes, and polished designs that users genuinely enjoy.',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" /></svg>`,
        color: '#8b5cf6',
        gradient: 'linear-gradient(135deg, rgba(139,92,246,0.12), rgba(236,72,153,0.06))',
    },
];
</script>

<template>
    <section id="services" class="services-section relative overflow-hidden">

        <!-- Background -->
        <div class="bg-layer" aria-hidden="true">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
            <div class="grid-lines"></div>
        </div>
        <div class="particles" aria-hidden="true">
            <span v-for="n in 12" :key="n" class="particle" :style="`--n: ${n}`"></span>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 py-24">

            <!-- Badge -->
            <div class="flex justify-center fade-up" style="--d: 0ms">
                <div class="badge">
                    <span class="badge-dot"></span>
                    What I Offer
                </div>
            </div>

            <!-- Heading -->
            <div class="text-center mt-6 fade-up" style="--d: 100ms">
                <h2 class="headline">
                    How I Can <em class="name-italic">Help You</em>
                </h2>
            </div>

            <!-- Subtext -->
            <p class="subtext fade-up" style="--d: 200ms">
                From idea to launch — I cover the full spectrum of modern web development
                with a focus on quality, performance, and clean code.
            </p>

            <!-- Divider -->
            <div class="section-divider fade-up" style="--d: 300ms"></div>

            <!-- Services grid -->
            <div class="services-grid">
                <div
                    v-for="(service, i) in services"
                    :key="service.title"
                    class="service-card fade-up"
                    :style="`--d: ${340 + i * 80}ms`"
                >
                    <div class="card-bg" :style="`background: ${service.gradient}`"></div>
                    <div class="card-ambient" :style="`background: radial-gradient(circle, ${service.color}22, transparent 70%)`"></div>

                    <!-- Icon -->
                    <div class="icon-wrap" :style="`--c: ${service.color}`">
                        <span v-html="service.icon" class="icon-svg"></span>
                    </div>

                    <!-- Content -->
                    <div class="card-content">
                        <h3 class="service-title">{{ service.title }}</h3>
                        <p class="service-desc">{{ service.description }}</p>
                    </div>

                    <!-- Corner accent -->
                    <div class="corner-dot" :style="`background: ${service.color}`"></div>
                    <div class="card-line" :style="`--c: ${service.color}`"></div>
                </div>
            </div>

        </div>
    </section>
</template>

<style scoped>
/* ── Section ── */
.services-section { background: #f8fafc; }
:root.dark .services-section { background: #020617; }

/* ── Background ── */
.bg-layer { position: absolute; inset: 0; pointer-events: none; }
.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.35;
    animation: drift 12s ease-in-out infinite alternate;
}
.orb-1 {
    width: 500px; height: 500px;
    background: radial-gradient(circle, #ec4899, #6366f1);
    top: -100px; right: -100px;
    animation-duration: 14s;
}
.orb-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, #38bdf8, #10b981);
    bottom: -80px; left: -80px;
    animation-duration: 10s;
    animation-direction: alternate-reverse;
}
.orb-3 {
    width: 300px; height: 300px;
    background: radial-gradient(circle, #6366f1, #38bdf8);
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    animation-duration: 16s;
    opacity: 0.2;
}
:root.dark .orb { opacity: 0.2; }
@keyframes drift {
    from { transform: translate(0, 0) scale(1); }
    to   { transform: translate(30px, 20px) scale(1.1); }
}
.grid-lines {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(14,165,233,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(14,165,233,0.05) 1px, transparent 1px);
    background-size: 60px 60px;
}

/* ── Particles ── */
.particles { position: absolute; inset: 0; pointer-events: none; }
.particle {
    position: absolute;
    width: 4px; height: 4px;
    border-radius: 50%;
    background: #6366f1;
    opacity: 0.4;
    left: calc(var(--n) * 8.3%);
    top: calc(var(--n) * 7.5%);
    animation: particle-float calc(4s + var(--n) * 0.5s) ease-in-out infinite alternate;
}
@keyframes particle-float {
    from { transform: translateY(0) scale(1); opacity: 0.4; }
    to   { transform: translateY(-30px) scale(1.5); opacity: 0.8; }
}

/* ── Fade-up ── */
.fade-up {
    opacity: 0;
    transform: translateY(24px);
    animation: fadeUp 0.7s ease forwards;
    animation-delay: var(--d, 0ms);
}
@keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

/* ── Badge ── */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.35rem 1rem;
    border-radius: 9999px;
    border: 1px solid rgba(14, 165, 233, 0.3);
    background: rgba(14, 165, 233, 0.08);
    font-size: 0.75rem;
    font-weight: 600;
    color: #0ea5e9;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.badge-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #0ea5e9;
    animation: pulse-dot 1.5s ease-in-out infinite;
}
@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(0.7); }
}

/* ── Headline ── */
.headline {
    font-family: 'Playfair', 'Georgia', serif;
    font-size: clamp(2.2rem, 6vw, 4rem);
    font-weight: 800;
    line-height: 1.1;
    color: #0f172a;
    letter-spacing: -0.02em;
}
:root.dark .headline { color: #f1f5f9; }
.name-italic {
    font-style: italic;
    background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 50%, #ec4899 100%);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shimmer 4s linear infinite;
}
@keyframes shimmer {
    0%   { background-position: 0% center; }
    100% { background-position: 200% center; }
}

/* ── Subtext ── */
.subtext {
    font-size: 1rem;
    line-height: 1.8;
    color: #64748b;
    max-width: 520px;
    margin: 1.25rem auto 0;
    text-align: center;
}
:root.dark .subtext { color: #94a3b8; }

/* ── Divider ── */
.section-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(14,165,233,0.3), rgba(99,102,241,0.3), transparent);
    margin: 2.5rem 0;
}

/* ── Grid ── */
.services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}
@media (max-width: 768px) { .services-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .services-grid { grid-template-columns: 1fr; } }

/* ── Card ── */
.service-card {
    position: relative;
    overflow: hidden;
    border-radius: 1.25rem;
    border: 1px solid rgba(14, 165, 233, 0.1);
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(16px);
    padding: 1.75rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    transition: transform 0.35s ease, border-color 0.35s ease,
                box-shadow 0.35s ease;
    box-shadow: 0 2px 0 rgba(255,255,255,0.8);
    cursor: default;
}
:root.dark .service-card {
    background: rgba(15, 23, 42, 0.65);
    border-color: rgba(14, 165, 233, 0.08);
    box-shadow: inset 0 0 40px rgba(0,0,0,0.15);
}
.service-card:hover {
    transform: translateY(-5px);
    border-color: rgba(var(--c, 14,165,233), 0.35);
    box-shadow: 0 18px 45px rgba(14, 165, 233, 0.08),
                0 0 0 1px rgba(14, 165, 233, 0.1);
}
:root.dark .service-card:hover {
    box-shadow: inset 0 0 40px rgba(0,0,0,0.2),
                0 18px 45px rgba(0,0,0,0.25),
                0 0 0 1px rgba(14, 165, 233, 0.15);
}

/* Card gradient background */
.card-bg {
    position: absolute; inset: 0;
    opacity: 0.6;
    pointer-events: none;
    transition: opacity 0.35s ease;
    border-radius: inherit;
}
.service-card:hover .card-bg { opacity: 1; }

/* Ambient glow */
.card-ambient {
    position: absolute;
    top: -40px; right: -40px;
    width: 160px; height: 160px;
    border-radius: 50%;
    filter: blur(30px);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.4s ease;
}
.service-card:hover .card-ambient { opacity: 1; }

/* ── Icon ── */
.icon-wrap {
    width: 3rem; height: 3rem;
    border-radius: 0.85rem;
    background: rgba(255,255,255,0.7);
    border: 1px solid rgba(255,255,255,0.9);
    display: flex; align-items: center; justify-content: center;
    position: relative; z-index: 1;
    transition: transform 0.35s ease, box-shadow 0.35s ease, background 0.35s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
:root.dark .icon-wrap {
    background: rgba(15,23,42,0.7);
    border-color: rgba(255,255,255,0.06);
}
.service-card:hover .icon-wrap {
    transform: scale(1.1) rotate(-4deg);
    box-shadow: 0 6px 20px color-mix(in srgb, var(--c, #0ea5e9) 30%, transparent);
}
.icon-svg {
    display: flex; align-items: center; justify-content: center;
    color: var(--c, #0ea5e9);
}
.icon-svg :deep(svg) {
    width: 1.4rem; height: 1.4rem;
}

/* ── Content ── */
.card-content {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    position: relative; z-index: 1;
    flex: 1;
}
.service-title {
    font-family: 'Playfair', Georgia, serif;
    font-size: 1rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
    letter-spacing: -0.01em;
    transition: color 0.3s ease;
}
:root.dark .service-title { color: #f1f5f9; }
.service-card:hover .service-title { color: var(--c, #0ea5e9); }

.service-desc {
    font-size: 0.8rem;
    line-height: 1.7;
    color: #64748b;
    margin: 0;
}
:root.dark .service-desc { color: #94a3b8; }

/* ── Corner dot ── */
.corner-dot {
    position: absolute;
    top: 1.1rem; right: 1.1rem;
    width: 6px; height: 6px;
    border-radius: 50%;
    opacity: 0.5;
    transition: opacity 0.3s ease, transform 0.3s ease;
    z-index: 1;
}
.service-card:hover .corner-dot { opacity: 1; transform: scale(1.5); }

/* ── Bottom accent line ── */
.card-line {
    position: absolute;
    bottom: 0; left: 0;
    height: 2px; width: 0;
    background: linear-gradient(90deg, var(--c, #0ea5e9), transparent);
    border-radius: 0 9999px 9999px 0;
    transition: width 0.45s ease;
}
.service-card:hover .card-line { width: 100%; }
</style>