<script setup lang="ts">
import axios from 'axios';
import { ref, reactive } from 'vue';

const form = reactive({ name: '', email: '', message: '' });
const status = ref<'idle' | 'sending' | 'sent' | 'error'>('idle');
const errors = reactive<Record<string, string>>({});

async function submit() {
    if (!form.name || !form.email || !form.message) return;
    status.value = 'sending';
    Object.keys(errors).forEach(k => delete errors[k]);

    try {
        await axios.post('/contact', form);
        status.value = 'sent';
    } catch (e: any) {
        status.value = 'idle';
        if (e.response?.status === 422) {
            const raw = e.response.data.errors as Record<string, string[]>;
            Object.entries(raw).forEach(([k, v]) => (errors[k] = v[0]));
        } else {
            status.value = 'error';
        }
    }
}
</script>

<template>
    <section id="contact" class="contact-section relative overflow-hidden">

        <!-- Background — identical to Hero, Promote & About -->
        <div class="bg-layer" aria-hidden="true">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
            <div class="grid-lines"></div>
        </div>

        <div class="particles" aria-hidden="true">
            <span v-for="n in 12" :key="n" class="particle" :style="`--n: ${n}`"></span>
        </div>

        <div class="relative z-10 max-w-3xl mx-auto px-6 py-24">

            <!-- Badge -->
            <div class="flex justify-center fade-up" style="--d: 0ms">
                <div class="badge">
                    <span class="badge-dot"></span>
                    Get In Touch
                </div>
            </div>

            <!-- Heading -->
            <div class="text-center mt-6 fade-up" style="--d: 100ms">
                <h2 class="headline">
                    Let's <em class="name-italic">Work Together</em>
                </h2>
            </div>

            <!-- Subtext -->
            <p class="subtext fade-up" style="--d: 200ms">
                Have a project in mind, a question, or just want to say hello?
                My inbox is always open — I'll get back to you as soon as possible.
            </p>

            <!-- Contact links -->
            <div class="contact-links fade-up" style="--d: 300ms">
                <a href="mailto:julianarsh26@gmail.com" class="contact-link">
                    <span class="link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </span>
                    <span class="link-text">julianarsh26@gmail.com</span>
                </a>
                <a href="https://github.com/Wanjiru-Julian-wambui" target="_blank" class="contact-link">
                    <span class="link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844a9.59 9.59 0 0 1 2.504.337c1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.02 10.02 0 0 0 22 12.017C22 6.484 17.522 2 12 2Z" />
                        </svg>
                    </span>
                    <span class="link-text">GitHub</span>
                </a>
            </div>

            <!-- OR divider -->
            <div class="or-divider fade-up" style="--d: 420ms">
                <span class="or-line"></span>
                <span class="or-text">or send a message</span>
                <span class="or-line"></span>
            </div>

            <!-- Form card -->
            <div class="form-card fade-up" style="--d: 500ms">
                <div class="form-ambient"></div>

                <!-- Success state -->
                <div v-if="status === 'sent'" class="success-state">
                    <div class="success-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <h3 class="success-title">Message Sent!</h3>
                    <p class="success-desc">Thanks for reaching out. I'll get back to you soon.</p>
                    <button class="reset-btn" @click="status = 'idle'; form.name = ''; form.email = ''; form.message = ''">
                        Send another
                    </button>
                </div>

                <!-- Form -->
                <template v-else>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <div class="input-wrap">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    class="form-input"
                                    :class="{ 'input-error': errors.name }"
                                    placeholder="Jane Doe"
                                    :disabled="status === 'sending'"
                                />
                            </div>
                            <span v-if="errors.name" class="field-error">{{ errors.name }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <div class="input-wrap">
                                <input
                                    v-model="form.email"
                                    type="email"
                                    class="form-input"
                                    :class="{ 'input-error': errors.email }"
                                    placeholder="hello@example.com"
                                    :disabled="status === 'sending'"
                                />
                            </div>
                            <span v-if="errors.email" class="field-error">{{ errors.email }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <div class="input-wrap">
                            <textarea
                                v-model="form.message"
                                class="form-input form-textarea"
                                :class="{ 'input-error': errors.message }"
                                placeholder="Tell me about your project..."
                                rows="5"
                                :disabled="status === 'sending'"
                            ></textarea>
                        </div>
                        <span v-if="errors.message" class="field-error">{{ errors.message }}</span>
                    </div>

                    <button
                        class="submit-btn"
                        :disabled="status === 'sending' || !form.name || !form.email || !form.message"
                        @click="submit"
                    >
                        <span v-if="status === 'sending'" class="btn-spinner"></span>
                        <span v-else-if="status === 'error'">Try Again</span>
                        <span v-else>Send Message</span>
                        <svg v-if="status !== 'sending'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </template>
            </div>

        </div>
    </section>
</template>

<style scoped>
/* ── Section ── */
.contact-section {
    background: #f8fafc;
}
:root.dark .contact-section { background: #020617; }

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

/* ── Contact links ── */
.contact-links {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.75rem;
    margin-top: 2rem;
}
.contact-link {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.6rem 1.25rem;
    border-radius: 9999px;
    border: 1px solid rgba(14, 165, 233, 0.15);
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(12px);
    font-size: 0.82rem;
    font-weight: 600;
    color: #475569;
    text-decoration: none;
    transition: transform 0.25s ease, border-color 0.25s ease,
                box-shadow 0.25s ease, background 0.25s ease, color 0.25s ease;
}
:root.dark .contact-link {
    background: rgba(15, 23, 42, 0.6);
    color: #94a3b8;
    border-color: rgba(14, 165, 233, 0.12);
}
.contact-link:hover {
    transform: translateY(-3px);
    border-color: rgba(14, 165, 233, 0.5);
    background: rgba(255, 255, 255, 0.9);
    color: #0ea5e9;
    box-shadow: 0 6px 20px rgba(14, 165, 233, 0.12);
}
:root.dark .contact-link:hover { background: rgba(15, 23, 42, 0.9); }
.link-icon {
    width: 1.1rem; height: 1.1rem;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.link-icon svg { width: 1.1rem; height: 1.1rem; }

/* ── OR divider ── */
.or-divider {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 2.5rem 0;
}
.or-line {
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(14,165,233,0.25), transparent);
}
.or-text {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #94a3b8;
    white-space: nowrap;
}

/* ── Form card ── */
.form-card {
    position: relative;
    overflow: hidden;
    padding: 2.25rem;
    border-radius: 1.5rem;
    border: 1px solid rgba(14, 165, 233, 0.12);
    background: rgba(255, 255, 255, 0.65);
    backdrop-filter: blur(20px);
    box-shadow: 0 4px 0 rgba(255,255,255,0.8),
                0 20px 60px rgba(14, 165, 233, 0.06);
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}
:root.dark .form-card {
    background: rgba(15, 23, 42, 0.7);
    border-color: rgba(14, 165, 233, 0.1);
    box-shadow: inset 0 0 60px rgba(0,0,0,0.2),
                0 20px 60px rgba(0,0,0,0.3);
}
.form-ambient {
    position: absolute;
    top: -80px; right: -80px;
    width: 280px; height: 280px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(14,165,233,0.12), rgba(99,102,241,0.08), transparent 70%);
    filter: blur(40px);
    pointer-events: none;
}

/* ── Form rows ── */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
}
@media (max-width: 540px) {
    .form-row { grid-template-columns: 1fr; }
}
.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.45rem;
    position: relative;
    z-index: 1;
}
.form-label {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #0ea5e9;
}

