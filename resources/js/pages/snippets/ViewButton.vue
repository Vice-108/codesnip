<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Eye } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

defineProps<{
    snippetId: number;
}>();
</script>

<template>
    <Link :href="route('snippets.show', { id: snippetId })">
        <Button variant="ghost" size="icon">
            <Eye class="w-4 h-4" />
        </Button>
    </Link>
</template>
