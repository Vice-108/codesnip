<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { AreaChart } from '@/components/ui/chart-area';

defineProps<{
    title: string;
    chartData: {
        name: string;
        views: number;
    }[];
}>();
</script>

<template>
    <Card class="flex flex-col">
        <CardHeader>
            <CardTitle>{{ title }}</CardTitle>
        </CardHeader>
        <CardContent class="mt-10 flex-1">
            <AreaChart v-if="chartData.length" :data="chartData" index="name" :categories="['views']" class="w-full" />
            <div v-else class="flex h-40 items-center justify-center text-gray-500">No data available</div>
        </CardContent>
    </Card>
</template>
