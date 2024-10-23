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

            <nav class="mt-4">
                <ul>
                    <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <router-link to="/owner" class="flex items-center">
                            <font-awesome-icon :icon="['fas', 'house']" class="mr-2" />
                            <span>Anasayfa</span>
                        </router-link>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <router-link to="/workers" class="flex items-center">
                            <font-awesome-icon :icon="['fas', 'user-gear']" class="mr-2" />
                            <span>Çalışanlar</span>
                        </router-link>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <router-link to="/works" class="flex items-center">
                            <font-awesome-icon :icon="['fas', 'briefcase']" class="mr-2" />
                            <span>Yapılan İşler</span>
                        </router-link>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <router-link to="/customers" class="flex items-center">
                            <font-awesome-icon :icon="['fas', 'user']" class="mr-2" />
                            <span>Müşteriler</span>
                        </router-link>
                    </li>
                </ul>
            </nav>

        </div>


        <!-- Menü Kapalıyken Görünen Buton -->
        <div class="bg-gray-800 min-h-screen">
            <button v-if="!isMenuOpen" @click="toggleMenu" class="p-6 text-white bg-gray-800">
                <font-awesome-icon :icon="['fas', 'bars']" class="w-6 h-6" />
            </button>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Sidebar',
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

