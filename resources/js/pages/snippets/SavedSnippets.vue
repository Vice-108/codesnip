<script setup lang="ts">
import SavedSnippetTable from '@/components/snippets/SavedSnippetTable.vue';
import TablePagination from '@/components/snippets/TablePagination.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import type { Snippet } from '@/types';
import { Head } from '@inertiajs/vue3';

interface Props {
    snippets: {
        data: Snippet[];
        current_page: number;
        last_page: number;
        total: number;
        per_page: number;
        path: string;
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        // Other potential fields in Laravel pagination
        from?: number;
        to?: number;
        first_page_url?: string;
        last_page_url?: string;
        next_page_url?: string;
        prev_page_url?: string;
    };
}

defineProps<Props>();

const breadcrumbs = [
    {
        title: 'Saved Snippets',
        href: '#',
    },
];
</script>

<template>
    <Head title="Saved Snippets" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto p-4">
            <Card>
                <CardHeader>
                    <CardTitle>Saved Snippets</CardTitle>
                </CardHeader>
                <CardContent>
                    <SavedSnippetTable :snippets="snippets.data" />
                    <TablePagination :pagination="snippets" />
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
