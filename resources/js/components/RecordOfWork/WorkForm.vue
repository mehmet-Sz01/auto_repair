<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">İş Başlığı</label>
        <input
            type="text"
            v-model="work.work_title"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        />

        <label class="block text-sm font-medium text-gray-700 mt-4">Açıklama</label>
        <textarea
            v-model="work.description"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        ></textarea>

        <label class="block text-sm font-medium text-gray-700 mt-4">Yapan Usta</label>
        <select
            v-model="work.worker_id"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        >
            <option value="" disabled>Usta Seçiniz</option>
            <option v-for="worker in workers" :key="worker.id" :value="worker.id">
                {{ worker.worker_name }}
            </option>
        </select>

        <label class="block text-sm font-medium text-gray-700 mt-4">Fiyat</label>
        <input
            type="number"
            v-model="work.price"
            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        />
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        work: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            workers: [], // Usta listesini buraya kaydedeceğiz
        };
    },
    created() {
        // Sayfa yüklendiğinde ustaları çek
        this.fetchWorkers();
    },
    methods: {
        async fetchWorkers() {
            try {
                const response = await axios.get("/api/workers"); // API endpoint'i çağır
                this.workers = response.data; // Gelen veriyi workers listesine kaydet
            } catch (error) {
                console.error("Ustalar yüklenirken hata oluştu:", error);
            }
        },
    },
};
</script>
