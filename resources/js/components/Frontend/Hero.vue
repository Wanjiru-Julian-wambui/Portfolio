<script setup lang="ts">
import { ref, onMounted } from 'vue';

const roles = ['Junior Web Developer', 'Vue.js Enthusiast', 'Laravel Developer', 'React Builder', 'Node.js Developer'];
const currentRole = ref('');
const roleIndex = ref(0);
const charIndex = ref(0);
const isDeleting = ref(false);

const techStack = [
    {
        name: 'Vue.js',
        icon: `<svg viewBox="0 0 24 24" fill="#4FC08D" xmlns="http://www.w3.org/2000/svg"><path d="M24 1.61h-9.94L12 5.16 9.94 1.61H0l12 20.78ZM12 14.08 5.16 2.23H9.1L12 7.29l2.9-5.06h3.94Z"/></svg>`
    },
    {
        name: 'React',
        icon: `<svg viewBox="-11.5 -10.23174 23 20.46348" xmlns="http://www.w3.org/2000/svg"><circle cx="0" cy="0" r="2.05" fill="#61dafb"/><g stroke="#61dafb" stroke-width="1" fill="none"><ellipse rx="11" ry="4.2"/><ellipse rx="11" ry="4.2" transform="rotate(60)"/><ellipse rx="11" ry="4.2" transform="rotate(120)"/></g></svg>`
    },
    {
        name: 'Next.js',
        icon: `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M11.572 0c-.176 0-.31.001-.358.007a19.76 19.76 0 0 1-.364.033C7.443.346 4.25 2.185 2.228 5.012a11.875 11.875 0 0 0-2.119 5.243c-.096.659-.108.854-.108 1.747s.012 1.089.108 1.748c.652 4.506 3.86 8.292 8.209 9.695.779.25 1.6.422 2.534.525.363.04 1.935.04 2.299 0 1.611-.178 2.977-.577 4.323-1.264.207-.106.247-.134.219-.158-.02-.013-.9-1.193-1.955-2.62l-1.919-2.592-2.404-3.558a338.739 338.739 0 0 0-2.422-3.556c-.009-.002-.018 1.579-.023 3.51-.007 3.38-.01 3.515-.052 3.595a.426.426 0 0 1-.206.214c-.075.037-.14.044-.495.044H7.81l-.108-.068a.438.438 0 0 1-.157-.171l-.05-.106.006-4.703.007-4.705.072-.092a.645.645 0 0 1 .174-.143c.096-.047.134-.052.54-.052.479 0 .558.019.683.155a466.83 466.83 0 0 1 2.895 4.361c1.558 2.362 3.687 5.587 4.734 7.171l1.9 2.878.096-.063a12.317 12.317 0 0 0 2.465-2.163 11.944 11.944 0 0 0 2.824-6.134c.096-.66.108-.854.108-1.748 0-.893-.012-1.088-.108-1.747-.652-4.506-3.859-8.292-8.208-9.695a12.597 12.597 0 0 0-2.499-.523A33.119 33.119 0 0 0 11.573 0zm4.069 7.217c.347 0 .408.005.486.047a.473.473 0 0 1 .237.277c.018.06.023 1.365.018 4.304l-.006 4.218-.744-1.14-.746-1.14v-3.066c0-1.982.01-3.097.023-3.15a.478.478 0 0 1 .233-.296c.096-.05.13-.054.499-.054z" fill="currentColor"/></svg>`
    },
    {
        name: 'Laravel',
        icon: `<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" style="width:28px;height:28px" />`
    },
    {
        name: 'Node.js',
        icon: `<img src="https://cdn.simpleicons.org/nodedotjs/339933" style="width:28px;height:28px" />`
    },
    {
        name: 'TypeScript',
        icon: `<svg viewBox="0 0 24 24" fill="#3178C6" xmlns="http://www.w3.org/2000/svg"><path d="M0 12v12h24V0H0zm19.341-.956c.61.152 1.074.423 1.501.865.221.236.549.666.575.77.008.03-1.036.73-1.668 1.123-.023.015-.115-.084-.217-.236-.31-.45-.633-.644-1.128-.678-.728-.05-1.196.331-1.192.967a.88.88 0 0 0 .102.45c.16.331.458.53 1.39.933 1.719.74 2.454 1.227 2.911 1.92.51.773.625 2.008.278 2.926-.38.998-1.325 1.676-2.655 1.9-.411.073-1.386.062-1.828-.018-.964-.172-1.878-.648-2.442-1.273-.221-.243-.652-.88-.625-.925.011-.016.11-.077.22-.141.108-.061.511-.294.892-.515l.69-.4.145.214c.202.308.643.731.91.872.766.404 1.817.347 2.335-.118a.883.883 0 0 0 .313-.72c0-.278-.035-.4-.18-.61-.186-.266-.567-.49-1.649-.96-1.238-.533-1.771-.864-2.259-1.39a3.165 3.165 0 0 1-.659-1.2c-.091-.339-.114-1.189-.042-1.531.255-1.197 1.158-2.03 2.461-2.278.423-.08 1.406-.05 1.821.053zm-5.634 1.002l.008.983H10.59v8.876H8.38v-8.876H5.258v-.964c0-.534.011-.98.026-.99.012-.016 1.913-.024 4.217-.02l4.195.009z"/></svg>`
    },
];

