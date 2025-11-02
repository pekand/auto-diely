<script setup lang="ts">

import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

import AppLayout from '@/layouts/AppLayout.vue';

const { props } = usePage()
const car = ref(props.car)

/*const page = usePage()
const car = page.props.car*/

const isEdit = ref(!!(car?.value?.id) || false)
const currentCarId = ref(car?.value?.id || null)
const addingNewPart = ref(false)

const form = useForm({
  name: car?.value?.name || '',
  registration_number: car?.value?.registration_number || '',
  is_registered: car?.value?.is_registered == 1 || false,
})

function submit() {
    if (isEdit.value && currentCarId.value) {
    form.put(`/car/${currentCarId.value}`, {
      onSuccess: (page) => {
        console.log('Car updated:', page?.props?.car)
      },
    })
  } else {
      form.post('/car', {
        onSuccess: (page) => {
          const newCar = page?.props?.car
          console.log(newCar);
          if (newCar) {
              car.parts = newCar.parts
              isEdit.value = true
              currentCarId.value = newCar.id
              form.name = newCar.name
              form.registration_number = newCar.registration_number
              form.is_registered = newCar.is_registered
            }
        },
        onError: (errs) => {
          console.error(errs)
        }
      })
    }
}

function toggleNewPart() {
  addingNewPart.value = !addingNewPart.value
}

</script>

<template>
      <AppLayout>
        <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ isEdit ? 'Edit car' : 'Add new car' }}</h2>
        </div>

        <form @submit.prevent="submit" class="p-4 border rounded bg-light">
            <input v-if="isEdit" id="id" name="id" v-model="form.id" type="hidden" :value="currentCarId" />

            <div class="mb-3">
                <label for="name" class="form-label">Car name</label>
                <input
                  v-model="form.name"
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="e.g. Toyota Corolla"
                  required
                />
            </div>

            <div class="mb-3">
                <label for="registration_number" class="form-label">Registration number</label>
                <input
                  v-model="form.registration_number"
                  type="text"
                  class="form-control"
                  id="registration_number"
                  placeholder="e.g. TOY-123"
                  required
                />
            </div>

            <div class="form-check mb-3">
                <input
                  v-model="form.is_registered"
                  class="form-check-input"
                  type="checkbox"
                  id="is_registered"
                />
                <label class="form-check-label" for="is_registered">
                    Is registered
                </label>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="form.processing">
              {{ isEdit ? 'Update Car' : 'Add Car' }}
            </button>
        </form>
        </div>
        <div v-if="isEdit" class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Parts</h2>
                <button @click="toggleNewPart" class="btn btn-success">+ Add New Part</button>
            </div>

            <div v-if="addingNewPart" class="pb-4">
                <form action="{{ route('parts.store') }}" method="POST" class="p-4 border rounded bg-light mt-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Part name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Brake Disc" required>
                    </div>

                    <div class="mb-3">
                        <label for="serialnumber" class="form-label">Serial number</label>
                        <input type="text" class="form-control" id="serialnumber" name="serialnumber" placeholder="e.g. BD-12345" required>
                    </div>

                    <button type="submit" class="btn btn-success">Add Part</button>
                </form>
            </div>

            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Serial Number</th>
                        <th scope="col" class="text-center" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="part in car?.parts ?? []" :key="part.id">
                        <td>{{ part.id }}</td>
                        <td>{{ part.name }}</td>
                        <td>{{ part.serialnumber }}</td>
                        <td class="text-center">
                            <button type="submit" class="btn btn-sm btn-warning me-1"
                                    onclick="">
                                    Edit
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this part?')">
                                    Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      </AppLayout>
</template>
