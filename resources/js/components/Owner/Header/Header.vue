<template>
    <header class="bg-gray-800 text-white flex justify-between items-center p-4 shadow-md">

        <div class="text-lg font-bold">
        </div>

        <!-- Sağ Taraf: Çıkış Yap Butonu -->
        <button @click="logout" class="flex items-center space-x-2 hover:text-gray-300 transition">
            <span>Çıkış Yap</span>
            <font-awesome-icon :icon="['fas', 'sign-out-alt']" />
        </button>
    </header>
</template>

<script setup>
import { ref } from 'vue';
import store from "@/store";

const logout = () => {
    store.dispatch('logout');
};

</script>

