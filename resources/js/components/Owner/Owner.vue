<template>
    <div class="flex h-screen">
        <Sidebar />
        <div class="flex-1 flex flex-col">
            <Header />
            <MainLayout>
                <router-view/>
            </MainLayout>
        </div>
    </div>
</template>

<script setup>
import Sidebar from "../Owner/Sidebar/Sidebar.vue";
import Header from "../Owner/Header/Header.vue";
import MainLayout from "./MainLayout/MainLayout.vue"
</script>
