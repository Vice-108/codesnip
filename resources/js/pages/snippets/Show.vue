<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import useMarkdown from '@/composables/useMarkdown';
import AppLayout from '@/layouts/AppLayout.vue';
import { capitalize } from '@/lib/utils';
import { type BreadcrumbItem, type Snippet } from '@/types';
import '@catppuccin/highlightjs/css/catppuccin-macchiato.css';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { Check, Copy, Heart, Pencil, Share2 } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps<{
    snippet: Snippet;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Snippets',
        href: '/snippets',
    },
    {
        title: props.snippet.title,
        href: '#',
    },
];

const form = useForm({});

const toggleFavorite = () => {
    form.post(route('snippets.favorite', { id: props.snippet.id }), {
        preserveScroll: true,
        preserveState: true,
    });
};

const formattedCode = computed(() => {
    const codeBlock = `\`\`\`${props.snippet.language}\n${props.snippet.code}\n\`\`\``;
    return useMarkdown(codeBlock);
});

const showCopyTick = ref(false);
const showShareTick = ref(false);

const copyCode = () => {
    navigator.clipboard.writeText(props.snippet.code);
    showCopyTick.value = true;
    toast.success('Code copied to clipboard');
    setTimeout(() => {
        showCopyTick.value = false;
    }, 2000);
};

const shareSnippet = () => {
    const url = window.location.href;
    navigator.clipboard.writeText(url);
    showShareTick.value = true;
    toast.success('Link copied to clipboard');
    setTimeout(() => {
        showShareTick.value = false;
    }, 2000);
};

const page = usePage();
</script>

<template>
    <Head :title="snippet.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto w-full lg:container sm:p-4">
            <Card class="w-full rounded-none border-0 sm:mx-0 sm:rounded-lg sm:border lg:mx-auto lg:max-w-4xl">
                <CardHeader>
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="space-y-2">
                            <CardTitle class="break-words">{{ snippet.title }}</CardTitle>
                        </div>
                        <div class="flex justify-between gap-2 sm:self-auto">
                            <Button variant="ghost" size="icon" @click="toggleFavorite" :disabled="form.processing">
                                <Heart :style="{ height: '25px', width: '25px' }" :class="{ 'fill-current': snippet.is_favorite }" />
                            </Button>
                            <Link
                                v-if="snippet.user.id === (page.props as any).auth.user?.id"
                                :href="route('snippets.edit', { id: snippet.id })"
                                class="inline-flex items-center gap-2"
                            >
                                <Button variant="outline" size="sm">
                                    <Pencil class="mr-2 h-4 w-4" />
                                    Edit
                                </Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>

                <CardContent class="mx-auto w-full sm:px-6">
                    <div class="markdown-content mx-auto w-full overflow-hidden rounded-lg border">
                        <div class="flex flex-wrap items-center justify-between border-b border-border px-2 py-2 sm:px-4">
                            <span class="text-sm font-medium sm:text-base">{{ capitalize(snippet.language || '') }}</span>
                            <div class="flex gap-2">
                                <Button variant="ghost" size="icon" @click="copyCode">
                                    <transition name="fade" mode="out-in">
                                        <Check v-if="showCopyTick" class="h-4 w-4" />
                                        <Copy v-else class="h-4 w-4" />
                                    </transition>
                                </Button>
                                <Button variant="ghost" size="icon" @click="shareSnippet">
                                    <transition name="fade" mode="out-in">
                                        <Check v-if="showShareTick" class="h-4 w-4" />
                                        <Share2 v-else class="h-4 w-4" />
                                    </transition>
                                </Button>
                            </div>
                        </div>
                        <div class="code-container">
                            <div class="overflow-x-scroll" v-html="formattedCode"></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <CardDescription>{{ snippet.description }}</CardDescription>
                    </div>
                </CardContent>

                <CardFooter class="flex items-start justify-between gap-4 sm:flex-row sm:items-center">
                    <div class="space-x-2">
                        <span>Created by</span>
                        <span class="font-semibold">{{ snippet.user.name }}</span>
                    </div>
                    <div class="text-sm text-muted-foreground">
                        <span class="rounded-lg border p-2 sm:p-3">Views: {{ snippet.views_count }}</span>
                    </div>
                </CardFooter>
            </Card>
        </div>
    </AppLayout>
</template>
<style scoped>
.code-container {
    max-width: 100%;
    overflow-x: auto;
}

.code-container :deep(pre) {
    white-space: pre-wrap;
    word-break: break-word;
    max-width: 100%;
}

.code-container :deep(code) {
    white-space: pre-wrap;
    word-break: break-word;
    max-width: 100%;
}

@media (max-width: 640px) {
    .code-container :deep(pre),
    .code-container :deep(code) {
        font-size: 0.6rem;
    }
}
/* Tablet styles */
@media (min-width: 641px) and (max-width: 1024px) {
    .code-container :deep(pre),
    .code-container :deep(code) {
        font-size: 0.75rem;
    }
    .code-container {
        max-width: 90vw;
    }
}
</style>
