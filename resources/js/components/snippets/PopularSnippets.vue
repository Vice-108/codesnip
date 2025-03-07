<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Link } from '@inertiajs/vue3';
import { Eye } from 'lucide-vue-next';

defineProps<{
    title: string;
    snippets: Array<{
        id: number;
        title: string;
        language: string;
        views: number;
    }>;
}>();
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle>{{ title }}</CardTitle>
        </CardHeader>
        <CardContent>
            <div class="space-y-2 overflow-y-auto">
                <div v-for="snippet in snippets" :key="snippet.id" class="flex items-center justify-between gap-5 rounded-md px-4">
                    <div class="flex items-center gap-5">
                        <div class="rounded-full">
                            <i :class="`devicon-${snippet.language}-plain`" class="text-2xl"></i>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium leading-none">{{ snippet.title }}</p>
                            <p class="text-sm text-muted-foreground">{{ snippet.language }} - {{ snippet.views }} views</p>
                        </div>
                    </div>
                    <Link :href="route('snippets.show', { id: snippet.id })">
                        <Button variant="ghost" size="icon">
                            <Eye class="h-4 w-4" />
                        </Button>
                    </Link>
                </div>
            </div>
        </CardContent>
    </Card>
</template>
