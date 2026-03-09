<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as projectsIndex, store as projectsStore } from '@/routes/projects';
import type { BreadcrumbItem } from '@/types';

interface Skill {
    id: number;
    name: string;
    image: string;
}

defineProps<{
    skills: Skill[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Projects', href: projectsIndex().url },
    { title: 'Create Project', href: '/projects/create' },
];

const form = useForm({
    name: '',
    description: '',
    skill_ids: [] as number[],
    image: null as File | null,
    project_url: '',
});

const handleImageChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) form.image = target.files[0];
};

const toggleSkill = (id: number) => {
    const idx = form.skill_ids.indexOf(id);
    if (idx === -1) form.skill_ids.push(id);
    else form.skill_ids.splice(idx, 1);
};

const isSelected = (id: number) => form.skill_ids.includes(id);

const submit = () => {
    form.post(projectsStore().url, {
        forceFormData: true,
        onSuccess: () => {
            window.location.href = projectsIndex().url;
        },
    });
};
</script>

<template>
    <Head title="Create Project" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex min-h-full flex-1 items-start justify-center px-4 py-12">
            <div class="w-full max-w-sm">

                <div class="mb-8">
                    <h1 class="text-xl font-medium tracking-tight text-foreground">New project</h1>
                    <p class="mt-1 text-sm text-muted-foreground">Add a project to your portfolio.</p>
                </div>

                <form @submit.prevent="submit" class="flex flex-col gap-5">

                    <!-- Name -->
                    <div class="flex flex-col gap-1.5">
                        <Label for="name" class="text-sm font-medium text-foreground">Name</Label>
                        <Input id="name" v-model="form.name" type="text" required autofocus autocomplete="off" placeholder="e.g. Portfolio Website" class="h-9 text-sm text-foreground" />
                        <InputError :message="form.errors.name" class="text-xs" />
                    </div>

                    <!-- Description -->
                    <div class="flex flex-col gap-1.5">
                        <Label for="description" class="text-sm font-medium text-foreground">
                            Description <span class="ml-1 text-xs font-normal text-muted-foreground">(optional)</span>
                        </Label>
                        <textarea id="description" v-model="form.description" rows="3" placeholder="Brief description of the project..."
                            class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm text-foreground shadow-sm focus:outline-none focus:ring-1 focus:ring-ring resize-none"></textarea>
                        <InputError :message="form.errors.description" class="text-xs" />
                    </div>

                    <!-- Skills (multi-select) -->
                    <div class="flex flex-col gap-1.5">
                        <Label class="text-sm font-medium text-foreground">
                            Skills <span class="ml-1 text-xs font-normal text-muted-foreground">(select one or more)</span>
                        </Label>
                        <div class="flex flex-wrap gap-2">
                            <button
                                v-for="skill in skills"
                                :key="skill.id"
                                type="button"
                                @click="toggleSkill(skill.id)"
                                :class="[
                                    'inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-medium transition-all',
                                    isSelected(skill.id)
                                        ? 'border-primary bg-primary/10 text-primary'
                                        : 'border-border bg-background text-muted-foreground hover:border-primary/50 hover:text-foreground'
                                ]"
                            >
                                <img :src="skill.image" :alt="skill.name" class="h-3.5 w-3.5 object-contain" />
                                {{ skill.name }}
                                <svg v-if="isSelected(skill.id)" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-muted-foreground">
                            {{ form.skill_ids.length === 0 ? 'No skills selected' : `${form.skill_ids.length} skill${form.skill_ids.length > 1 ? 's' : ''} selected` }}
                        </p>
                        <InputError :message="form.errors.skill_ids" class="text-xs" />
                    </div>

                    <!-- Image -->
                    <div class="flex flex-col gap-1.5">
                        <Label for="image" class="text-sm font-medium text-foreground">Image</Label>
                        <Input id="image" type="file" accept="image/*" required @change="handleImageChange" class="h-9 text-sm file:text-xs file:font-medium cursor-pointer text-foreground" />
                        <InputError :message="form.errors.image" class="text-xs" />
                    </div>

                    <!-- Project URL -->
                    <div class="flex flex-col gap-1.5">
                        <Label for="project_url" class="text-sm font-medium text-foreground">Project URL</Label>
                        <Input id="project_url" v-model="form.project_url" type="url" required autocomplete="off" placeholder="https://example.com" class="h-9 text-sm text-foreground" />
                        <InputError :message="form.errors.project_url" class="text-xs" />
                    </div>

                    <div class="h-px bg-border" />

                    <div class="flex items-center gap-2">
                        <Button type="submit" :disabled="form.processing || form.skill_ids.length === 0" class="h-9 flex-1 text-sm font-medium">
                            {{ form.processing ? 'Creating…' : 'Create project' }}
                        </Button>
                        <a
                            :href="projectsIndex().url"
                            class="inline-flex h-9 items-center rounded-md border border-border px-4 text-sm text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"
                        >
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </AppLayout>
</template>