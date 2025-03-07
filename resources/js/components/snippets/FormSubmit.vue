<script setup lang="ts">
import { Button } from '@/components/ui/button';

defineProps<{
    isProcessing: boolean;
    mode: 'create' | 'edit';
}>();
</script>

<template>
    <Button type="submit" :disabled="isProcessing" class="w-full">
        {{ isProcessing ? (mode === 'create' ? 'Creating...' : 'Updating...') : mode === 'create' ? 'Create Snippet' : 'Update Snippet' }}
    </Button>
</template>
