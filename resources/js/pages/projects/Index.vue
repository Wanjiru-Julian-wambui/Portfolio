<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as projectsIndex } from '@/routes/projects';
import type { BreadcrumbItem } from '@/types';
import { ref } from 'vue';

interface Skill {
    id: number;
    name: string;
    image: string;
}

interface Project {
    id: number;
    name: string;
    image: string;
    project_url: string | null;
    skill_id: number;
    skill: Skill;
}

defineProps<{
    projects: Project[];
    skills: Skill[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Projects',
        href: projectsIndex().url,
    },
];

// ── Delete ────────────────────────────────────────────────
const projectToDelete = ref<Project | null>(null);

const confirmDelete = (project: Project) => {
    projectToDelete.value = project;
};

const cancelDelete = () => {
    projectToDelete.value = null;
};

const deleteProject = () => {
    if (!projectToDelete.value) return;
    router.delete(`/projects/${projectToDelete.value.id}`, {
        onFinish: () => {
            projectToDelete.value = null;
        },
    });
};

// ── Edit ──────────────────────────────────────────────────
const projectToEdit = ref<Project | null>(null);

const editForm = useForm({
    name: '',
    skill_id: '',
    project_url: '',
    image: null as File | null,
    _method: 'PUT',
});

const openEdit = (project: Project) => {
    projectToEdit.value = project;
    editForm.name        = project.name;
    editForm.skill_id    = String(project.skill_id);
    editForm.project_url = project.project_url ?? '';
    editForm.image       = null;
};

const cancelEdit = () => {
    projectToEdit.value = null;
    editForm.reset();
};

const handleEditImage = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files?.[0]) {
        editForm.image = target.files[0];
    }
};

const submitEdit = () => {
    if (!projectToEdit.value) return;
    editForm.post(`/projects/${projectToEdit.value.id}`, {
        forceFormData: true,
        onSuccess: () => {
            projectToEdit.value = null;
        },
    });
};
</script>

