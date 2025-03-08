<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

defineProps<{
    title: string;
    value: number | string;
    description: string;
    icon: any;
}>();
</script>

<template>
    <Card>
        <CardHeader class="flex flex-row justify-between items-center space-y-0 pb-2">
            <CardTitle class="font-medium text-sm">{{ title }}</CardTitle>
            <component :is="icon" class="text-muted-foreground" />
        </CardHeader>
        <CardContent>
            <div class="font-bold text-2xl">{{ value }}</div>
            <p class="text-muted-foreground text-xs">{{ description }}</p>
        </CardContent>
    </Card>
</template>
