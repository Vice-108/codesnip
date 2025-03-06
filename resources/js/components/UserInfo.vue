<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';
import type { User } from '@/types';

interface Props {
    user: User | null;
    showEmail?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    showEmail: true,
});

const { getInitials } = useInitials();

</script>

<template>
    <Avatar class="rounded-lg w-8 h-8 overflow-hidden">
        <AvatarImage v-if="false" :src="user.avatar as string" :alt="user.name" />
        <AvatarFallback class="rounded-lg text-black dark:text-white">
            {{ props.user !== null ?  getInitials(user.name) : "G" }}
        </AvatarFallback>
    </Avatar>

    <div class="flex-1 grid text-sm text-left leading-tight" v-if="props.user !==null">
        <span class="font-medium truncate">{{ user.name }}</span>
        <span v-if="showEmail" class="text-muted-foreground text-xs truncate">{{ user.email }}</span>
    </div>
    <div v-else>
        <span class="font-medium truncate">Guest</span>
    </div>
</template>