<template>
    <Head title="Projects" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex min-h-full flex-1 flex-col gap-4 px-4 py-8">

            <!-- Page header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-medium tracking-tight text-foreground">Projects</h1>
                    <p class="mt-0.5 text-sm text-muted-foreground">Manage your projects.</p>
                </div>
                <Link
                    href="/projects/create"
                    class="inline-flex h-9 items-center gap-1.5 rounded-md bg-primary px-4 text-sm font-medium text-primary-foreground transition-opacity hover:opacity-90"
                >
                    <span class="text-base leading-none">+</span>
                    <span class="hidden sm:inline">New project</span>
                    <span class="sm:hidden">New</span>
                </Link>
            </div>

            <!-- Divider -->
            <div class="h-px bg-border" />

            <!-- Empty state -->
            <div v-if="projects.length === 0" class="flex-1 rounded-lg border border-border bg-card p-6 text-sm text-muted-foreground">
                No projects added yet.
            </div>

            <!-- List view -->
            <div v-else class="rounded-lg border border-border bg-card divide-y divide-border overflow-hidden">
                <div
                    v-for="(project, index) in projects"
                    :key="project.id"
                    class="flex items-center gap-3 px-3 py-3 sm:gap-4 sm:px-4 hover:bg-accent/40 transition-colors"
                >
                    <!-- Row number -->
                    <span class="w-4 shrink-0 text-xs text-muted-foreground text-right">{{ index + 1 }}</span>

                    <!-- Project image -->
                    <div class="flex h-9 w-9 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-md border border-border bg-background p-1.5 overflow-hidden">
                        <img
                            :src="project.image"
                            :alt="project.name"
                            class="h-full w-full object-cover rounded"
                            @error="(e: Event) => {
                                const img = e.target as HTMLImageElement;
                                img.src = 'https://placehold.co/40x40?text=' + project.name.charAt(0);
                            }"
                        />
                    </div>

                    <!-- Name & skill -->
                    <div class="flex flex-1 flex-col gap-0.5 min-w-0">
                        <span class="text-sm font-medium text-foreground truncate">{{ project.name }}</span>
                        <div class="flex items-center gap-1.5">
                            <img
                                :src="project.skill.image"
                                :alt="project.skill.name"
                                class="h-3.5 w-3.5 object-contain shrink-0"
                            />
                            <span class="text-xs text-muted-foreground truncate">{{ project.skill.name }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-1.5 shrink-0">

                        <!-- Visit -->
                        <a
                            v-if="project.project_url"
                            :href="project.project_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex h-8 w-8 sm:w-auto sm:px-3 sm:gap-1.5 items-center justify-center rounded-md border border-border text-xs font-medium text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                                <polyline points="15 3 21 3 21 9" />
                                <line x1="10" y1="14" x2="21" y2="3" />
                            </svg>
                            <span class="hidden sm:inline">Visit</span>
                        </a>

                        <!-- Edit -->
                        <button
                            @click="openEdit(project)"
                            class="inline-flex h-8 w-8 sm:w-auto sm:px-3 sm:gap-1.5 items-center justify-center rounded-md border border-border text-xs font-medium text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            <span class="hidden sm:inline">Edit</span>
                        </button>

                        <!-- Delete -->
                        <button
                            @click="confirmDelete(project)"
                            class="inline-flex h-8 w-8 sm:w-auto sm:px-3 sm:gap-1.5 items-center justify-center rounded-md border border-border text-xs font-medium text-muted-foreground transition-colors hover:border-destructive hover:bg-destructive/10 hover:text-destructive"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6" />
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                <path d="M10 11v6" />
                                <path d="M14 11v6" />
                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                            </svg>
                            <span class="hidden sm:inline">Delete</span>
                        </button>

                    </div>
                </div>
            </div>

        </div>

        <!-- ── Edit Dialog ─────────────────────────────────────── -->
        <Teleport to="body">
            <div
                v-if="projectToEdit"
                class="fixed inset-0 z-50 flex items-center justify-center p-4"
            >
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="cancelEdit" />

                <div class="relative z-10 w-full max-w-sm rounded-xl border border-border bg-card p-6 shadow-xl">
                    <h2 class="text-base font-semibold text-foreground">Edit project</h2>
                    <p class="mt-1 text-sm text-muted-foreground">Update the details for <span class="font-medium text-foreground">{{ projectToEdit.name }}</span>.</p>

                    <form @submit.prevent="submitEdit" class="mt-5 flex flex-col gap-4">

                        <!-- Name -->
                        <div class="flex flex-col gap-1.5">
                            <label for="edit-name" class="text-sm font-medium text-foreground">Name</label>
                            <input
                                id="edit-name"
                                v-model="editForm.name"
                                type="text"
                                required
                                autocomplete="off"
                                placeholder="e.g. Portfolio Website"
                                class="h-9 w-full rounded-md border border-input bg-background px-3 text-sm text-foreground shadow-sm focus:outline-none focus:ring-1 focus:ring-ring"
                            />
                            <span v-if="editForm.errors.name" class="text-xs text-destructive">{{ editForm.errors.name }}</span>
                        </div>

                        <!-- Skill -->
                        <div class="flex flex-col gap-1.5">
                            <label for="edit-skill" class="text-sm font-medium text-foreground">Skill</label>
                            <select
                                id="edit-skill"
                                v-model="editForm.skill_id"
                                required
                                class="h-9 w-full rounded-md border border-input bg-background px-3 text-sm text-foreground shadow-sm focus:outline-none focus:ring-1 focus:ring-ring"
                            >
                                <option value="" disabled>Select a skill</option>
                                <option v-for="skill in skills" :key="skill.id" :value="String(skill.id)">
                                    {{ skill.name }}
                                </option>
                            </select>
                            <span v-if="editForm.errors.skill_id" class="text-xs text-destructive">{{ editForm.errors.skill_id }}</span>
                        </div>

                        <!-- Image -->
                        <div class="flex flex-col gap-1.5">
                            <label for="edit-image" class="text-sm font-medium text-foreground">Image <span class="text-xs font-normal text-muted-foreground">(leave blank to keep current)</span></label>
                            <div class="flex items-center gap-3 rounded-md border border-border bg-background p-2">
                                <img
                                    :src="projectToEdit.image"
                                    :alt="projectToEdit.name"
                                    class="h-8 w-8 rounded object-cover shrink-0"
                                />
                                <input
                                    id="edit-image"
                                    type="file"
                                    accept="image/*"
                                    @change="handleEditImage"
                                    class="text-xs text-foreground file:mr-2 file:text-xs file:font-medium cursor-pointer"
                                />
                            </div>
                            <span v-if="editForm.errors.image" class="text-xs text-destructive">{{ editForm.errors.image }}</span>
                        </div>

                        <!-- Project URL -->
                        <div class="flex flex-col gap-1.5">
                            <label for="edit-url" class="text-sm font-medium text-foreground">Project URL</label>
                            <input
                                id="edit-url"
                                v-model="editForm.project_url"
                                type="url"
                                required
                                autocomplete="off"
                                placeholder="https://example.com"
                                class="h-9 w-full rounded-md border border-input bg-background px-3 text-sm text-foreground shadow-sm focus:outline-none focus:ring-1 focus:ring-ring"
                            />
                            <span v-if="editForm.errors.project_url" class="text-xs text-destructive">{{ editForm.errors.project_url }}</span>
                        </div>

                        <div class="h-px bg-border" />

                        <div class="flex items-center justify-end gap-2">
                            <button
                                type="button"
                                @click="cancelEdit"
                                class="inline-flex h-9 items-center rounded-md border border-border px-4 text-sm text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                :disabled="editForm.processing"
                                class="inline-flex h-9 items-center rounded-md bg-primary px-4 text-sm font-medium text-primary-foreground transition-opacity hover:opacity-90 disabled:opacity-50"
                            >
                                {{ editForm.processing ? 'Saving…' : 'Save changes' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </Teleport>

        <!-- ── Delete Dialog ───────────────────────────────────── -->
        <Teleport to="body">
            <div
                v-if="projectToDelete"
                class="fixed inset-0 z-50 flex items-center justify-center p-4"
            >
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="cancelDelete" />

                <div class="relative z-10 w-full max-w-sm rounded-xl border border-border bg-card p-6 shadow-xl">
                    <h2 class="text-base font-semibold text-foreground">Delete project</h2>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Are you sure you want to delete
                        <span class="font-medium text-foreground">{{ projectToDelete.name }}</span>?
                        This action cannot be undone.
                    </p>

                    <div class="mt-6 flex items-center justify-end gap-2">
                        <button
                            @click="cancelDelete"
                            class="inline-flex h-9 items-center rounded-md border border-border px-4 text-sm text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"
                        >
                            Cancel
                        </button>
                        <button
                            @click="deleteProject"
                            class="inline-flex h-9 items-center rounded-md bg-destructive px-4 text-sm font-medium text-destructive-foreground transition-opacity hover:opacity-90"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </Teleport>

    </AppLayout>
</template>