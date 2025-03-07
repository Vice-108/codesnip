<script setup lang="ts">
import SnippetForm from '@/components/snippets/SnippetForm.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

interface Props {
    snippet: {
        id: number;
        title: string;
        description: string;
        code: string;
        language: string;
        is_public: boolean;
    };
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Snippet',
        href: '#',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto sm:p-4 container">
            <Card class="mx-auto max-w-3xl" style="height: 90svh;">
                <CardHeader>
                    <CardTitle>Edit Snippet</CardTitle>
                </CardHeader>
                <CardContent>
                    <SnippetForm :snippet="snippet" mode="edit" />
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
