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
                <div v-for="snippet in snippets" :key="snippet.id" class="flex justify-between items-center gap-5 rounded-md">
                    <div class="flex items-center gap-5">
                        <div class="rounded-full">
                            <i :class="`devicon-${snippet.language}-plain`" class="text-2xl"></i>
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium text-sm leading-none">{{ snippet.title }}</p>
                            <p class="text-muted-foreground text-sm">{{ snippet.language }} - {{ snippet.views }} views</p>
                        </div>
                    </div>
                    <Link :href="route('snippets.show', { id: snippet.id })">
                        <Button variant="ghost" size="icon">
                            <Eye style="width: 25px; height: 25px;" />
                        </Button>
                    </Link>
                </div>
            </div>
        </CardContent>
    </Card>
</template>
