<script setup lang="ts">
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { languages, type Language } from '@/data/languages';
import { ref } from 'vue';

// Define props and emits
const props = defineProps<{
    language?: string | null;
}>();

const emit = defineEmits<{
    'update:modelValue': [value: Language | null];
}>();

// Initialize with the prop value if provided
const language = ref<string | null>(props.language || null);

// Handle selection change
function handleChange(value: any) {
    emit('update:modelValue', value);
}
</script>

<template>
    <Select v-model="language" @update:model-value="handleChange" class="w-full">
        <SelectTrigger class="w-full">
            <SelectValue placeholder="Select a language" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel class="font-bold underline uppercase">Languages</SelectLabel>
                <SelectItem class="ml-5" v-for="lang in languages" :value="lang.value" :key="lang.value">
                    {{ lang.label }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
