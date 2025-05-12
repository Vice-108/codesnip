<script setup lang="ts">
import SnippetForm from '@/components/snippets/SnippetForm.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Snippet',
        href: '#',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="hidden sm:block mx-auto sm:p-4 container">
            <Card class="mx-auto max-w-3xl">
                <CardHeader>
                    <CardTitle>Create New Snippet</CardTitle>
                </CardHeader>
                <CardContent>
                    <SnippetForm mode="create" />
                </CardContent>
            </Card>
        </div>

        <div class="sm:hidden p-4">
            <SnippetForm mode="create" />
        </div>
    </AppLayout>
</template>
