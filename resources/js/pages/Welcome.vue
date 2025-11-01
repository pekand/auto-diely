<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

</script>

<template>
  <Head title="Login" />

  <main class="form-signin w-100 m-auto">
    Welcome
  </main>
</template>
