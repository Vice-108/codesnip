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
        <CardContent class="flex-1 mt-10">
            <AreaChart :data="chartData" index="name" :categories="['views']" class="w-full" />
        </CardContent>
    </Card>
</template>
