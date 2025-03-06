<!--
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
 -->
<script setup lang="ts">
import EngagementChart from '@/components/snippets/EngagementChart.vue';
import PopularSnippets from '@/components/snippets/PopularSnippets.vue';
import StatCard from '@/components/snippets/StatCard.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { Code, Eye, Heart } from 'lucide-vue-next';
import { computed } from 'vue';

const page = usePage();

// Define dashboard data interface
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

// const dashboardData = computed<DashboardData>(() => page.props.dashboardData || {});
const dashboardData = computed<DashboardData>(() => {
    const data = page.props.dashboardData as DashboardData | undefined;
    return data || {
        totalSnippets: 0,
        totalViews: 0,
        totalFavorites: 0,
        monthlyViews: {},
        popularSnippets: [],
    };
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
        <div class="flex flex-col flex-1 gap-4 p-4 rounded-xl h-full">
            <div class="gap-4 grid md:grid-cols-3 auto-rows-min">
                <StatCard
                    v-for="stat in stats"
                    :key="stat.title"
                    :title="stat.title"
                    :value="stat.value"
                    :description="stat.description"
                    :icon="stat.icon"
                />
            </div>

            <div class="flex-1 gap-5 grid grid-cols-1 md:grid-cols-3">
                <div class="relative col-span-1 md:col-span-2 dark:border-sidebar-border rounded-lg overflow-auto">
                    <EngagementChart title="Snippet Engagement" :chart-data="chartData" class="h-full" />
                </div>
                <div class="relative col-span-1 dark:border-sidebar-border rounded-lg h-full overflow-auto">
                    <PopularSnippets title="Your Top 10 Snippets" :snippets="popularSnippets" class="h-full" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
