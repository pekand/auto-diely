<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
      <AppLayout>
        <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Add new part</h2>
        </div>
<form action="{{ route('parts.store') }}" method="POST" class="p-4 border rounded bg-light mt-4">
    <div class="mb-3">
        <label for="name" class="form-label">Part name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Brake Disc" required>
    </div>

    <div class="mb-3">
        <label for="serialnumber" class="form-label">Serial number</label>
        <input type="text" class="form-control" id="serialnumber" name="serialnumber" placeholder="e.g. BD-12345" required>
    </div>

    <div class="mb-3">
        <label for="car_id" class="form-label">Select car</label>
        <select class="form-select" id="car_id" name="car_id" required>
            <option value="">-- Select Car --</option>
                <option value="">Car name (REGISTRATION_NUMBER)</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Add Part</button>
</form>
</div>

      </AppLayout>
</template>
