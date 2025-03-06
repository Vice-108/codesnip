<script setup lang="ts">
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';

import type { Snippet } from '@/types';
import DeleteButton from './DeleteButton.vue';
import EditButton from './EditButton.vue';
import ViewButton from './ViewButton.vue';

interface Props {
    snippets: Snippet[];
}

defineProps<Props>();
</script>

<template>
    <Table>
        <TableHeader>
            <TableRow>
                <TableHead>ID</TableHead>
                <TableHead>Title</TableHead>
                <TableHead>Description</TableHead>
                <TableHead>Language</TableHead>
                <TableHead class="w-[100px]">Actions</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="snippet in snippets" :key="snippet.id">
                <TableCell>{{ snippet.id }}</TableCell>
                <TableCell>{{ snippet.title }}</TableCell>
                <TableCell>{{ snippet.description }}</TableCell>
                <TableCell>{{ snippet.language }}</TableCell>
                <TableCell>
                    <div class="flex items-center gap-2">
                        <ViewButton :snippet-id="snippet.id" />
                        <EditButton :snippet-id="snippet.id" />
                        <DeleteButton :snippet-id="snippet.id" />
                    </div>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>
