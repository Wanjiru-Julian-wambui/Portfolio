<script setup lang="ts">
defineProps<{
    skills: { id: number; name: string; image: string }[];
}>();
</script>

<template>
    <section id="skills" class="skills-section relative overflow-hidden">

        <!-- Background — identical to all other sections -->
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
                    Tech Stack
                </div>
            </div>

            <!-- Heading -->
            <div class="text-center mt-6 fade-up" style="--d: 100ms">
                <h2 class="headline">
                    Tools I <em class="name-italic">Work With</em>
                </h2>
            </div>

            <!-- Subtext -->
            <p class="subtext fade-up" style="--d: 200ms">
                Technologies and frameworks I use to bring ideas to life —
                from design to deployment.
            </p>

            <!-- Divider -->
            <div class="section-divider fade-up" style="--d: 300ms"></div>

            <!-- Skills grid -->
            <div class="skills-grid" v-if="skills.length">
                <div
                    v-for="(skill, i) in skills"
                    :key="skill.id"
                    class="skill-card fade-up"
                    :style="`--d: ${340 + i * 60}ms`"
                >
                    <div class="card-glow"></div>
                    <div class="card-inner">
                        <div class="img-wrap">
                            <img :src="skill.image" :alt="skill.name" class="skill-img" />
                        </div>
                        <span class="skill-name">{{ skill.name }}</span>
                    </div>
                    <div class="card-line"></div>
                </div>
            </div>

            <!-- Empty state -->
            <div v-else class="empty-state fade-up" style="--d: 340ms">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                </svg>
                <p>No skills added yet.</p>
            </div>

        </div>
    </section>
</template>

<style scoped>
/* ── Section ── */
.skills-section {
    background: #f8fafc;
}
:root.dark .skills-section { background: #020617; }

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

/* ── Fade-up ── */
.fade-up {
    opacity: 0;
    transform: translateY(24px);
    animation: fadeUp 0.7s ease forwards;
    animation-delay: var(--d, 0ms);
}
@keyframes fadeUp {
    to { opacity: 1; transform: translateY(0); }
}

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

/* ── Section divider ── */
.section-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(14,165,233,0.3), rgba(99,102,241,0.3), transparent);
    margin: 2.5rem 0 2.5rem;
    border: none;
}

/* ── Skills grid ── */
.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
    gap: 1rem;
}
@media (max-width: 480px) {
    .skills-grid { grid-template-columns: repeat(3, 1fr); }
}

/* ── Skill card ── */
.skill-card {
    position: relative;
    overflow: hidden;
    border-radius: 1.1rem;
    border: 1px solid rgba(14, 165, 233, 0.12);
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(16px);
    padding: 1.5rem 1rem 1.25rem;
    cursor: default;
    transition: transform 0.3s ease, border-color 0.3s ease,
                box-shadow 0.3s ease, background 0.3s ease;
    box-shadow: 0 2px 0 rgba(255,255,255,0.8);
}
:root.dark .skill-card {
    background: rgba(15, 23, 42, 0.65);
    border-color: rgba(14, 165, 233, 0.1);
    box-shadow: inset 0 0 40px rgba(0,0,0,0.2);
}
.skill-card:hover {
    transform: translateY(-6px);
    border-color: rgba(14, 165, 233, 0.4);
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 16px 40px rgba(14, 165, 233, 0.12),
                0 0 0 1px rgba(14, 165, 233, 0.15);
}
:root.dark .skill-card:hover {
    background: rgba(15, 23, 42, 0.9);
    box-shadow: inset 0 0 40px rgba(0,0,0,0.3),
                0 16px 40px rgba(0,0,0,0.3),
                0 0 0 1px rgba(14, 165, 233, 0.2);
}

/* Ambient glow top-right */
.card-glow {
    position: absolute;
    top: -40px; right: -40px;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(14,165,233,0.18), transparent 70%);
    filter: blur(20px);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.35s ease;
}
.skill-card:hover .card-glow { opacity: 1; }

/* ── Card inner ── */
.card-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.85rem;
    position: relative; z-index: 1;
}

/* ── Image ── */
.img-wrap {
    width: 3.5rem; height: 3.5rem;
    display: flex; align-items: center; justify-content: center;
    border-radius: 0.75rem;
    background: rgba(14, 165, 233, 0.06);
    border: 1px solid rgba(14, 165, 233, 0.1);
    overflow: hidden;
    transition: transform 0.35s ease, box-shadow 0.35s ease, background 0.35s ease;
}
.skill-card:hover .img-wrap {
    transform: scale(1.12) rotate(-4deg);
    box-shadow: 0 6px 20px rgba(14, 165, 233, 0.2);
    background: rgba(14, 165, 233, 0.1);
}
.skill-img {
    width: 100%; height: 100%;
    object-fit: contain;
    padding: 0.4rem;
    transition: filter 0.3s ease;
    filter: drop-shadow(0 1px 3px rgba(0,0,0,0.08));
}
:root.dark .skill-img { filter: drop-shadow(0 1px 4px rgba(0,0,0,0.4)) brightness(0.95); }

/* ── Skill name ── */
.skill-name {
    font-size: 0.78rem;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: 0.02em;
    text-align: center;
    line-height: 1.3;
    transition: color 0.3s ease;
}
:root.dark .skill-name { color: #e0e7ff; }
.skill-card:hover .skill-name { color: #0ea5e9; }

/* ── Bottom accent line ── */
.card-line {
    position: absolute;
    bottom: 0; left: 0;
    height: 2px; width: 0;
    background: linear-gradient(90deg, #0ea5e9, #6366f1, transparent);
    border-radius: 0 9999px 9999px 0;
    transition: width 0.4s ease;
}
.skill-card:hover .card-line { width: 100%; }

/* ── Empty state ── */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    padding: 3rem;
    color: #94a3b8;
    text-align: center;
}
.empty-state svg {
    width: 2.5rem; height: 2.5rem;
    opacity: 0.4;
}
.empty-state p {
    font-size: 0.9rem;
    font-weight: 500;
}
</style>