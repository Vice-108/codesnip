<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex flex-col lg:justify-center items-center bg-[#FDFDFC] dark:bg-[#0a0a0a] p-6 lg:p-8 min-h-screen text-[#1b1b18]">
        <header class="not-has-[nav]:hidden mb-6 w-full max-w-[335px] lg:max-w-4xl text-sm">
            <nav class="flex justify-end items-center gap-4">
                <Link
                    :href="route('login')"
                    class="inline-block px-5 py-1.5 border hover:border-[#19140035] dark:hover:border-[#3E3E3A] border-transparent rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] text-sm leading-normal"
                >
                    Log in
                </Link>
                <Link
                    :href="route('register')"
                    class="inline-block px-5 py-1.5 border border-[#19140035] hover:border-[#1915014a] dark:hover:border-[#62605b] dark:border-[#3E3E3A] rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] text-sm leading-normal"
                >
                    Register
                </Link>
            </nav>
        </header>
    </div>
</template>
