<script setup lang="ts">
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';

defineProps<{
    modelValue: string;
    error?: string;
}>();

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="space-y-2">
        <Label for="description">Description (Optional)</Label>
        <Textarea
            id="description"
            :model-value="modelValue"
            @update:model-value="$emit('update:modelValue', $event)"
            :error="error"
            placeholder="Enter snippet description"
        />
        <span v-if="error" class="text-sm text-destructive">{{ error }}</span>
    </div>
</template>
