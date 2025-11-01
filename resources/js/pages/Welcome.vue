<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

function submit() {
  form.post('/login', {
    preserveScroll: true,
    onSuccess: () => {
      // voliteľne: niečo po úspechu (napr. preusmernenie spraví server/Inertia)
    },
    onError: (errors) => {
      // errors sú dostupné v form.errors automaticky
      // môžeš sem pridať logging alebo notifikáciu
      // console.log(errors)
    },
  })
}
</script>

<template>
  <Head title="Login" />

  <main class="form-signin w-100 m-auto">
    <form @submit.prevent="submit" novalidate>
      <img class="mb-4" src="/assets/img/engine.png" alt="" width="72" />
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating mb-2">
        <input
          v-model="form.email"
          type="email"
          class="form-control"
          :class="{ 'is-invalid': form.errors.email }"
          id="floatingInput"
          placeholder="name@example.com"
          autocomplete="email"
        />
        <label for="floatingInput">Email address</label>
        <div v-if="form.errors.email" class="invalid-feedback d-block">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="form-floating mb-2">
        <input
          v-model="form.password"
          type="password"
          class="form-control"
          :class="{ 'is-invalid': form.errors.password }"
          id="floatingPassword"
          placeholder="Password"
          autocomplete="current-password"
        />
        <label for="floatingPassword">Password</label>
        <div v-if="form.errors.password" class="invalid-feedback d-block">
          {{ form.errors.password }}
        </div>
      </div>

      <div class="form-check text-start my-3">
        <input
          id="checkDefault"
          class="form-check-input"
          type="checkbox"
          v-model="form.remember"
        />
        <label class="form-check-label" for="checkDefault"> Remember me </label>
      </div>

      <button
        class="btn btn-primary w-100 py-2"
        type="submit"
        :disabled="form.processing"
      >
        <span v-if="form.processing">Signing in…</span>
        <span v-else>Sign in</span>
      </button>

      <p class="mt-5 mb-3 text-body-secondary">&copy; 2025</p>
    </form>
  </main>
</template>
