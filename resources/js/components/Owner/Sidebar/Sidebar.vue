<template>
    <div class="card flex justify-content-center">
        <Sidebar v-model:visible="visible">
            <div class="flex flex-column h-full">
                <div class="flex align-items-center justify-content-between px-4 pt-3 flex-shrink-0">
                    <span class="inline-flex align-items-center gap-2">
                        <!-- Your Logo SVG -->
                        <span class="font-semibold text-2xl text-primary">Your Logo</span>
                    </span>
                    <span>
                        <Button type="button" @click="closeSidebar" icon="pi pi-times" rounded outlined class="h-2rem w-2rem"></Button>
                    </span>
                </div>
                <div class="overflow-y-auto">
                    <ul class="list-none p-3 m-0">
                        <li>
                            <div @click="toggleFavorites" class="p-3 flex align-items-center justify-content-between text-600 cursor-pointer">
                                <span class="font-medium">FAVORITES</span>
                                <i class="pi pi-chevron-down"></i>
                            </div>
                            <ul v-show="favoritesVisible" class="list-none p-0 m-0">
                                <li>
                                    <a class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors">
                                        <i class="pi pi-home mr-2"></i>
                                        <span class="font-medium">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors">
                                        <i class="pi pi-bookmark mr-2"></i>
                                        <span class="font-medium">Bookmarks</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="mt-auto">
                    <hr class="mb-3 mx-3 border-top-1 border-none surface-border" />
                    <a class="m-3 flex align-items-center cursor-pointer p-3 gap-2 border-round text-700 hover:surface-100 transition-duration-150 transition-colors">
                        <span class="font-bold">Amy Elsner</span>
                    </a>
                </div>
            </div>
        </Sidebar>
        <Button icon="pi pi-bars" @click="openSidebar" />
    </div>
</template>

<script setup>
import { ref } from "vue";
import Button from "primevue/button";

const visible = ref(false);
const favoritesVisible = ref(false);

function openSidebar() {
    visible.value = true;
}

function closeSidebar() {
    visible.value = false;
}

function toggleFavorites() {
    favoritesVisible.value = !favoritesVisible.value;
}
</script>
