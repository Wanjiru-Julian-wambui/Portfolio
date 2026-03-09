<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import About from '@/components/Frontend/About.vue';
import Contact from '@/components/Frontend/Contact.vue';
import Hero from '@/components/Frontend/Hero.vue';
import Projects from '@/components/Frontend/Projects.vue';
import Promote from '@/components/Frontend/Promote.vue';
import Services from '@/components/Frontend/Services.vue';
import Skills from '@/components/Frontend/Skills.vue';
import FrontendLayout from '@/layouts/Frontend.vue';

defineProps<{
    skills: { id: number; name: string; image: string }[];
    projects: {
        id: number;
        name: string;
        description: string | null;
        image: string;
        project_url: string | null;
        skill_ids: number[];
        skills: { id: number; name: string; image: string }[];
    }[];
}>();
</script>

<template>
    <Head>
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <FrontendLayout>
        <Hero />
        <Promote />
        <About />
        <Skills :skills="skills" />
        <Projects :projects="projects" />
        <Services />
        <Contact />
    </FrontendLayout>
</template>