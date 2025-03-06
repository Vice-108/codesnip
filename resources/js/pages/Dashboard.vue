<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 gap-4 p-4 rounded-xl h-full">
            <div class="gap-4 grid md:grid-cols-3 auto-rows-min">
                <div class="relative border border-sidebar-border/70 dark:border-sidebar-border rounded-xl aspect-video overflow-hidden">
                    <PlaceholderPattern />
                </div>
                <div class="relative border border-sidebar-border/70 dark:border-sidebar-border rounded-xl aspect-video overflow-hidden">
                    <PlaceholderPattern />
                </div>
                <div class="relative border border-sidebar-border/70 dark:border-sidebar-border rounded-xl aspect-video overflow-hidden">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative flex-1 border border-sidebar-border/70 dark:border-sidebar-border rounded-xl min-h-[100vh] md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
