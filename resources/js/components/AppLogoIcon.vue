<script setup lang="ts">
import { SquareDashedBottomCode } from 'lucide-vue-next';
import type { HTMLAttributes } from 'vue';
defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <SquareDashedBottomCode :class="className" v-bind="$attrs" />
</template>
