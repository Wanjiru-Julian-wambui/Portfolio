<script setup lang="ts">
interface Skill {
    id: number;
    name: string;
    image: string;
}

interface Project {
    id: number;
    name: string;
    description: string | null;
    image: string;
    project_url: string | null;
    skill_ids: number[];
    skills: Skill[];
}

defineProps<{
    projects: Project[];
}>();
</script>

<template>
    <section id="projects" class="projects-section relative overflow-hidden">

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
                    Portfolio
                </div>
            </div>

            <!-- Heading -->
            <div class="text-center mt-6 fade-up" style="--d: 100ms">
                <h2 class="headline">
                    Things I've <em class="name-italic">Built</em>
                </h2>
            </div>

            <!-- Subtext -->
            <p class="subtext fade-up" style="--d: 200ms">
                A selection of projects I've designed and developed —
                from concept to deployment.
            </p>

            <!-- Divider -->
            <div class="section-divider fade-up" style="--d: 300ms"></div>

            <!-- Projects grid -->
            <div class="projects-grid" v-if="projects.length">
                <div
                    v-for="(project, i) in projects"
                    :key="project.id"
                    class="project-card fade-up"
                    :style="`--d: ${340 + i * 100}ms`"
                >
                    <div class="card-ambient"></div>

                    <!-- Image -->
                    <div class="card-img-wrap">
                        <img
                            :src="project.image"
                            :alt="project.name"
                            class="card-img"
                        />
                        <div class="card-img-overlay"></div>

                        <!-- Skills pill -->
                        <div class="skill-pill">
                            <template v-for="(skill, i) in project.skills" :key="skill.id">
                                <img :src="skill.image" :alt="skill.name" class="skill-pill-img" />
                                <span>{{ skill.name }}</span>
                                <span v-if="i < project.skills.length - 1" class="skill-pill-sep">·</span>
                            </template>
                        </div>

                        <!-- Visit button -->
                        <a
                            v-if="project.project_url"
                            :href="project.project_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="visit-btn"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                            <span>Visit</span>
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <h3 class="card-title">{{ project.name }}</h3>
                        <p v-if="project.description" class="card-desc">{{ project.description }}</p>
                    </div>

                    <div class="card-line"></div>
                </div>
            </div>

            <!-- Empty state -->
            <div v-else class="empty-state fade-up" style="--d: 340ms">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>
                <p>No projects added yet.</p>
            </div>

        </div>
    </section>
</template>

<style scoped>
/* ── Section ── */
.projects-section { background: #f8fafc; }
:root.dark .projects-section { background: #020617; }

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
    background: radial-gradient(circle, #6366f1, #38bdf8);
    top: -100px; left: -100px;
    animation-duration: 14s;
}
.orb-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, #0ea5e9, #ec4899);
    bottom: -80px; right: -80px;
    animation-duration: 10s;
    animation-direction: alternate-reverse;
}
.orb-3 {
    width: 300px; height: 300px;
    background: radial-gradient(circle, #38bdf8, #6366f1);
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
.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}
@media (max-width: 768px) { .projects-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .projects-grid { grid-template-columns: 1fr; } }

/* ── Card ── */
.project-card {
    position: relative;
    overflow: hidden;
    border-radius: 1.25rem;
    border: 1px solid rgba(14, 165, 233, 0.12);
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(16px);
    display: flex;
    flex-direction: column;
    transition: transform 0.35s ease, border-color 0.35s ease,
                box-shadow 0.35s ease, background 0.35s ease;
    box-shadow: 0 2px 0 rgba(255,255,255,0.8);
}
:root.dark .project-card {
    background: rgba(15, 23, 42, 0.65);
    border-color: rgba(14, 165, 233, 0.1);
    box-shadow: inset 0 0 40px rgba(0,0,0,0.2);
}
.project-card:hover {
    transform: translateY(-6px);
    border-color: rgba(14, 165, 233, 0.35);
    background: rgba(255, 255, 255, 0.88);
    box-shadow: 0 20px 50px rgba(14, 165, 233, 0.1),
                0 0 0 1px rgba(14, 165, 233, 0.12);
}
:root.dark .project-card:hover {
    background: rgba(15, 23, 42, 0.9);
    box-shadow: inset 0 0 40px rgba(0,0,0,0.3),
                0 20px 50px rgba(0,0,0,0.3),
                0 0 0 1px rgba(14, 165, 233, 0.18);
}
.card-ambient {
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(14,165,233,0.15), transparent 70%);
    filter: blur(30px);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.4s ease;
}
.project-card:hover .card-ambient { opacity: 1; }

/* ── Image ── */
.card-img-wrap {
    position: relative;
    overflow: hidden;
    aspect-ratio: 16 / 10;
    border-radius: 1.1rem 1.1rem 0 0;
}
.card-img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease, filter 0.4s ease;
    filter: saturate(0.85) brightness(0.9);
}
.project-card:hover .card-img {
    transform: scale(1.06);
    filter: saturate(1) brightness(0.95);
}
.card-img-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 50%, rgba(2,6,23,0.5) 100%);
    pointer-events: none;
}

