<template>
    <div>
        <div class="card">
            <DataTable ref="dt" :value="items" v-model:selection="selectedItems" dataKey="id"
                       class="border-2"
                       :paginator="true" :rows="10" :filters="filters"
                       paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                       :rowsPerPageOptions="[5,10,25]"
                       currentPageReportTemplate="Showing {first} to {last} of {totalRecords} items">

                <template #header>
                    <Toolbar class="mb-4 border-2">
                        <template #start>
                            <div class="flex justify-between w-full">
                                <div class="flex items-center border rounded-lg px-3 py-2 w-80">
                                    <font-awesome-icon :icon="['fas', 'search']" class="mr-2" />
                                    <InputText type="text" v-model="filters['global'].value" placeholder="Search..." class="outline-none w-full text-gray-700" />
                                </div>
                            </div>
                        </template>
                        <template #end>
                            <Button class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg gap-3 hover:bg-green-600" @click="openNew">
                                <font-awesome-icon :icon="['fas', 'plus']" />
                                New
                            </Button>
                        </template>
                    </Toolbar>
                </template>

                <Column v-for="col in columns" :key="col.field" :field="col.field" :header="col.header" :style="col.style"></Column>

                <Column style="min-width:8rem">
                    <template #body="slotProps">
                        <font-awesome-icon :icon="['fas', 'circle-info']" class="mr-2" @click="openInfoDialog(slotProps.data)"/>
                        <font-awesome-icon :icon="['fas', 'pen-to-square']" class="mr-2" @click="editItem(slotProps.data)" />
                        <font-awesome-icon :icon="['fas', 'trash-can']" @click="confirmDeleteItem(slotProps.data)" />
                    </template>
                </Column>
            </DataTable>
        </div>

        <!-- Add/Edit Dialog -->
        <Dialog v-model:visible="itemDialog" :style="{width: '450px'}" header="Item Registration" :modal="true">
            <div v-for="(field, index) in dialogFields" :key="index" class="field">
                <label :for="field.id">{{ field.label }}</label>
                <InputText :id="field.id" class="w-full md:w-30rem mb-5 p-2 border rounded-lg" v-model.trim="item[field.model]" required="true" :invalid="submitted && !item[field.model]" />
                <small class="p-error" v-if="submitted && !item[field.model]">{{ field.label }} is required.</small>
            </div>

            <template #footer>
                <Button @click="hideDialog" class="rounded-lg hover:bg-green-100 p-1 px-2">
                    <font-awesome-icon :icon="['fas', 'xmark']" class="mx-2"/>
                    Cancel
                </Button>
                <Button @click="saveItem" class="rounded-lg hover:bg-green-100 p-1 px-2">
                    <font-awesome-icon :icon="['fas', 'check']" class="mx-2"/>
                    Save
                </Button>
            </template>
        </Dialog>

        <!-- Delete Confirmation Dialog -->
        <Dialog v-model:visible="deleteItemDialog" :style="{width: '450px'}" header="Confirm" :modal="true">
            <div class="confirmation-content">
                <i class="fa fa-exclamation-triangle mr-3" style="font-size: 2rem" />
                <span v-if="item">Are you sure you want to delete ?</span>
            </div>
            <template #footer>
                <Button @click="deleteItemDialog = false" class="rounded-lg hover:bg-green-100 p-1 px-2">
                    <font-awesome-icon :icon="['fas', 'xmark']" class="mx-2"/>
                    No
                </Button>
                <Button label="Yes" text @click="deleteItem" class="rounded-lg hover:bg-green-100 p-1 px-2">
                    <font-awesome-icon :icon="['fas', 'check']" class="mx-2"/>
                    Yes
                </Button>
            </template>
        </Dialog>

        <!-- Info Dialog -->
        <Dialog v-model:visible="infoDialog" :style="{width: '450px'}" header="İş Detayları" :modal="true">
            <div v-for="(field, index) in infoDialogFields" :key="index" class="field">
                {{infoDialogFields.field}}
                <label :for="field.id" class="font-bold">{{ field.label }}:</label>
                <p class="w-full md:w-30rem mb-5 p-2 border rounded-lg bg-gray-100">{{ item[field.model] }}</p>
            </div>
            <template #footer>
                <Button @click="infoDialog = false" class="rounded-lg hover:bg-green-100 p-1 px-2">
                    <font-awesome-icon :icon="['fas', 'xmark']" class="mx-2"/>
                    Kapat
                </Button>
            </template>
        </Dialog>

    </div>
</template>

<script setup>
import { ref, reactive, watch } from 'vue';
import { FilterMatchMode } from 'primevue/api';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Toolbar from 'primevue/toolbar';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';

const props = defineProps({
    infoDialogFields: Array,
    initialItems: Array,
    columns: Array,
    dialogFields: Array,
    onItemSaved: Function,
    onItemDeleted: Function
});

const items = ref([...props.initialItems]);
const itemDialog = ref(false);
const infoDialog = ref(false);
const deleteItemDialog = ref(false);
const item = reactive({});
const selectedItems = ref([]);
const filters = reactive({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});
const submitted = ref(false);

watch(() => props.initialItems, (newItems) => {
    items.value = [...newItems];
}, { immediate: true });

const openInfoDialog = (data) => {
    Object.assign(item, data);
    infoDialog.value = true;
};

const openNew = () => {
    Object.keys(item).forEach(key => item[key] = '');
    submitted.value = false;
    itemDialog.value = true;
};

const hideDialog = () => {
    itemDialog.value = false;
    submitted.value = false;
};

const saveItem = async () => {
    submitted.value = true;
    if (Object.keys(item).length > 0) {
        await props.onItemSaved({ ...item });
        hideDialog();
    }
};

const confirmDeleteItem = (data) => {
    Object.assign(item, data);
    deleteItemDialog.value = true;
};

const deleteItem = async () => {
    await props.onItemDeleted({ ...item });
    deleteItemDialog.value = false;
    Object.keys(item).forEach(key => item[key] = '');
};

const editItem = (data) => {
    Object.assign(item, data);
    itemDialog.value = true;
};
</script>

<style scoped>
.card {
    padding: 1rem;
}
</style>
