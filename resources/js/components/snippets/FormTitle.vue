<script setup lang="ts">
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

defineProps<{
    modelValue: string;
    error?: string;
}>();

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="space-y-2">
        <Label for="title" class="flex items-center gap-1"> Title <span class="text-destructive">*</span> </Label>
        <Input
            id="title"
            :model-value="modelValue"
            @update:model-value="$emit('update:modelValue', $event)"
            :error="error"
            placeholder="Enter snippet title"
            required
        />
        <span v-if="error" class="text-sm text-destructive">{{ error }}</span>
    </div>
</template>