onMounted(() => {
    typeLoop();
});

const typeLoop = () => {
    const role = roles[roleIndex.value];

    if (!isDeleting.value) {
        currentRole.value = role.slice(0, charIndex.value + 1);
        charIndex.value++;
        if (charIndex.value === role.length) {
            isDeleting.value = true;
            setTimeout(typeLoop, 1800);
            return;
        }
    } else {
        currentRole.value = role.slice(0, charIndex.value - 1);
        charIndex.value--;
        if (charIndex.value === 0) {
            isDeleting.value = false;
            roleIndex.value = (roleIndex.value + 1) % roles.length;
        }
    }

    setTimeout(typeLoop, isDeleting.value ? 60 : 100);
};
</script>

<template>
    <section id="home" class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden">

        <!-- Animated background -->
        <div class="bg-layer" aria-hidden="true">
            <div class="orb orb-1" />
            <div class="orb orb-2" />
            <div class="orb orb-3" />
            <div class="grid-lines" />
        </div>

        <!-- Floating particles -->
        <div class="particles" aria-hidden="true">
            <span v-for="n in 12" :key="n" class="particle" :style="`--n: ${n}`" />
        </div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col items-center text-center px-6 max-w-4xl mx-auto">

            <!-- Badge -->
            <div class="badge fade-up" style="--d: 0ms">
                <span class="badge-dot" />
                Ready to work
            </div>

            <!-- Headline -->
            <h1 class="headline fade-up" style="--d: 150ms">
                Hi, I'm <em class="name-italic">Julian Wambui</em> <span class="wave">👋</span>
            </h1>

            <!-- Typewriter role -->
            <div class="role-wrap fade-up" style="--d: 300ms">
                <span class="role-text">{{ currentRole }}</span>
                <span class="cursor">|</span>
            </div>

            <!-- Bio -->
            <p class="bio fade-up" style="--d: 450ms">
                I'm a junior developer who loves turning complex problems into simple,
                elegant solutions. From crafting responsive UIs to engineering backend APIs —
                I build with care, ship with confidence, and learn something new every single day.
            </p>

            <!-- Tech stack icon cards -->
            <div class="stack fade-up" style="--d: 550ms">
                <div v-for="tech in techStack" :key="tech.name" class="tech-card">
                    <span class="tech-icon" v-html="tech.icon" />
                    <span class="tech-name">{{ tech.name }}</span>
                </div>
            </div>

            <!-- CTA buttons -->
            <div class="ctas fade-up" style="--d: 650ms">
                <a href="#projects" class="btn-primary">
                    View Projects
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <a href="#contact" class="btn-secondary">Contact Me</a>
                <a href="/Resume.pdf" download class="btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download CV
                </a>
            </div>

            <!-- Scroll indicator -->
            <div class="scroll-indicator fade-up" style="--d: 800ms">
                <div class="scroll-mouse">
                    <div class="scroll-dot" />
                </div>
                <span>Scroll down</span>
            </div>

        </div>
    </section>
</template>

<style scoped>
/* ── Section ── */
.hero-section {
    background: #f8fafc;
    padding-top: 4rem;
}

:root.dark .hero-section {
    background: #020617;
}

/* ── Background orbs ── */
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

