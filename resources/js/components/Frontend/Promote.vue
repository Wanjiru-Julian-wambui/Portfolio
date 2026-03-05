<script setup lang="ts">
const stats = [
    {
        value: '5+',
        label: 'Projects Completed',
        description: 'Real-world client & personal projects shipped',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" /></svg>`,
        color: '#0ea5e9',
    },
    {
        value: '2+',
        label: 'Years Experience',
        description: 'Building and shipping web applications since 2023',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" /></svg>`,
        color: '#6366f1',
    },
    {
        value: '3',
        label: 'Tech Stacks',
        description: 'Proficient across frontend, backend & database layers',
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z" /></svg>`,
        color: '#f59e0b',
    },
];
</script>

<template>
    <section class="promote-section">

        <!-- Background — matches Hero -->
        <div class="bg-layer">
            <div class="orb orb-1" />
            <div class="orb orb-2" />
            <div class="orb orb-3" />
            <div class="grid-lines" />
        </div>

        <div class="mx-auto max-w-6xl px-6 relative z-10 py-24">

            <!-- Header -->
            <div class="text-center mb-16 fade-up" style="--d:0ms">
                <div class="badge">
                    <span class="badge-dot" />
                    Achievements
                </div>
                <h2 class="section-title">What I bring to the table</h2>
                <p class="section-sub">Small numbers, real impact — every project, hour, and line of code counts.</p>
            </div>

            <!-- Cards -->
            <div class="cards-row">
                <div
                    v-for="(stat, i) in stats"
                    :key="stat.label"
                    class="flip-wrapper fade-up"
                    :style="`--d: ${i * 100}ms; --accent: ${stat.color}`"
                >
                    <div class="flip-inner">

                        <!-- Front -->
                        <div class="flip-front">
                            <div class="stat-icon" :style="`color: ${stat.color}; background: ${stat.color}18`">
                                <span v-html="stat.icon" />
                            </div>
                            <div class="stat-value" :style="`color: ${stat.color}`">{{ stat.value }}</div>
                            <div class="stat-label">{{ stat.label }}</div>
                            <div class="flip-hint">Hover to learn more →</div>
                            <div class="stat-line" :style="`background: ${stat.color}`" />
                        </div>

                        <!-- Back -->
                        <div class="flip-back" :style="`background: linear-gradient(135deg, ${stat.color}, ${stat.color}cc)`">
                            <div class="back-icon">
                                <span v-html="stat.icon" />
                            </div>
                            <div class="back-value">{{ stat.value }}</div>
                            <div class="back-label">{{ stat.label }}</div>
                            <div class="back-desc">{{ stat.description }}</div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<style scoped>
/* ── Section ── */
.promote-section {
    background: #f8fafc;
    position: relative;
    overflow: hidden;
}
:root.dark .promote-section { background: #020617; }

/* ── Background — same as Hero ── */
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
    top: -100px; left: -100px;
    animation-duration: 14s;
}
.orb-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, #ec4899, #0ea5e9);
    bottom: -80px; right: -80px;
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

/* ── Badge — matches Hero ── */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.4rem 1.1rem;
    border-radius: 9999px;
    border: 1px solid rgba(14, 165, 233, 0.3);
    background: rgba(14, 165, 233, 0.08);
    font-size: 0.75rem;
    font-weight: 600;
    color: #0ea5e9;
    margin-bottom: 1.5rem;
}

.badge-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #0ea5e9;
    animation: pulse-dot 2s ease-in-out infinite;
}
@keyframes pulse-dot {
    0%, 100% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.5); }
    50%       { box-shadow: 0 0 0 5px rgba(14, 165, 233, 0); }
}

/* ── Section title — matches Hero headline ── */
.section-title {
    font-family: 'Playfair', 'Georgia', serif;
    font-size: clamp(2rem, 5vw, 3.25rem);
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.025em;
    line-height: 1.1;
    margin-bottom: 0.75rem;
}
:root.dark .section-title { color: #f1f5f9; }

.section-sub {
    font-size: 1rem;
    color: #64748b;
    max-width: 480px;
    margin: 0 auto;
    line-height: 1.7;
}
:root.dark .section-sub { color: #94a3b8; }

/* ── Cards row ── */
.cards-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    max-width: 900px;
    margin: 0 auto;
}
@media (max-width: 768px) {
    .cards-row { grid-template-columns: 1fr; }
}

/* ── Flip wrapper ── */
.flip-wrapper {
    height: 260px;
    perspective: 1000px;
    opacity: 0;
    transform: translateY(24px);
    animation: fadeUp 0.6s ease forwards;
    animation-delay: var(--d, 0ms);
}

.flip-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Desktop: flip on hover */
@media (min-width: 768px) {
    .flip-wrapper:hover .flip-inner {
        transform: rotateY(180deg);
    }
}

/* Mobile: always show back */
@media (max-width: 767px) {
    .flip-wrapper { height: auto; perspective: none; }
    .flip-inner { transform: none !important; transform-style: flat; position: static; height: auto; }
    .flip-front { display: none !important; }
    .flip-back {
        position: static !important;
        transform: none !important;
        backface-visibility: visible !important;
        -webkit-backface-visibility: visible !important;
        border-radius: 1.25rem;
        padding: 2rem 1.75rem;
        text-align: center;
        align-items: center;
        inset: auto;
    }
}

/* ── Front — glassmorphism matching Hero nav ── */
.flip-front {
    position: absolute;
    inset: 0;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    border-radius: 1.25rem;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(16px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.6);
    padding: 2rem 1.75rem 2.25rem;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(14, 165, 233, 0.06);
}
:root.dark .flip-front {
    background: rgba(15, 23, 42, 0.7);
    border-color: rgba(255, 255, 255, 0.06);
}

/* ── Back ── */
.flip-back {
    position: absolute;
    inset: 0;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    transform: rotateY(180deg);
    border-radius: 1.25rem;
    padding: 2rem 1.75rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 0.6rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.15);
}

.back-icon {
    width: 3rem; height: 3rem;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 0.4rem;
    color: white;
}
.back-icon :deep(svg) { width: 1.5rem; height: 1.5rem; }

.back-value {
    font-family: 'Playfair', 'Georgia', serif;
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    line-height: 1;
    letter-spacing: -0.02em;
}
.back-label {
    font-size: 0.9rem;
    font-weight: 700;
    color: rgba(255,255,255,0.9);
}
.back-desc {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.75);
    line-height: 1.6;
    max-width: 200px;
}

/* ── Front elements ── */
.stat-icon {
    width: 3rem; height: 3rem;
    border-radius: 0.75rem;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 1.25rem;
}
.stat-icon :deep(svg) { width: 1.5rem; height: 1.5rem; }

.stat-value {
    font-family: 'Playfair', 'Georgia', serif;
    font-size: 2.75rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 0.4rem;
    letter-spacing: -0.02em;
}

.stat-label {
    font-size: 0.9rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: auto;
}
:root.dark .stat-label { color: #f1f5f9; }

.flip-hint {
    font-size: 0.68rem;
    color: #94a3b8;
    margin-top: 0.75rem;
}

.stat-line {
    position: absolute;
    bottom: 0; left: 0;
    height: 3px; width: 100%;
    border-radius: 0 0 1.25rem 1.25rem;
}

/* ── Fade up ── */
.fade-up {
    opacity: 0;
    transform: translateY(24px);
    animation: fadeUp 0.6s ease forwards;
    animation-delay: var(--d, 0ms);
}
@keyframes fadeUp {
    to { opacity: 1; transform: translateY(0); }
}
</style>