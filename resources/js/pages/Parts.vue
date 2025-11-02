<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3'

const { props } = usePage()
const parts = props.parts
</script>

<template>
      <AppLayout>
        
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Parts</h2>
        <a href="{{ route('parts.create') }}" class="btn btn-success">+ Add New Part</a>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Car</th>
                <th scope="col">Car regNum</th>
                <th scope="col" class="text-center" style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="part in parts" :key="part.id">
                <td>{{ part.id }}</td>
                <td>{{ part.name }}</td>
                <td>{{ part.serialnumber }}</td>
                <td>{{ part.car.name }}</td>
                <td>{{ part.car.registration_number }}</td>
                <td class="text-center">
                    <button type="submit" class="btn btn-sm btn-warning me-1"
                            onclick="">
                            Edit
                    </button>
                    <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this car?')">
                            Delete
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


      </AppLayout>
</template>
