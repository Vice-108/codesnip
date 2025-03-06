<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
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
        <div class="p-4 container">
            <div v-if="snippets.data.length > 0" class="gap-4 grid md:grid-cols-3">
                <Link
                    v-for="snippet in snippets.data"
                    :key="snippet.id"
                    :href="route('snippets.show', { id: snippet.id })"
                    class="transition-transform hover:-translate-y-1"
                >
                    <Card class="h-full">
                        <CardHeader>
                            <CardTitle>
                                <div class="flex justify-between">
                                    {{ snippet.title }}
                                    <i :class="`devicon-${snippet.language}-plain colored`" class="text-3xl"></i>
                                </div>
                            </CardTitle>
                            <CardDescription class="line-clamp-2">{{ snippet.description }}</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="flex justify-between items-center text-muted-foreground text-sm">
                                <Badge>{{ snippet.language }}</Badge>
                                <span>Creator: {{ snippet.user.name }}</span>
                            </div>
                            <div class="flex justify-between mt-2 text-muted-foreground text-xs">
                                <span class="mr-3">Views: {{ snippet.views_count }}</span>
                                <span class="flex gap-2">
                                    <Heart :size="15" :class="{ 'fill-current': snippet.is_favorite }" />
                                    <span>Likes: {{ snippet.favorites_count }}</span>
                                </span>
                            </div>
                        </CardContent>
                    </Card>
                </Link>
            </div>
            <div v-else class="py-8 text-center">No snippets found</div>
        </div>
    </AppLayout>
</template>
