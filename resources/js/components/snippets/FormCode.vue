<script setup lang="ts">
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { Info } from 'lucide-vue-next';

defineProps<{
    modelValue: string;
    error?: string;
}>();

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="space-y-2">
        <div class="flex items-center gap-2">
            <Label for="code" class="flex items-center gap-1"> Code <span class="text-destructive">*</span> </Label>
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger asChild>
                        <Info class="w-4 h-4 text-muted-foreground cursor-help" />
                    </TooltipTrigger>
                    <TooltipContent class="w-80">
                        <ul class="space-y-1 pl-4 list-disc">
                            <li>Use proper language syntax</li>
                            <li>Include clear and descriptive comments</li>
                            <li>Include usage and result in comments</li>
                            <li>Use proper indentation and formatting</li>
                            <li>Add error handling if necessary</li>
                        </ul>
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        </div>
        <Textarea
            id="code"
            :model-value="modelValue"
            @update:model-value="$emit('update:modelValue', $event)"
            :error="error"
            rows="5"
            placeholder="Paste your code here"
            class="font-mono"
            required
        />
        <span v-if="error" class="text-destructive text-sm">{{ error }}</span>
    </div>
</template>
