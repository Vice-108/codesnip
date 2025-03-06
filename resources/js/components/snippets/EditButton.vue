<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Pencil } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

defineProps<{
    snippetId: number;
}>();
</script>

<template>
    <Link :href="route('snippets.edit', { id: snippetId })">
        <Button variant="ghost" size="icon">
            <Pencil class="w-4 h-4" />
        </Button>
    </Link>
</template>
