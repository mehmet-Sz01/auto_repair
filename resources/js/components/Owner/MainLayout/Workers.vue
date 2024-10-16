<template>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="p-6 bg-white rounded-lg shadow-md w-full max-w-2xl">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Çalışanlar</h2>
            <table class="min-w-full border border-gray-300">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Adı</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Soyadı</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Telefon</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Maaş</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="worker in workers" :key="worker.id" class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b border-gray-300">{{ worker.worker_name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ worker.worker_lastname }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ worker.number }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ worker.wage }} TL</td>
                    <td class="py-2 px-4 border-b border-gray-300 flex space-x-2">
                        <button
                            @click="editWorker(worker)"
                            class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-150"
                        >
                            Düzenle
                        </button>
                        <button
                            @click="deleteWorker(worker.id)"
                            class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-150"
                        >
                            Sil
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>

            <button
                @click="showAddWorkerForm = true"
                class="mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 w-full"
            >
                Çalışan Ekle
            </button>

            <!-- Yeni Çalışan Ekleme Formu -->
            <div v-if="showAddWorkerForm" class="mt-8 p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-800 text-center">Yeni Çalışan Ekle</h3>
                <form @submit.prevent="addWorker" class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Çalışan Adı</label>
                        <input
                            v-model="newWorkerName"
                            type="text"
                            placeholder="Çalışan adı girin"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700">Çalışan Soyadı</label>
                        <input
                            v-model="newWorkerLastname"
                            type="text"
                            placeholder="Çalışan soyadı girin"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700">Telefon Numarası</label>
                        <input
                            v-model="newWorkerNumber"
                            type="text"
                            placeholder="Telefon numarası girin"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700">Maaş</label>
                        <input
                            v-model="newWorkerWage"
                            type="number"
                            placeholder="Maaş girin"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div class="flex items-center space-x-4 mt-6 justify-center">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Kaydet
                        </button>
                        <button @click="showAddWorkerForm = false" type="button" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            İptal
                        </button>
                    </div>
                </form>
            </div>

            <!-- Çalışan Düzenleme Formu -->
            <div v-if="showEditWorkerForm" class="mt-8 p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-800 text-center">Çalışan Düzenle</h3>
                <form @submit.prevent="updateWorker" class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Çalışan Adı</label>
                        <input
                            v-model="editWorkerData.worker_name"
                            type="text"
                            placeholder="Çalışan adı düzenle"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700">Çalışan Soyadı</label>
                        <input
                            v-model="editWorkerData.worker_lastname"
                            type="text"
                            placeholder="Çalışan soyadı düzenle"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700">Telefon Numarası</label>
                        <input
                            v-model="editWorkerData.number"
                            type="text"
                            placeholder="Telefon numarası düzenle"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div>
                        <label class="block text-gray-700">Maaş</label>
                        <input
                            v-model="editWorkerData.wage"
                            type="number"
                            placeholder="Maaşı düzenle"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div class="flex items-center space-x-4 mt-6 justify-center">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Güncelle
                        </button>
                        <button @click="showEditWorkerForm = false" type="button" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            İptal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            workers: [],
            showAddWorkerForm: false,
            showEditWorkerForm: false,
            newWorkerName: '',
            newWorkerLastname: '',
            newWorkerNumber: '',
            newWorkerWage: '',
            editWorkerData: {
                id: null,
                worker_name: '',
                worker_lastname: '',
                number: '',
                wage: '',
            },
        };
    },
    methods: {
        async fetchWorkers() {
            try {
                const response = await axios.get('/api/workers');
                this.workers = response.data;
            } catch (error) {
                console.error('Çalışanları getirirken bir hata oluştu:', error);
            }
        },
        async addWorker() {
            try {
                const response = await axios.post('/api/workers', {
                    worker_name: this.newWorkerName,
                    worker_lastname: this.newWorkerLastname,
                    number: this.newWorkerNumber,
                    wage: this.newWorkerWage,
                });
                this.workers.push(response.data);
                this.resetAddWorkerForm();
            } catch (error) {
                console.error('Yeni çalışan eklenirken bir hata oluştu:', error);
            }
        },
        async deleteWorker(workerId) {
            try {
                await axios.delete(`/api/workers/${workerId}`);
                this.workers = this.workers.filter(worker => worker.id !== workerId);
            } catch (error) {
                console.error('Çalışan silinirken bir hata oluştu:', error);
            }
        },
        editWorker(worker) {
            this.editWorkerData = { ...worker };
            this.showEditWorkerForm = true;
        },
        async updateWorker() {
            try {
                const response = await axios.put(`/api/workers/${this.editWorkerData.id}`, this.editWorkerData);
                const index = this.workers.findIndex(worker => worker.id === this.editWorkerData.id);
                this.$set(this.workers, index, response.data);
                this.showEditWorkerForm = false;
            } catch (error) {
                console.error('Çalışan güncellenirken bir hata oluştu:', error);
            }
        },
        resetAddWorkerForm() {
            this.newWorkerName = '';
            this.newWorkerLastname = '';
            this.newWorkerNumber = '';
            this.newWorkerWage = '';
            this.showAddWorkerForm = false;
        },
    },
    mounted() {
        this.fetchWorkers();
    },
};
</script>

<style scoped>
.hover\:bg-gray-100:hover {
    background-color: #f7fafc;
}
</style>
