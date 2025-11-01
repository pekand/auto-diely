<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'

function logout() {
  router.post('/logout')
}

</script>

<template>
    <button @click="logout" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
      Logout
    </button>
</template>