/* ── Grid overlay ── */
.grid-lines {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(14, 165, 233, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(14, 165, 233, 0.05) 1px, transparent 1px);
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

/* ── Fade up stagger ── */
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
    margin-bottom: 1.5rem;
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
    font-size: clamp(2.5rem, 7vw, 5rem);
    font-weight: 800;
    line-height: 1.1;
    color: #0f172a;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

:root.dark .headline { color: #f1f5f9; }

.name-gradient {
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

/* ── Waving hand ── */
.wave {
    display: inline-block;
    animation: wave 2s ease-in-out infinite;
    transform-origin: 70% 70%;
}

@keyframes wave {
    0%   { transform: rotate(0deg);   }
    10%  { transform: rotate(14deg);  }
    20%  { transform: rotate(-8deg);  }
    30%  { transform: rotate(14deg);  }
    40%  { transform: rotate(-4deg);  }
    50%  { transform: rotate(10deg);  }
    60%  { transform: rotate(0deg);   }
    100% { transform: rotate(0deg);   }
}

/* ── Name italic ── */
.name-italic {
    font-style: italic;
    background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 50%, #ec4899 100%);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shimmer 4s linear infinite;
}

/* ── Typewriter ── */
.role-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 2px;
    font-size: clamp(1.1rem, 3vw, 1.5rem);
    font-weight: 600;
    color: #475569;
    margin-bottom: 1.5rem;
    min-height: 2rem;
}

:root.dark .role-wrap { color: #94a3b8; }

.cursor {
    color: #0ea5e9;
    animation: blink 0.8s step-end infinite;
    font-weight: 300;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50%       { opacity: 0; }
}

/* ── Bio ── */
.bio {
    font-size: 1rem;
    line-height: 1.8;
    color: #64748b;
    max-width: 600px;
    margin-bottom: 2rem;
}

:root.dark .bio { color: #94a3b8; }

.bio strong {
    color: #0ea5e9;
    font-weight: 600;
}

/* ── Tech stack icon cards ── */
.stack {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.75rem;
    margin-bottom: 2.5rem;
}

.tech-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.4rem;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    border: 1px solid rgba(14, 165, 233, 0.15);
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(8px);
    transition: all 0.25s ease;
    cursor: default;
    min-width: 72px;
}

:root.dark .tech-card {
    background: rgba(15, 23, 42, 0.6);
    border-color: rgba(14, 165, 233, 0.15);
}

.tech-card:hover {
    transform: translateY(-4px);
    border-color: rgba(14, 165, 233, 0.5);
    box-shadow: 0 8px 24px rgba(14, 165, 233, 0.15);
    background: rgba(255, 255, 255, 0.9);
}

:root.dark .tech-card:hover {
    background: rgba(15, 23, 42, 0.9);
}

.tech-icon {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.tech-icon svg {
    width: 100%;
    height: 100%;
}

.tech-name {
    font-size: 0.7rem;
    font-weight: 600;
    color: #475569;
    letter-spacing: 0.02em;
    white-space: nowrap;
}

:root.dark .tech-name { color: #94a3b8; }

/* ── CTA Buttons ── */
.ctas {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.75rem;
    margin-bottom: 3.5rem;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.75rem;
    border-radius: 9999px;
    background: linear-gradient(135deg, #0ea5e9, #6366f1);
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    box-shadow: 0 4px 20px rgba(14, 165, 233, 0.35);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(14, 165, 233, 0.5);
}

.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.75rem;
    border-radius: 9999px;
    border: 1.5px solid rgba(14, 165, 233, 0.4);
    color: #0ea5e9;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    background: transparent;
}

.btn-secondary:hover {
    background: rgba(14, 165, 233, 0.08);
    border-color: #0ea5e9;
    transform: translateY(-2px);
}

.btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.75rem;
    border-radius: 9999px;
    border: 1.5px solid rgba(100, 116, 139, 0.3);
    color: #64748b;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    background: transparent;
}

.btn-ghost:hover {
    border-color: rgba(100, 116, 139, 0.6);
    color: #475569;
    transform: translateY(-2px);
}

:root.dark .btn-ghost { color: #94a3b8; border-color: rgba(148, 163, 184, 0.2); }
:root.dark .btn-ghost:hover { color: #e2e8f0; border-color: rgba(148, 163, 184, 0.4); }

/* ── Scroll indicator ── */
.scroll-indicator {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.7rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #94a3b8;
    animation: float-scroll 2s ease-in-out infinite;
}

.scroll-mouse {
    width: 22px; height: 34px;
    border: 2px solid rgba(148, 163, 184, 0.4);
    border-radius: 12px;
    display: flex;
    justify-content: center;
    padding-top: 5px;
}

.scroll-dot {
    width: 4px; height: 6px;
    background: #0ea5e9;
    border-radius: 9999px;
    animation: scroll-bounce 1.5s ease-in-out infinite;
}

@keyframes scroll-bounce {
    0%, 100% { transform: translateY(0); opacity: 1; }
    50%       { transform: translateY(8px); opacity: 0.3; }
}

@keyframes float-scroll {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(6px); }
}
</style>