<template>
    <div class="flex">
        <!-- Sidebar -->
        <div v-if="isMenuOpen" class="h-screen w-64 bg-gray-800 text-white flex flex-col">
            <!-- Sidebar Header -->
            <div class="px-4 py-5 text-lg font-semibold border-b border-gray-700 flex justify-between items-center">
                <img src="/image/png-transparent-car-automobile-repair-shop-maintenance-motor-vehicle-service-jason-s-auto-repair-car.png" alt="IMS Logo" class="w-30 h-14 mx-auto">
                <button @click="toggleMenu" class="ml-auto">
                    <font-awesome-icon :icon="['fas', 'bars']" class="w-6 h-6" />
                </button>
            </div>
            <RouterLinks/>
        </div>
        <div class="bg-gray-800 min-h-screen">
            <button v-if="!isMenuOpen" @click="toggleMenu" class="p-6 text-white bg-gray-800">
                <font-awesome-icon :icon="['fas', 'bars']" class="w-6 h-6" />
            </button>
        </div>
    </div>
</template>

<script>
import RouterLinks from "../Sidebar/RouterLinks.vue";
export default {
    name: 'Sidebar',
    components: {RouterLinks},
    data() {
        return {
            isMenuOpen: true, // Menü başlangıçta açık
        };
    },
    methods: {
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen; // Menü görünümünü değiştir
        },
    },
};
</script>

