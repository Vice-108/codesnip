<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import SnippetTable from '@/components/snippets/SnippetTable.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import type { Snippet } from '@/types';

interface Props {
    snippets: {
        data: Snippet[];
    };
}

defineProps<Props>();

const breadcrumbs = [
    {
        title: 'My Snippets',
        href: '#',
    },
];
</script>

<template>
    <Head title="My Snippets" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto p-4 container">
            <Card>
                <CardHeader>
                    <CardTitle>My Snippets</CardTitle>
                </CardHeader>
                <CardContent>
                    <SnippetTable :snippets="snippets.data" />
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
