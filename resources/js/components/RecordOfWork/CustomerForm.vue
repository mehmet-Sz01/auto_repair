<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">Ad</label>
        <input type="text" v-model="customer.first_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Soyad</label>
        <input type="text" v-model="customer.last_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Telefon Numarası</label>
        <input type="text" v-model="customer.number" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">E-Posta</label>
        <input type="text" v-model="customer.email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
    </div>
</template>

<script>
export default {
    props: {
        customer: {
            type: Object,
            required: true,
        }
    }
};
</script>
