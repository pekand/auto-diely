<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const name = page.props.name;
const quote = page.props.quote;

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class=""
    >
        <div
            class=""
        >
            <div class="" />
            <Link
                :href="home()"
                class=""
            >
                <AppLogoIcon class="" />
                {{ name }}
            </Link>
            <div v-if="quote" class="">
                <blockquote class="">
                    <p class="">&ldquo;{{ quote.message }}&rdquo;</p>
                    <footer class="">
                        {{ quote.author }}
                    </footer>
                </blockquote>
            </div>
        </div>
        <div class="">
            <div
                class=""
            >
                <div class="">
                    <h1 class="" v-if="title">
                        {{ title }}
                    </h1>
                    <p class="" v-if="description">
                        {{ description }}
                    </p>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