/* ── Inputs ── */
.input-wrap { position: relative; }
.form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    border: 1px solid rgba(14, 165, 233, 0.15);
    background: rgba(255, 255, 255, 0.7);
    color: #0f172a;
    font-size: 0.88rem;
    font-family: inherit;
    outline: none;
    transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
    resize: none;
    box-sizing: border-box;
}
:root.dark .form-input {
    background: rgba(15, 23, 42, 0.6);
    color: #f1f5f9;
    border-color: rgba(14, 165, 233, 0.12);
}
.form-input::placeholder { color: #94a3b8; }
.form-input:focus {
    border-color: rgba(14, 165, 233, 0.5);
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}
:root.dark .form-input:focus {
    background: rgba(15, 23, 42, 0.9);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.08);
}
.form-input:disabled { opacity: 0.6; cursor: not-allowed; }
.form-textarea { min-height: 130px; line-height: 1.6; }

/* ── Field errors ── */
.field-error {
    font-size: 0.72rem;
    color: #f43f5e;
    font-weight: 600;
    margin-top: 0.2rem;
    display: block;
}
.input-error {
    border-color: rgba(244, 63, 94, 0.5) !important;
    box-shadow: 0 0 0 3px rgba(244, 63, 94, 0.08) !important;
}

/* ── Submit button ── */
.submit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    padding: 0.9rem 2rem;
    border-radius: 9999px;
    border: none;
    background: linear-gradient(135deg, #0ea5e9, #6366f1);
    color: #fff;
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: 0.03em;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    align-self: flex-end;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    box-shadow: 0 4px 20px rgba(14, 165, 233, 0.35),
                inset 0 1px 0 rgba(255,255,255,0.2);
    z-index: 1;
}
.submit-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #6366f1, #ec4899);
    opacity: 0;
    transition: opacity 0.35s ease;
}
.submit-btn:hover:not(:disabled) {
    transform: translateY(-3px);
    box-shadow: 0 10px 35px rgba(14, 165, 233, 0.45);
}
.submit-btn:hover:not(:disabled)::before { opacity: 1; }
.submit-btn:disabled { opacity: 0.55; cursor: not-allowed; }
.submit-btn svg {
    width: 1.1rem; height: 1.1rem;
    position: relative; z-index: 1;
    transition: transform 0.25s ease;
}
.submit-btn:hover:not(:disabled) svg { transform: translateX(4px); }
.submit-btn span { position: relative; z-index: 1; }

/* ── Spinner ── */
.btn-spinner {
    width: 1rem; height: 1rem;
    border: 2px solid rgba(255,255,255,0.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
    position: relative; z-index: 1;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ── Success state ── */
.success-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    gap: 0.75rem;
    text-align: center;
}
.success-icon {
    width: 3.5rem; height: 3.5rem;
    border-radius: 50%;
    background: linear-gradient(135deg, #0ea5e9, #10b981);
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 0 30px rgba(14, 165, 233, 0.35);
    animation: pop 0.4s ease;
}
@keyframes pop {
    0%   { transform: scale(0); opacity: 0; }
    70%  { transform: scale(1.15); }
    100% { transform: scale(1); opacity: 1; }
}
.success-icon svg { width: 1.5rem; height: 1.5rem; color: #fff; }
.success-title {
    font-family: 'Playfair', Georgia, serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
:root.dark .success-title { color: #f1f5f9; }
.success-desc {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0;
}
:root.dark .success-desc { color: #94a3b8; }
.reset-btn {
    margin-top: 0.5rem;
    padding: 0.5rem 1.25rem;
    border-radius: 9999px;
    border: 1px solid rgba(14, 165, 233, 0.3);
    background: transparent;
    color: #0ea5e9;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease;
}
.reset-btn:hover {
    background: rgba(14, 165, 233, 0.08);
}
</style>