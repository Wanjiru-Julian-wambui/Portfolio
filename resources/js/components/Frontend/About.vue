<script setup lang="ts">
const interests = [
    {
        label: 'UI Design',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" /></svg>`,
    },
    {
        label: 'Web Dev',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" /></svg>`,
    },
    {
        label: 'Open Source',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" /></svg>`,
    },
    {
        label: 'Problem Solving',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>`,
    },
];

const builds = [
    {
        icon: `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' d='M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0H3' /></svg>`,
        title: 'Frontend',
        color: '#0ea5e9',
        accentColor: 'rgba(14,165,233,0.15)',
        glowColor: 'rgba(14,165,233,0.25)',
        desc: 'Responsive, pixel-perfect UIs with Vue.js, React and Next.js.',
        tag: 'Vue · React · Next.js',
        image: 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=600&q=80&fit=crop',
    },
    {
        icon: `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' d='m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z' /></svg>`,
        title: 'Backend',
        color: '#6366f1',
        accentColor: 'rgba(99,102,241,0.12)',
        glowColor: 'rgba(99,102,241,0.22)',
        desc: 'Robust APIs and server-side logic with Node.js and Laravel.',
        tag: 'Node.js · Laravel',
        image: 'https://hard-sapphire-ckrqa4rdnd.edgeone.app/yupp-generated-image-146761.png',
    },
    {
        icon: `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' d='M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125' /></svg>`,
        title: 'Databases',
        color: '#ec4899',
        accentColor: 'rgba(236,72,153,0.12)',
        glowColor: 'rgba(236,72,153,0.22)',
        desc: 'Structured data with MySQL, MongoDB and Firebase.',
        tag: 'MySQL · MongoDB · Firebase',
        image: 'https://solar-lavender-kowv2v8gsj.edgeone.app/yupp-generated-image-582696.png',
    },
    {
        icon: `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' d='M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z' /></svg>`,
        title: 'Full Stack',
        color: '#10b981',
        accentColor: 'rgba(16,185,129,0.12)',
        glowColor: 'rgba(16,185,129,0.22)',
        desc: 'End-to-end products — from idea to a live, deployed application.',
        tag: 'End-to-end · Deployed',
        image: 'https://tasty-beige-daisqwzqbx.edgeone.app/yupp-generated-image-710443.png',
    },
];
</script>

