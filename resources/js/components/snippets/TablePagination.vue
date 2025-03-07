<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from '@/components/ui/pagination';
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';

interface PaginationData {
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
}

interface Props {
    pagination: PaginationData;
}

const props = defineProps<Props>();

// Ensure safe default values
const currentPage = computed(() => props.pagination?.current_page ?? 1);
const lastPage = computed(() => props.pagination?.last_page ?? 1);
const itemsPerPage = computed(() => props.pagination?.per_page ?? 10);
const totalItems = computed(() => props.pagination?.total ?? 0);
const basePath = computed(() => props.pagination?.path ?? '');

// Function to handle pagination navigation
const handlePagination = (page: number) => {
    if (page === currentPage.value || page < 1 || page > lastPage.value) return;

    router.get(`${basePath.value}?page=${page}`, {
        preserveScroll: true, // Keeps scroll position
        preserveState: true, // Prevents full reload, making transitions smooth
        replace: true, // Prevents adding extra history entries
    });
};

// Function to generate pagination numbers with ellipsis
const paginatedItems = computed(() => {
    const pages = [];
    const totalPages = lastPage.value;
    const current = currentPage.value;
    const siblingCount = 1;

    if (totalPages <= 5) {
        for (let i = 1; i <= totalPages; i++) {
            pages.push({ type: 'page', value: i });
        }
    } else {
        pages.push({ type: 'page', value: 1 });

        if (current > siblingCount + 2) pages.push({ type: 'ellipsis' });

        for (let i = Math.max(2, current - siblingCount); i <= Math.min(totalPages - 1, current + siblingCount); i++) {
            pages.push({ type: 'page', value: i });
        }

        if (current < totalPages - siblingCount - 1) pages.push({ type: 'ellipsis' });

        pages.push({ type: 'page', value: totalPages });
    }

    return pages;
});
</script>

<template>
    <Pagination v-if="totalItems > 0" :itemsPerPage="itemsPerPage" :total="totalItems" :page="currentPage" :siblingCount="1">
        <PaginationList class="flex items-center justify-center gap-2">
            <!-- First & Previous Buttons -->
            <PaginationFirst @click="handlePagination(1)" :disabled="currentPage <= 1" />
            <PaginationPrev @click="handlePagination(currentPage - 1)" :disabled="currentPage <= 1" />

            <!-- Page Number Buttons with Ellipsis -->
            <template v-for="(item, index) in paginatedItems" :key="index">
                <PaginationListItem v-if="item.type === 'page'" :value="item.value as number" as-child>
                    <Button
                        class="h-9 w-9 p-0"
                        :variant="item.value === currentPage ? 'default' : 'outline'"
                        @click="handlePagination(item.value as number)"
                    >
                        {{ item.value }}
                    </Button>
                </PaginationListItem>
                <PaginationEllipsis v-else :key="index" />
            </template>

            <!-- Next & Last Buttons -->
            <PaginationNext @click="handlePagination(currentPage + 1)" :disabled="currentPage >= lastPage" />
            <PaginationLast @click="handlePagination(lastPage)" :disabled="currentPage >= lastPage" />
        </PaginationList>
    </Pagination>
</template>
