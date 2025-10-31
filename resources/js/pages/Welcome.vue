<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Welcome">
    </Head>
    <div
        class=""
    >
        <header class="">
            <nav class="">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class=""
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class=""
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class=""
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <main class="">            
        </main>      
    </div>
</template>