<template>
    <section id="about" class="about-section relative overflow-hidden">

        <!-- Background — identical to Hero & Promote -->
        <div class="bg-layer" aria-hidden="true">
            <div class="orb orb-1" />
            <div class="orb orb-2" />
            <div class="orb orb-3" />
            <div class="grid-lines" />
        </div>

        <!-- Floating particles — identical to Hero -->
        <div class="particles" aria-hidden="true">
            <span v-for="n in 12" :key="n" class="particle" :style="`--n: ${n}`" />
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 py-24">

            <!-- Section badge -->
            <div class="flex justify-center fade-up" style="--d: 0ms">
                <div class="badge">
                    <span class="badge-dot" />
                    About Me
                </div>
            </div>

            <!-- Heading -->
            <div class="text-center mt-6 fade-up" style="--d: 100ms">
                <h2 class="headline">
                    Hi, I'm <em class="name-italic">Julian</em>
                    <span class="wave">👋</span>
                </h2>
            </div>

            <!-- Bio -->
            <p class="bio fade-up" style="--d: 220ms">
                I'm a junior web developer based in Kenya who loves turning ideas into
                real, working products. Since 2023 I've shipped 5+ projects — building everything
                from client websites to full-stack platforms used by hundreds of people.
                I write clean code, sweat the details, and never stop learning.
                When I step away from the screen, a good book is never far away.
            </p>

            <!-- Divider -->
            <div class="section-divider fade-up" style="--d: 300ms" />

            <!-- Interests label -->
            <p class="section-label fade-up" style="--d: 340ms">INTERESTS</p>

            <!-- Interests icon grid -->
            <div class="icon-grid">
                <div
                    v-for="(item, i) in interests"
                    :key="item.label"
                    class="icon-cell fade-up"
                    :style="`--d: ${380 + i * 80}ms`"
                >
                    <span class="icon-svg" v-html="item.svg" />
                    <span class="icon-label">{{ item.label }}</span>
                </div>
            </div>

            <!-- Divider -->
            <div class="section-divider fade-up" style="--d: 640ms" />

            <!-- Builds label -->
            <p class="section-label fade-up" style="--d: 680ms">WHAT I BUILD</p>

            <!-- Bento grid -->
            <div class="bento-grid">
                <div
                    v-for="(item, i) in builds"
                    :key="item.title"
                    class="bento-card fade-up"
                    :style="`--d: ${720 + i * 100}ms; --c: ${item.color}; --glow: ${item.glowColor}; --accent: ${item.accentColor}`"
                >
                    <div class="bento-ambient" />

                    <div class="bento-top-row">
                        <span class="bento-num">0{{ i + 1 }}</span>
                        <span class="bento-tag">{{ item.tag }}</span>
                    </div>

                    <div class="bento-mock">
                        <img :src="item.image" :alt="item.title" class="mock-img" />
                        <div class="mock-overlay" />
                    </div>

                    <div class="bento-body">
                        <div class="bento-icon-wrap">
                            <span class="bento-icon" v-html="item.icon" />
                        </div>
                        <div>
                            <h4 class="bento-title">{{ item.title }}</h4>
                            <p class="bento-desc">{{ item.desc }}</p>
                        </div>
                    </div>

                    <div class="bento-line" />
                </div>
            </div>

        </div>
    </section>
</template>

<style scoped>
/* ── Section — matches Hero & Promote ── */
.about-section {
    background: #f8fafc;
}
:root.dark .about-section { background: #020617; }

/* ── Background orbs — identical to Hero & Promote ── */
.bg-layer {
    position: absolute;
    inset: 0;
    pointer-events: none;
}
.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.35;
    animation: drift 12s ease-in-out infinite alternate;
}
.orb-1 {
    width: 500px; height: 500px;
    background: radial-gradient(circle, #38bdf8, #6366f1);
    top: -100px; right: -100px;
    animation-duration: 14s;
}
.orb-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, #ec4899, #0ea5e9);
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
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(14, 165, 233, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(14, 165, 233, 0.05) 1px, transparent 1px);
    background-size: 60px 60px;
}

/* ── Particles — identical to Hero ── */
.particles { position: absolute; inset: 0; pointer-events: none; }
.particle {
    position: absolute;
    width: 4px; height: 4px;
    border-radius: 50%;
    background: #0ea5e9;
    opacity: 0.4;
    left: calc(var(--n) * 8.3%);
    top: calc(var(--n) * 7.5%);
    animation: particle-float calc(4s + var(--n) * 0.5s) ease-in-out infinite alternate;
}
@keyframes particle-float {
    from { transform: translateY(0) scale(1); opacity: 0.4; }
    to   { transform: translateY(-30px) scale(1.5); opacity: 0.8; }
}

/* ── Fade-up — identical to Hero ── */
.fade-up {
    opacity: 0;
    transform: translateY(24px);
    animation: fadeUp 0.7s ease forwards;
    animation-delay: var(--d, 0ms);
}
@keyframes fadeUp {
    to { opacity: 1; transform: translateY(0); }
}

/* ── Badge — identical to Hero & Promote ── */
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

/* ── Headline — identical to Hero ── */
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

.wave {
    display: inline-block;
    animation: wave 2s ease-in-out infinite;
    transform-origin: 70% 70%;
    -webkit-text-fill-color: initial;
}
@keyframes wave {
    0%, 60%, 100% { transform: rotate(0deg); }
    10% { transform: rotate(14deg); }
    20% { transform: rotate(-8deg); }
    30% { transform: rotate(14deg); }
    40% { transform: rotate(-4deg); }
    50% { transform: rotate(10deg); }
}

