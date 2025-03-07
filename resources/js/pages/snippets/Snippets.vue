<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { capitalize } from '@/lib/utils';
import { type BreadcrumbItem, type Snippet } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Heart } from 'lucide-vue-next';
defineProps<{
    snippets: {
        data: Array<Snippet>;
        meta: any;
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Snippets',
        href: '/snippets',
    },
];
</script>

<template>
    <Head title="Snippets" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div v-if="snippets.data.length > 0" class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                <Link
                    v-for="snippet in snippets.data"
                    :key="snippet.id"
                    :href="route('snippets.show', { id: snippet.id })"
                    class="transition-transform hover:-translate-y-1"
                >
                    <Card class="w-full">
                        <CardHeader>
                            <CardTitle>
                                <div class="flex items-center justify-between leading-8">
                                    <span class="mr-2 truncate">{{ snippet.title }}</span>
                                    <i :class="`devicon-${snippet.language}-plain`" class="flex-shrink-0 text-3xl"></i>
                                </div>
                            </CardTitle>
                            <CardDescription class="line-clamp-2 h-10">{{ snippet.description || 'No description provided' }}</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="flex items-center justify-between text-sm text-muted-foreground">
                                <Badge>{{ capitalize(snippet.language as string) }}</Badge>
                                <span class="ml-2 truncate">Creator: {{ snippet.user.name }}</span>
                            </div>
                            <div class="mt-2 flex justify-between text-xs text-muted-foreground">
                                <span class="mr-3">Views: {{ snippet.views_count }}</span>
                                <span class="flex items-center gap-2">
                                    <Heart :size="15" :class="{ 'fill-current': snippet.is_favorite }" />
                                    <span>Likes: {{ snippet.favorites_count }}</span>
                                </span>
                            </div>
                        </CardContent>
                    </Card>
                </Link>
            </div>
            <div v-else class="py-8 text-center">
                No snippets found
                <Link :href="route('snippets.create')" class="underline">Create one</Link>
            </div>
        </div>
    </AppLayout>
</template>
