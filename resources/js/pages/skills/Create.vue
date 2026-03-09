<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as skillsIndex, store as skillsStore } from '@/routes/skills';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Skills', href: skillsIndex().url },
    { title: 'Create Skill', href: '/skills/create' },
];

const form = useForm({
    name: '',
    image: null as File | null,
});

const handleImageChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) form.image = target.files[0];
};

const submit = () => {
    form.post(skillsStore().url, {
        forceFormData: true,
        onSuccess: () => {
            window.location.href = skillsIndex().url;
        },
    });
};
</script>

<template>
    <Head title="Create Skill" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex min-h-full flex-1 items-start justify-center px-4 py-12">
            <div class="w-full max-w-sm">

                <div class="mb-8">
                    <h1 class="text-xl font-medium tracking-tight text-foreground">New skill</h1>
                    <p class="mt-1 text-sm text-muted-foreground">Add a skill to your collection.</p>
                </div>

                <form @submit.prevent="submit" class="flex flex-col gap-5">

                    <div class="flex flex-col gap-1.5">
                        <Label for="name" class="text-sm font-medium text-foreground">Name</Label>
                        <Input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            autofocus
                            autocomplete="off"
                            placeholder="e.g. TypeScript"
                            class="h-9 text-sm text-foreground"
                        />
                        <InputError :message="form.errors.name" class="text-xs" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <Label for="image" class="text-sm font-medium text-foreground">Image</Label>
                        <Input
                            id="image"
                            type="file"
                            accept="image/*"
                            required
                            @change="handleImageChange"
                            class="h-9 text-sm file:text-xs file:font-medium cursor-pointer text-foreground"
                        />
                        <InputError :message="form.errors.image" class="text-xs" />
                    </div>

                    <div class="h-px bg-border" />

                    <div class="flex items-center gap-2">
                        <Button
                            type="submit"
                            :disabled="form.processing"
                            class="h-9 flex-1 text-sm font-medium"
                        >
                            {{ form.processing ? 'Creating…' : 'Create skill' }}
                        </Button>
                        <a
                            :href="skillsIndex().url"
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