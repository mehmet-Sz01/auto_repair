<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">Ad</label>
        <input type="text" v-model="customer.first_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">Soyad</label>
        <input type="text" v-model="customer.last_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />


        <label for="phone" class="block text-sm font-medium text-gray-700 mt-4">Telefon Numarası</label>
        <input id="phone" v-model="customer.number" placeholder="(555) 000-0000" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />

        <label class="block text-sm font-medium text-gray-700 mt-4">E-Posta</label>
        <input type="email" v-model="customer.email" placeholder="example@gmail.com" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
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
