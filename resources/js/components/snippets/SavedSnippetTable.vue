<script setup lang="ts">
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import type { Snippet } from '@/types';
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
                <TableHead>Language</TableHead>
                <TableHead>Title</TableHead>
                <TableHead>Description</TableHead>
                <TableHead>Creator</TableHead>
                <TableHead class="w-[100px]">Actions</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="snippet in snippets" :key="snippet.id">
                <TableCell>
                    <div class="flex items-center gap-5">
                        <i :class="`devicon-${snippet.language}-plain`" class="text-xl"></i>
                        <span class="capitalize">{{ snippet.language }}</span>
                    </div>
                </TableCell>
                <TableCell>{{ snippet.title }}</TableCell>
                <TableCell>{{ snippet.description }}</TableCell>
                <TableCell>{{ snippet.user?.name || 'Unknown' }}</TableCell>
                <TableCell>
                    <div class="flex items-center gap-2">
                        <ViewButton :snippet-id="snippet.id" />
                    </div>
                </TableCell>
            </TableRow>
            <TableRow v-if="snippets.length === 0">
                <TableCell colspan="5" class="text-center">No saved snippets found</TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>
