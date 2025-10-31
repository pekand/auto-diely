<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { home } from '@/routes';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class=""
    >
        <div class="">
            <Link
                :href="home()"
                class=""
            >
                <div class="">
                    <AppLogoIcon
                        class=""
                    />
                </div>
            </Link>

            <div class="">
                <Card class="">
                    <CardHeader class="">
                        <CardTitle class="">{{ title }}</CardTitle>
                        <CardDescription>
                            {{ description }}
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="">
                        <slot />
                    </CardContent>
                </Card>
            </div>
        </div>
    </div>
</template>
