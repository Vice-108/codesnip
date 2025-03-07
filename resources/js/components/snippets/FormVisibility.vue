<script setup lang="ts">
import { Label } from '@/components/ui/label';
import { Switch } from '@/components/ui/switch';

defineProps<{
    modelValue: boolean;
}>();

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="flex items-center gap-2">
        <Switch id="is_public" :model-value="modelValue" @update:model-value="$emit('update:modelValue', $event)" />
        <Label for="is_public">Make this snippet public</Label>
    </div>
</template>
