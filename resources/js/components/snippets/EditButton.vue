<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { Pencil } from 'lucide-vue-next';

defineProps<{
    snippetId: number;
}>();
</script>

<template>
    <Link :href="route('snippets.edit', { id: snippetId })">
        <Button variant="ghost" size="icon">
            <Pencil class="h-4 w-4" />
        </Button>
    </Link>
</template>
