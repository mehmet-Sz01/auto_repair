<template>
    <div>
        <DataTableComponent
            :initialItems="works.items"
            :columns="workColumns"
            :dialogFields="workDialogFields"
            :onItemSaved="handleItemSaved"
            :onItemDeleted="handleItemDeleted"
            :infoDialogFields="workInfoDialog"
        />
    </div>
</template>

<script setup>
import { onMounted, reactive} from 'vue';
import DataTableComponent from '../DataTable/DataTableComponent.vue';
import axios from 'axios';

const works = reactive({items:[]});
const workColumns = [
    {field: 'work_title', header: 'Work Title', style: 'min-width:10rem'},
    {field: 'car_id', header: 'Car ID', style: 'min-width:10rem'},
    {field: 'worker_id', header: 'Worker ID', style: 'min-width:10rem'},
    {field: 'description', header: 'Description', style: 'min-width:10rem'},
    {field: 'price', header: 'Price', style: 'min-width:10rem'},
    {field: 'customer_id', header: 'Customer ID', style: 'min-width:10rem'},
];
const workDialogFields = [
    {id: 'title', label: 'Work Title', model: 'work_title'},
    {id: 'car', label: 'Car ID', model: 'car_id'},
    {id: 'worker', label: 'Worker ID', model: 'worker_id'},
    {id: 'description', label: 'Description', model: 'description'},
    {id: 'price', label: 'Price', model: 'price'},
    {id: 'customer', label: 'Customer ID', model: 'customer_id'},

];

const workInfoDialog = reactive([
    //work
    {id: 'title', label: 'Work Title', model: 'work_title'},
    {id: 'description', label: 'Description', model: 'description'},
    {id: 'price', label: 'Price', model: 'price'},
    //car
    {id: 'plate', label: 'Plate', model: 'plate'},
    {id: 'brand', label: 'Brand', model: 'brand'},
    {id: 'model', label: 'Model', model: 'model'},
    {id: 'color', label: 'Color', model: 'color'},
    {id: 'year', label: 'Year', model: 'year'},
    {id: 'maintenance_date', label: 'Maintenance Date', model: 'maintenance_date'},
    {id: 'inspection_date', label: 'Inspection Date', model: 'inspection_date'},
    //customer
    {id: 'name', label: 'Customer Name', model: 'first_name'},
    {id: 'lastname', label: 'Customer Surname', model: 'last_name'},
    //worker
    { id: 'name', label: 'Worker Name', model: 'worker_name' },
    { id: 'lastname', label: 'Worker Surname', model: 'worker_lastname' },
]);


// İş verilerini al
const fetchWorks = async () => {
    try {
        const response = await axios.get('/api/works'); // İşleri ve ilişkili araç bilgilerini al
        works.items = response.data.map(work => {
            const car = work.car; // İlgili araba bilgileri (work ile ilişkilendirilen car objesi)
            const customer = work.customer; // Aracın sahibine ait müşteri bilgileri
            const worker = work.worker; // İşçinin bilgileri (work ile ilişkilendirilen worker objesi)
            return {
                // İş bilgileri
                ...work,
                work_title: work.work_title, // İşin başlığı
                description: work.description, // İşin açıklaması
                price: work.price, // İşin fiyatı
                // Araç bilgileri
                plate: car?.plate, // Araç plakası
                brand: car?.brand, // Araç markası
                model: car?.model, // Araç modeli
                color: car?.color, // Araç rengi
                year: car?.year, // Araç yılı
                maintenance_date: car?.maintenance_date, // Araç bakım tarihi
                inspection_date: car?.inspection_date, // Araç muayene tarihi
                // Müşteri bilgileri
                first_name: customer.first_name, // Müşteri adı
                last_name: customer.last_name, // Müşteri soyadı
                // İşçi bilgileri
                worker_name: worker?.worker_name, // İşçinin adı
                worker_lastname: worker?.worker_lastname, // İşçinin soyadı
            };
        });
    } catch (error) {
        console.error("İşleri çekerken hata oluştu:", error);
    }
};



// Yeni kayıt işlemi
const handleItemSaved = async (savedItem) => {
    try {
        if (savedItem.id) {
            // Güncelleme işlemi
            await axios.put(`/api/works/${savedItem.id}`, savedItem);
        } else {
            // Yeni kayıt işlemi
            await axios.post('/api/works', savedItem);
        }
        fetchWorks(); // Kayıt işlemi sonrası güncelleme
    } catch (error) {
        console.error("Kayıt işlemi sırasında hata oluştu:", error);
    }
};

// Silme işlemi
const handleItemDeleted = async (deletedItem) => {
    try {
        await axios.delete(`/api/works/${deletedItem.id}`);
        fetchWorks(); // Silme işlemi sonrası güncelleme
    } catch (error) {
        console.error("Silme işlemi sırasında hata oluştu:", error);
    }
};

onMounted(async () => {
    await fetchWorks();
});
</script>
