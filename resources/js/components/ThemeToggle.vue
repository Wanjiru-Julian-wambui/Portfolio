<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';

type Theme = 'light' | 'dark' | 'system';

const current = ref<Theme>('system');
const open = ref(false);
const dropdown = ref<HTMLElement | null>(null);

const applyTheme = (theme: Theme) => {
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else if (theme === 'light') {
        document.documentElement.classList.remove('dark');
    } else {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
};

onMounted(() => {
    const stored = localStorage.getItem('theme') as Theme | null;
    current.value = stored ?? 'system';
    applyTheme(current.value);
    document.addEventListener('mousedown', handleOutsideClick);
});

onBeforeUnmount(() => {
    document.removeEventListener('mousedown', handleOutsideClick);
});

const handleOutsideClick = (e: MouseEvent) => {
    if (dropdown.value && !dropdown.value.contains(e.target as Node)) {
        open.value = false;
    }
};

const select = (theme: Theme) => {
    current.value = theme;
    localStorage.setItem('theme', theme);
    applyTheme(theme);
    open.value = false;
};
</script>

<template>
    <div class="relative" ref="dropdown">
        <!-- Trigger button -->
        <button
            @click="open = !open"
            class="inline-flex h-7 w-7 items-center justify-center rounded-md text-muted-foreground transition-colors hover:text-foreground hover:bg-accent"
            aria-label="Toggle theme"
        >
            <!-- Light -->
            <svg v-if="current === 'light'" width="15" height="15" viewBox="0 0 16 16" fill="none">
                <circle cx="8" cy="8" r="3.5" fill="currentColor"/>
                <circle cx="8" cy="1.5" r="1" fill="currentColor"/>
                <circle cx="8" cy="14.5" r="1" fill="currentColor"/>
                <circle cx="1.5" cy="8" r="1" fill="currentColor"/>
                <circle cx="14.5" cy="8" r="1" fill="currentColor"/>
                <circle cx="3.4" cy="3.4" r="1" fill="currentColor"/>
                <circle cx="12.6" cy="12.6" r="1" fill="currentColor"/>
                <circle cx="12.6" cy="3.4" r="1" fill="currentColor"/>
                <circle cx="3.4" cy="12.6" r="1" fill="currentColor"/>
            </svg>
            <!-- Dark -->
            <svg v-else-if="current === 'dark'" width="15" height="15" viewBox="0 0 16 16" fill="none">
                <path d="M13 8.5A5.5 5.5 0 0 1 7.5 3c0-.34.03-.67.09-1A5.5 5.5 0 1 0 14 9.91 5.52 5.52 0 0 1 13 8.5Z" fill="currentColor"/>
            </svg>
            <!-- System -->
            <svg v-else width="15" height="15" viewBox="0 0 16 16" fill="none">
                <circle cx="8" cy="8" r="5.5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M8 2.5A5.5 5.5 0 0 1 8 13.5V2.5Z" fill="currentColor"/>
            </svg>
        </button>

        <!-- Dropdown -->
        <Transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="opacity-0 translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-1"
        >
            <div
                v-if="open"
                class="absolute right-0 mt-1 w-28 origin-top-right rounded-lg border border-border bg-popover shadow-lg z-50 overflow-hidden p-1"
            >
                <button
                    v-for="option in ([{ value: 'light', label: 'Light' }, { value: 'dark', label: 'Dark' }, { value: 'system', label: 'System' }] as const)"
                    :key="option.value"
                    @click="select(option.value)"
                    class="flex w-full items-center gap-2 rounded-md px-2 py-1.5 text-xs transition-colors hover:bg-accent"
                    :class="current === option.value ? 'text-foreground font-medium' : 'text-muted-foreground'"
                >
                    <svg v-if="option.value === 'light'" width="11" height="11" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="8" r="3.5" fill="currentColor"/>
                        <circle cx="8" cy="1.5" r="1" fill="currentColor"/>
                        <circle cx="8" cy="14.5" r="1" fill="currentColor"/>
                        <circle cx="1.5" cy="8" r="1" fill="currentColor"/>
                        <circle cx="14.5" cy="8" r="1" fill="currentColor"/>
                        <circle cx="3.4" cy="3.4" r="1" fill="currentColor"/>
                        <circle cx="12.6" cy="12.6" r="1" fill="currentColor"/>
                        <circle cx="12.6" cy="3.4" r="1" fill="currentColor"/>
                        <circle cx="3.4" cy="12.6" r="1" fill="currentColor"/>
                    </svg>
                    <svg v-else-if="option.value === 'dark'" width="11" height="11" viewBox="0 0 16 16" fill="none">
                        <path d="M13 8.5A5.5 5.5 0 0 1 7.5 3c0-.34.03-.67.09-1A5.5 5.5 0 1 0 14 9.91 5.52 5.52 0 0 1 13 8.5Z" fill="currentColor"/>
                    </svg>
                    <svg v-else width="11" height="11" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="8" r="5.5" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M8 2.5A5.5 5.5 0 0 1 8 13.5V2.5Z" fill="currentColor"/>
                    </svg>
                    {{ option.label }}
                    <span v-if="current === option.value" class="ml-auto">·</span>
                </button>
            </div>
        </Transition>
    </div>
</template>