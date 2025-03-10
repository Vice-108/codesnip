<script setup lang="ts">
import EngagementChart from '@/components/snippets/EngagementChart.vue';
import PopularSnippets from '@/components/snippets/PopularSnippets.vue';
import StatCard from '@/components/snippets/StatCard.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { Code, Eye, Heart } from 'lucide-vue-next';
import { computed } from 'vue';

// Get page props to debug what we're receiving
const page = usePage();

interface DashboardData {
    totalSnippets: number;
    totalViews: number;
    totalFavorites: number;
    monthlyViews: Record<string, number>;
    popularSnippets: Array<{
        id: number;
        title: string;
        views: number;
        language: string;
    }>;
}

// Define default empty data that matches the interface
const emptyDashboardData: DashboardData = {
    totalSnippets: 0,
    totalViews: 0,
    totalFavorites: 0,
    monthlyViews: {},
    popularSnippets: [],
};

// Access the dashboardData directly from page props with proper typing
const dashboardData = computed<DashboardData>(() => {
    return (page.props.dashboardData as DashboardData) || emptyDashboardData;
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

// Stats cards data
const stats = [
    {
        title: 'Total Snippets',
        value: dashboardData.value.totalSnippets || 0,
        description: 'Code snippets created',
        icon: Code,
    },
    {
        title: 'Total Views',
        value: dashboardData.value.totalViews || 0,
        description: 'Views across all snippets',
        icon: Eye,
    },
    {
        title: 'Total Favorites',
        value: dashboardData.value.totalFavorites || 0,
        description: 'Favorites received',
        icon: Heart,
    },
];

// Format chart data from backend
const chartData = computed(() => {
    if (!dashboardData.value.monthlyViews) return [];

    return Object.entries(dashboardData.value.monthlyViews).map(([month, views]) => ({
        name: month,
        views: views as number,
    }));
});

// Get popular snippets from backend
const popularSnippets = computed(() => dashboardData.value.popularSnippets || []);
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <StatCard
                    v-for="stat in stats"
                    :key="stat.title"
                    :title="stat.title"
                    :value="stat.value"
                    :description="stat.description"
                    :icon="stat.icon"
                />
            </div>

            <div class="grid flex-1 grid-cols-1 gap-5 lg:grid-cols-3">
                <div class="relative col-span-1 overflow-auto rounded-lg dark:border-sidebar-border lg:col-span-2">
                    <EngagementChart title="Snippet Engagement" :chart-data="chartData" class="h-full" />
                </div>
                <div class="relative col-span-1 h-full overflow-auto rounded-lg dark:border-sidebar-border">
                    <PopularSnippets title="Your Top 10 Snippets" :snippets="popularSnippets" class="h-full" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
