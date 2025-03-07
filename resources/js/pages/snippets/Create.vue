<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import SnippetForm from '@/components/snippets/SnippetForm.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Snippet',
        href: '#',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto sm:p-4 container">
            <Card class="mx-auto border max-w-3xl" style="height: 90svh;">
                <CardHeader>
                    <CardTitle>Create New Snippet</CardTitle>
                </CardHeader>
                <CardContent>
                    <SnippetForm mode="create" />
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
