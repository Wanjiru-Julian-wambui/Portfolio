<script setup lang="ts">
import FrontendLayout from '@/layouts/Frontend.vue';
import { Head } from '@inertiajs/vue3';
import Hero from '@/components/Frontend/Hero.vue';
import Promote from '@/components/Frontend/Promote.vue';
import About from '@/components/Frontend/About.vue';
</script>

<template>
    <Head >
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <FrontendLayout>
        <Hero />
        <Promote />
        <About />
        <!-- Skills tail-100 -->
        <!-- Portfolio Primary -->
        <!-- Services Secondary -->
        <!-- Contact Primary -->
    </FrontendLayout>
</template>