/* ── Skill pill ── */
.skill-pill {
    position: absolute;
    top: 0.65rem; left: 0.65rem;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.25rem 0.65rem;
    border-radius: 9999px;
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(14,165,233,0.2);
    font-size: 0.65rem;
    font-weight: 700;
    color: #0f172a;
}
:root.dark .skill-pill {
    background: rgba(15,23,42,0.85);
    color: #e0e7ff;
}
.skill-pill-img { width: 0.9rem; height: 0.9rem; object-fit: contain; }
.skill-pill-sep { opacity: 0.4; margin: 0 0.1rem; }

/* ── Visit btn: always visible on mobile ── */
.visit-btn {
    position: absolute;
    bottom: 0.65rem; right: 0.65rem;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.35rem 0.85rem;
    border-radius: 9999px;
    background: linear-gradient(135deg, #0ea5e9, #6366f1);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    text-decoration: none;
    opacity: 1;
    transform: translateY(0);
    transition: opacity 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 15px rgba(14,165,233,0.35);
}
.visit-btn svg { width: 0.8rem; height: 0.8rem; }
.visit-btn:hover { box-shadow: 0 6px 20px rgba(14,165,233,0.5); }

/* ── Visit btn: desktop — hidden by default, reveal on card hover ── */
@media (min-width: 769px) {
    .visit-btn {
        opacity: 0;
        transform: translateY(6px);
    }
    .project-card:hover .visit-btn {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ── Card body ── */
.card-body {
    padding: 1rem 1.25rem 1.25rem;
    position: relative; z-index: 1;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.card-title {
    font-family: 'Playfair', Georgia, serif;
    font-size: 1rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
    letter-spacing: -0.01em;
    transition: color 0.3s ease;
    line-height: 1.3;
}
:root.dark .card-title { color: #f1f5f9; }
.project-card:hover .card-title { color: #0ea5e9; }

/* ── Description: full on mobile, 3-line clamp + hover expand on desktop ── */
.card-desc {
    font-size: 0.78rem;
    line-height: 1.65;
    color: #64748b;
    margin: 0;
}
:root.dark .card-desc { color: #94a3b8; }

@media (min-width: 769px) {
    .card-desc {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }
    .project-card:hover .card-desc {
        display: block;
        overflow: visible;
    }
}

/* ── Bottom accent line ── */
.card-line {
    position: absolute;
    bottom: 0; left: 0;
    height: 2px; width: 0;
    background: linear-gradient(90deg, #0ea5e9, #6366f1, transparent);
    border-radius: 0 9999px 9999px 0;
    transition: width 0.45s ease;
}
.project-card:hover .card-line { width: 100%; }

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
.empty-state svg { width: 2.5rem; height: 2.5rem; opacity: 0.4; }
.empty-state p { font-size: 0.9rem; font-weight: 500; }
</style>