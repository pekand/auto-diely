<script setup lang="ts">
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, usePage, router} from '@inertiajs/vue3'

const { props } = usePage()
const cars = ref(props.cars as Array<any>)

function editCar(id: number) {
    router.get(`/car/${id}`)
}

function deleteCar(id: number) {
    if (confirm('Are you sure you want to delete this car?')) {
      router.delete(`/car/${id}`, {
        onSuccess: () => {
           cars.value = cars.value.filter((c: any) => c.id !== id)
        },
        onError: (errors) => {
            console.error(errors);
        },
      })
    }
}

</script>

<template>
<AppLayout>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Cars</h2>
        <Link href="/car" class="btn btn-primary">+ Add New Car</Link>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Registration Number</th>
                <th scope="col">Is Registered</th>
                <th scope="col">Parts</th>
                <th scope="col" class="text-center" style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>

            <tr v-for="car in cars" :key="car.id">
                <td>{{ car.id }}</td>
                <td>{{ car.name }}</td>
                <td>{{ car.registration_number }}</td>
                <td>
                      <span v-if="car.is_registered" class="badge bg-success">Yes</span>
                      <span v-else class="badge bg-secondary">No</span>
                </td>
                <td>{{ car.parts.length }}</td>
                <td class="text-center">
                    <button type="submit" class="btn btn-sm btn-warning me-1"
                            @click="editCar(car.id)">
                            Edit
                    </button>
                    <button type="submit" class="btn btn-sm btn-danger"
                             @click="deleteCar(car.id)">
                            Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
      </AppLayout>
</template>
