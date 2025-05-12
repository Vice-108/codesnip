<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Combobox,
    ComboboxAnchor,
    ComboboxEmpty,
    ComboboxGroup,
    ComboboxInput,
    ComboboxItem,
    ComboboxItemIndicator,
    ComboboxList,
    ComboboxTrigger,
} from '@/components/ui/combobox';
import { Label } from '@/components/ui/label';
import { languages, type Language } from '@/data/languages';
import { cn } from '@/lib/utils';
import { Check, ChevronsUpDown, Search } from 'lucide-vue-next';
import { onMounted } from 'vue';

const props = defineProps<{
    modelValue: Language | null;
    initialLanguage?: string;
    error?: string;
    disabled?: boolean; // <-- Added
}>();

const emit = defineEmits(['update:modelValue']);

onMounted(() => {
    if (props.initialLanguage) {
        const language = languages.find((lang) => lang.value === props.initialLanguage);
        if (language) {
            emit('update:modelValue', language);
        }
    }
});
</script>

<template>
    <div class="space-y-2">
        <Label for="language" class="flex items-center gap-1"> Language <span class="text-destructive">*</span> </Label>
        <Combobox :model-value="modelValue" @update:model-value="$emit('update:modelValue', $event)" by="label" :disabled="disabled">
            <ComboboxAnchor as-child>
                <ComboboxTrigger as-child>
                    <Button variant="outline" class="justify-between w-full h-10" :disabled="disabled">
                        {{ modelValue?.label ?? 'Select language' }}
                        <ChevronsUpDown class="opacity-50 ml-2 w-4 h-4 shrink-0" />
                    </Button>
                </ComboboxTrigger>
            </ComboboxAnchor>
            <ComboboxList class="w-full min-w-[var(--reka-combobox-trigger-width)] max-w-[var(--reka-combobox-trigger-width)]">
                <div class="relative items-center w-full">
                    <ComboboxInput class="pl-9 border-0 border-b rounded-none focus-visible:ring-0 w-full h-10" placeholder="Search language..." />
                    <span class="absolute inset-y-0 flex justify-center items-center px-3 start-0">
                        <Search class="size-4 text-muted-foreground" />
                    </span>
                </div>

                <ComboboxEmpty>No language found.</ComboboxEmpty>

                <ComboboxGroup class="max-h-[300px] overflow-auto">
                    <ComboboxItem v-for="lang in languages" :key="lang.value" :value="lang">
                        {{ lang.label }}
                        <ComboboxItemIndicator>
                            <Check :class="cn('ml-auto h-4 w-4')" />
                        </ComboboxItemIndicator>
                    </ComboboxItem>
                </ComboboxGroup>
            </ComboboxList>
        </Combobox>
        <span v-if="error" class="text-destructive text-sm">{{ error }}</span>
    </div>
</template>
