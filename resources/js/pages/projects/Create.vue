<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as projectsIndex } from '@/routes/projects';
import type { BreadcrumbItem } from '@/types';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

interface Skill {
    id: number;
    name: string;
    image: string;
}

defineProps<{
    skills: Skill[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Projects',
        href: projectsIndex().url,
    },
    {
        title: 'Create Project',
        href: '/projects/create',
    },
];

const form = useForm({
    name: '',
    skill_id: '',
    image: null as File | null,
    project_url: '',
});

const handleImageChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) {
        form.image = target.files[0];
    }
};

const submit = () => {
    form.post('/projects', {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Create Project" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex min-h-full flex-1 items-start justify-center px-4 py-12">
            <div class="w-full max-w-sm">

                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-xl font-medium tracking-tight text-foreground">New project</h1>
                    <p class="mt-1 text-sm text-muted-foreground">Add a project to your portfolio.</p>
                </div>

                <!-- Form -->
                <form @submit.prevent="submit" class="flex flex-col gap-5">

                    <!-- Name -->
                    <div class="flex flex-col gap-1.5">
                        <Label for="name" class="text-sm font-medium text-foreground">Name</Label>
                        <Input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            autofocus
                            autocomplete="off"
                            placeholder="e.g. Portfolio Website"
                            class="h-9 text-sm text-foreground"
                        />
                        <InputError :message="form.errors.name" class="text-xs" />
                    </div>

                    <!-- Skill -->
                    <div class="flex flex-col gap-1.5">
                        <Label for="skill_id" class="text-sm font-medium text-foreground">Skill</Label>
                        <select
                            id="skill_id"
                            v-model="form.skill_id"
                            required
                            class="h-9 w-full rounded-md border border-input bg-background px-3 text-sm text-foreground shadow-sm focus:outline-none focus:ring-1 focus:ring-ring"
                        >
                            <option value="" disabled>Select a skill</option>
                            <option v-for="skill in skills" :key="skill.id" :value="skill.id">
                                {{ skill.name }}
                            </option>
                        </select>
                        <InputError :message="form.errors.skill_id" class="text-xs" />
                    </div>

                    <!-- Image -->
                    <div class="flex flex-col gap-1.5">
                        <Label for="image" class="text-sm font-medium text-foreground">Image</Label>
                        <Input
                            id="image"
                            type="file"
                            accept="image/*"
                            @change="handleImageChange"
                            class="h-9 text-sm file:text-xs file:font-medium cursor-pointer text-foreground"
                        />
                        <InputError :message="form.errors.image" class="text-xs" />
                    </div>

                    <!-- Project URL -->
                    <div class="flex flex-col gap-1.5">
                        <Label for="project_url" class="text-sm font-medium text-foreground">
                            Project URL
                            <span class="ml-1 text-xs font-normal text-muted-foreground">(Required)</span>
                        </Label>
                        <Input
                            id="project_url"
                            v-model="form.project_url"
                            type="url"
                            required
                            autocomplete="off"
                            placeholder="https://example.com"
                            class="h-9 text-sm text-foreground"
                        />
                        <InputError :message="form.errors.project_url" class="text-xs" />
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-border" />

                    <!-- Actions -->
                    <div class="flex items-center gap-2">
                        <Button
                            type="submit"
                            :disabled="form.processing"
                            class="h-9 flex-1 text-sm font-medium"
                        >
                            {{ form.processing ? 'Creating…' : 'Create project' }}
                        </Button>
                        <Link
                            :href="projectsIndex().url"
                            class="inline-flex h-9 items-center rounded-md border border-border px-4 text-sm text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"
                        >
                            Cancel
                        </Link>
                    </div>

                </form>
            </div>
        </div>
    </AppLayout>
</template>