/* ── Bio ── */
.bio {
    font-size: 1rem;
    line-height: 1.8;
    color: #64748b;
    max-width: 600px;
    margin: 1.5rem auto 0;
    text-align: center;
}
:root.dark .bio { color: #94a3b8; }

/* ── Section divider ── */
.section-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(14,165,233,0.3), rgba(99,102,241,0.3), transparent);
    margin: 2.5rem 0 2rem;
    border: none;
}

/* ── Section label ── */
.section-label {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #0ea5e9;
    text-align: center;
    margin-bottom: 1.25rem;
}

/* ── Icon grid ── */
.icon-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
}
@media (max-width: 580px) {
    .icon-grid { grid-template-columns: repeat(2, 1fr); }
}
.icon-cell {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.65rem;
    padding: 1.75rem 1rem;
    border-radius: 1rem;
    border: 1px solid rgba(14, 165, 233, 0.15);
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(16px);
    cursor: default;
    opacity: 0;
    transform: translateY(16px);
    animation: fadeUp 0.5s ease forwards;
    animation-delay: var(--d, 0ms);
    transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
}
:root.dark .icon-cell {
    background: rgba(15, 23, 42, 0.6);
    border-color: rgba(14, 165, 233, 0.12);
}
.icon-cell:hover {
    transform: translateY(-5px);
    border-color: rgba(14, 165, 233, 0.45);
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 8px 32px rgba(14, 165, 233, 0.12);
}
:root.dark .icon-cell:hover { background: rgba(15, 23, 42, 0.9); }
.icon-svg {
    width: 2rem; height: 2rem;
    display: flex; align-items: center; justify-content: center;
    color: #0ea5e9;
    filter: drop-shadow(0 0 6px rgba(14, 165, 233, 0.35));
    transition: transform 0.3s ease;
}
.icon-svg :deep(svg) { width: 2rem; height: 2rem; }
.icon-cell:hover .icon-svg { animation: bounce-icon 0.5s ease; }
@keyframes bounce-icon {
    0%   { transform: translateY(0) scale(1); }
    40%  { transform: translateY(-7px) scale(1.15); }
    100% { transform: translateY(0) scale(1); }
}
.icon-label {
    font-size: 0.78rem;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: 0.04em;
    text-align: center;
}
:root.dark .icon-label { color: #e0e7ff; }

/* ── Bento grid ── */
.bento-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}
@media (max-width: 580px) {
    .bento-grid { grid-template-columns: 1fr; }
}

.bento-card {
    position: relative;
    overflow: hidden;
    padding: 1.5rem;
    border-radius: 1.25rem;
    border: 1px solid rgba(14, 165, 233, 0.12);
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(20px);
    display: flex;
    flex-direction: column;
    gap: 1rem;
    min-height: 260px;
    cursor: default;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.6s ease forwards;
    animation-delay: var(--d, 0ms);
    transition: transform 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease, background 0.35s ease;
    box-shadow: 0 2px 0 rgba(255,255,255,0.8);
}
:root.dark .bento-card {
    background: rgba(15, 23, 42, 0.7);
    border-color: rgba(14, 165, 233, 0.1);
    box-shadow: inset 0 0 60px rgba(0,0,0,0.3), 0 2px 0 rgba(255,255,255,0.04);
}

.bento-ambient {
    position: absolute;
    top: -60px; right: -60px;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: var(--glow, rgba(14,165,233,0.15));
    filter: blur(50px);
    pointer-events: none;
    opacity: 0.5;
    transition: opacity 0.4s ease;
}
.bento-card:hover .bento-ambient { opacity: 1; }

