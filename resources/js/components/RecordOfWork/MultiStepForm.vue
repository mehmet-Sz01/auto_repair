<template>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <div class="text-center mb-6">
                <ul class="flex justify-between space-x-2 text-sm">
                    <li>
                        <button
                            :class="{'bg-blue-100 text-blue-700': step === 1, 'bg-gray-200 text-gray-700': step !== 1}"
                            class="px-4 py-2 rounded"
                            @click="goToStep(1)"
                        >
                            Müşteri Bilgileri
                        </button>
                    </li>
                    <li>
                        <button
                            :class="{'bg-blue-100 text-blue-700': step === 2, 'bg-gray-200 text-gray-700': step !== 2}"
                            class="px-4 py-2 rounded"
                            @click="goToStep(2)"
                        >
                            Araç Bilgileri
                        </button>
                    </li>
                    <li>
                        <button
                            :class="{'bg-blue-100 text-blue-700': step === 3, 'bg-gray-200 text-gray-700': step !== 3}"
                            class="px-4 py-2 rounded"
                            @click="goToStep(3)"
                        >
                            İş Bilgileri
                        </button>
                    </li>
                </ul>
            </div>

            <CustomerForm v-if="step === 1" :customer="customer" />
            <CarForm v-if="step === 2" :car="car" />
            <WorkForm v-if="step === 3" :work="work" />

            <div class="mt-6 flex justify-between">
                <button
                    v-if="step === 3"
                    @click="submitForm"
                    class="px-4 py-2 bg-blue-500 text-white rounded ml-auto"
                >
                    Kaydet
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import CustomerForm from './CustomerForm.vue';
import CarForm from './CarForm.vue';
import WorkForm from './WorkForm.vue';
import axios from 'axios';

export default {
    components: {
        CustomerForm,
        CarForm,
        WorkForm
    },
    data() {
        return {
            step: 1,
            customer: {
                first_name: '',
                last_name: '',
                number: '',
                email: '',
            },
            car: {
                plate: '',
                brand: '',
                model: '',
                color: '',
                year: '',
                maintenance_date: '',
                inspection_date: ''
            },
            work: {
                work_title: '',
                description: '',
                worker_id: '',
                price: 0,
            }
        };
    },
    methods: {
        goToStep(step) {
            if (step < this.step || this.validateStep(this.step)) {
                this.step = step;
            }
        },
        validateStep(currentStep) {
            if (currentStep === 1) {
                if (!this.customer.first_name || !this.customer.last_name || !this.customer.number || !this.customer.email) {
                    alert("Lütfen müşteri bilgilerini eksiksiz doldurun.");
                    return false;
                }
            } else if (currentStep === 2) {
                if (!this.car.plate || !this.car.brand || !this.car.model || !this.car.color || !this.car.year || !this.car.maintenance_date || !this.car.inspection_date) {
                    alert("Lütfen araç bilgilerini eksiksiz doldurun.");
                    return false;
                }
            } else if (currentStep === 3) {
                if (!this.work.work_title || !this.work.description || !this.work.worker_id || this.work.price <= 0) {
                    alert("Lütfen iş bilgilerini eksiksiz doldurun.");
                    return false;
                }
            }
            return true;
        },
        submitForm() {
            if (this.validateStep(this.step)) {
                axios.post('/api/save-form', {
                    customer: this.customer,
                    car: this.car,
                    work: this.work,
                })
                    .then(response => {
                        alert(response.data.message);
                        // Form başarılı kaydedilince yapılacaklar
                        this.resetForm();
                    })
                    .catch(error => {
                        console.error(error);
                        alert("Kaydetme işlemi sırasında bir hata oluştu.");
                    });
            }
        },
        resetForm() {
            this.step = 1;
            this.customer = { first_name: '', last_name: '', number: '', email: '' };
            this.car = { plate: '', brand: '', model: '', color: '', year:'', maintenance_date: '', inspection_date: '' };
            this.work = { work_title: '', description: '', worker_id: '', price: 0 };
        }
    }
};
</script>

