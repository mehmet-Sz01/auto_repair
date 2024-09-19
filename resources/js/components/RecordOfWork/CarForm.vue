<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">Plaka</label>
        <input type="text" v-model="car.plate" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Marka</label>
        <input type="text" v-model="car.brand" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Model</label>
        <input type="text" v-model="car.model" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Renk</label>
        <input type="text" v-model="car.color" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Yıl</label>
        <input type="date" v-model="car.year" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Bakım Tarihi</label>
        <input type="date" v-model="car.maintenance_date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Muayene Tarihi</label>
        <input type="date" v-model="car.inspection_date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
    </div>
</template>

<script>
export default {
    props: {
        car: {
            type: Object,
            required: true,
        }
    }
};
</script>
