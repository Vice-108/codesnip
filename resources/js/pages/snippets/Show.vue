<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Snippet } from '@/types';
import { Head, useForm, Link, usePage } from '@inertiajs/vue3';
import { Heart, Copy, Share2, Check, Pencil } from 'lucide-vue-next';
import  useMarkdown  from '@/composables/useMarkdown';
import { computed, ref } from 'vue';
import '@catppuccin/highlightjs/css/catppuccin-macchiato.css'
import { toast } from 'vue-sonner';
import { capitalize } from '@/lib/utils';

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
        <div class="mx-auto sm:p-4 w-full lg:container">
            <Card class="sm:mx-0 lg:mx-auto sm:border border-0 rounded-none sm:rounded-lg w-full lg:max-w-4xl">
                <CardHeader>
                    <div class="flex sm:flex-row flex-col sm:justify-between sm:items-start gap-4">
                        <div class="space-y-2">
                            <CardTitle class="break-words">{{ snippet.title }}</CardTitle>
                        </div>
                        <div class="flex justify-between sm:self-auto gap-2">
                            <Button variant="ghost" size="icon" @click="toggleFavorite" :disabled="form.processing">
                                <Heart :style="{height:'25px', width: '25px' }" :class="{ 'fill-current': snippet.is_favorite }" />
                            </Button>
                            <Link
                                v-if="snippet.user.id === (page.props as any).auth.user?.id"
                                :href="route('snippets.edit', { id : snippet.id })"
                                class="inline-flex items-center gap-2"
                            >
                                <Button variant="outline" size="sm">
                                    <Pencil class="mr-2 w-4 h-4" />
                                    Edit
                                </Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>

                <CardContent class="mx-auto sm:px-6 w-full">
                    <div class="mx-auto border rounded-lg w-full overflow-hidden markdown-content">
                        <div class="flex flex-wrap justify-between items-center px-2 sm:px-4 py-2 border-b border-border">
                            <span class="font-medium text-sm sm:text-base">{{ capitalize(snippet.language || '') }}</span>
                            <div class="flex gap-2">
                                <Button variant="ghost" size="icon" @click="copyCode">
                                    <transition name="fade" mode="out-in">
                                        <Check v-if="showCopyTick" class="w-4 h-4" />
                                        <Copy v-else class="w-4 h-4" />
                                    </transition>
                                </Button>
                                <Button variant="ghost" size="icon" @click="shareSnippet">
                                    <transition name="fade" mode="out-in">
                                        <Check v-if="showShareTick" class="w-4 h-4" />
                                        <Share2 v-else class="w-4 h-4" />
                                    </transition>
                                </Button>
                            </div>
                        </div>
                        <div class="code-container">
                            <div
                                class="overflow-x-scroll"
                                v-html="formattedCode"
                            ></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <CardDescription>{{ snippet.description }}</CardDescription>
                    </div>
                </CardContent>

                <CardFooter class="flex sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="space-x-2">
                        <span>Created by</span>
                        <span class="font-semibold">{{ snippet.user.name }}</span>
                    </div>
                    <div class="text-muted-foreground text-sm">
                        <span class="p-2 sm:p-3 border rounded-lg">Views: {{ snippet.views_count }}</span>
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