.bento-card:hover {
    transform: translateY(-6px) scale(1.01);
    border-color: color-mix(in srgb, var(--c) 40%, transparent);
    background: rgba(255, 255, 255, 0.85);
    box-shadow: 0 20px 60px rgba(14,165,233,0.1),
                0 0 0 1px color-mix(in srgb, var(--c) 20%, transparent);
}
:root.dark .bento-card:hover {
    background: rgba(15, 23, 42, 0.9);
    box-shadow: inset 0 0 60px rgba(0,0,0,0.4),
                0 20px 60px rgba(0,0,0,0.4),
                0 0 0 1px color-mix(in srgb, var(--c) 20%, transparent);
}

/* ── Top row ── */
.bento-top-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative; z-index: 2;
}
.bento-num {
    font-family: 'Playfair', Georgia, serif;
    font-size: 0.62rem;
    font-weight: 800;
    letter-spacing: 0.15em;
    color: rgba(15,23,42,0.2);
    transition: color 0.3s ease;
}
:root.dark .bento-num { color: rgba(255,255,255,0.18); }
.bento-card:hover .bento-num { color: var(--c); }

.bento-tag {
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    color: #94a3b8;
    background: rgba(14,165,233,0.06);
    border: 1px solid rgba(14,165,233,0.15);
    padding: 0.2rem 0.6rem;
    border-radius: 9999px;
    transition: background 0.3s, border-color 0.3s, color 0.3s;
}
.bento-card:hover .bento-tag {
    background: var(--accent);
    border-color: color-mix(in srgb, var(--c) 35%, transparent);
    color: var(--c);
}

/* ── Mock image preview ── */
.bento-mock {
    position: relative; z-index: 2;
    border-radius: 0.75rem;
    overflow: hidden;
    flex: 1;
    min-height: 110px;
    border: 1px solid rgba(14,165,233,0.1);
    transition: border-color 0.3s ease;
}
:root.dark .bento-mock { border-color: rgba(255,255,255,0.07); }
.bento-card:hover .bento-mock {
    border-color: color-mix(in srgb, var(--c) 30%, transparent);
}
.mock-img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease, filter 0.4s ease;
    filter: saturate(0.7) brightness(0.85);
}
.bento-card:hover .mock-img {
    transform: scale(1.06);
    filter: saturate(1) brightness(0.95);
}
.mock-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 40%, color-mix(in srgb, var(--c) 15%, transparent) 100%);
    pointer-events: none;
    transition: opacity 0.4s ease;
}
.bento-card:hover .mock-overlay { opacity: 0.6; }

/* ── Body ── */
.bento-body {
    display: flex;
    align-items: flex-start;
    gap: 0.85rem;
    position: relative; z-index: 2;
}
.bento-icon-wrap {
    width: 2.5rem; height: 2.5rem;
    border-radius: 0.75rem;
    background: var(--accent);
    border: 1px solid color-mix(in srgb, var(--c) 25%, transparent);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.bento-card:hover .bento-icon-wrap {
    transform: scale(1.1) rotate(-5deg);
    box-shadow: 0 0 20px color-mix(in srgb, var(--c) 30%, transparent);
}
.bento-icon {
    display: flex; align-items: center; justify-content: center;
    color: var(--c);
}
.bento-icon :deep(svg) { width: 1.25rem; height: 1.25rem; }

.bento-title {
    font-family: 'Playfair', Georgia, serif;
    font-size: 1.05rem;
    font-weight: 800;
    color: var(--c);
    margin: 0 0 0.3rem;
    letter-spacing: -0.01em;
}
.bento-desc {
    font-size: 0.78rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
    transition: color 0.3s ease;
}
:root.dark .bento-desc { color: rgba(255,255,255,0.38); }
.bento-card:hover .bento-desc { color: #475569; }
:root.dark .bento-card:hover .bento-desc { color: rgba(255,255,255,0.6); }

/* ── Bottom accent line ── */
.bento-line {
    position: absolute;
    bottom: 0; left: 0;
    height: 2px; width: 0;
    background: linear-gradient(90deg, var(--c), transparent);
    border-radius: 0 9999px 9999px 0;
    transition: width 0.45s ease;
}
.bento-card:hover .bento-line { width: 100%; }
</style>