<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import ButtonSecondary from "@/Components/Buttons/ButtonSecondary.vue";
import ButtonDanger from "@/Components/Buttons/ButtonDanger.vue";
import Modal from "@/Components/Modal.vue";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";

defineProps({
  faqs: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({
  order: null,
  question: null,
  answer: null,
});

const isCreateModalOpen = ref(false);
const isEditModalOpen = ref(false);
const isDeleteModalOpen = ref(false);

const faqToEdit = ref(null);
const faqToDelete = ref(null);

function openCreateModal() {
  isCreateModalOpen.value = true;
}

function openEditModal(faq) {
  faqToEdit.value = faq;
  isEditModalOpen.value = true;
}

function openDeleteModal(faq) {
  faqToDelete.value = faq;
  isDeleteModalOpen.value = true;
}

function closeCreateModal(){
  isCreateModalOpen.value = false;
}

function closeEditModal() {
  faqToEdit.value = null;
  isEditModalOpen.value = false;
}

function closeDeleteModal() {
  faqToDelete.value = null;
  isDeleteModalOpen.value = false;
}
</script>

<template>
  <Head title="Admin Dashboard" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-primary-100 leading-tight">
        Frequently Asked Questions
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end py-4">
          <ButtonPrimary @click="openCreateModal"> Add FAQ </ButtonPrimary>
        </div>
        <div class="bg-base-100 shadow-sm sm:rounded-lg">
          <div
            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
          >
            <table class="min-w-full divide-y divide-secondary-100">
              <thead>
                <tr>
                  <th
                    scope="col"
                    class="py-3.5 pl-4 pr-3 text-left text-lg font-semibold text-primary-100 sm:pl-0"
                  >
                    Order
                  </th>
                  <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-lg font-semibold text-primary-100"
                  >
                    Question
                  </th>
                  <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-lg font-semibold text-primary-100"
                  >
                    Answer
                  </th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0" />
                </tr>
              </thead>
              <tbody class="divide-y divide-disabled-100">
                <tr v-for="faq in faqs" :key="faq.id">
                  <td
                    class="font-medium text-primary-100 text-center"
                  >
                    {{ faq.order }}
                  </td>
                  <td class="p-2 text-gray-500">
                    {{ faq.question }}
                  </td>
                  <td class="p-2 text-gray-500">
                    {{ faq.answer }}
                  </td>
                  <td class="flex gap-1 p-2">
                    <div
                      class="rounded-md bg-accent-200 p-2 cursor-pointer hover:bg-accent-300 custom-transition"
                      @click="openEditModal(faq)"
                    >
                      <PencilSquareIcon
                        class="h-4 w-4 text-white"
                        aria-hidden="true"
                      />
                    </div>
                    <div
                      class="rounded-md bg-error-100 p-2 cursor-pointer hover:bg-error-200 custom-transition"
                      @click="openDeleteModal(faq)"
                    >
                      <TrashIcon
                        class="h-4 w-4 text-white"
                        aria-hidden="true"
                      />
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <Modal :show="isCreateModalOpen" @close="closeCreateModal">
        <form class="flex justify-end gap-4 p-6" @submit.prevent="confirmCreate">
          <ButtonSecondary @click="closeCreateModal"> Cancel </ButtonSecondary>
          <ButtonPrimary
            :disabled="form.processing"
            :class="{ 'bg-disabled-100': form.processing }"
          >
            Create
          </ButtonPrimary>
        </form>
    </Modal>
    <Modal :show="isEditModalOpen" @close="closeEditModal">
        <form class="flex justify-end gap-4 p-6" @submit.prevent="confirmEdit">
          <ButtonSecondary @click="closeEditModal"> Cancel </ButtonSecondary>
          <ButtonPrimary
            :disabled="form.processing"
            :class="{ 'bg-disabled-100': form.processing }"
          >
            Edit
          </ButtonPrimary>
        </form>
    </Modal>
    <Modal :show="isDeleteModalOpen" @close="closeDeleteModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-primary-100">
          Are you sure you want to delete this FAQ?
        </h2>
        <form class="flex justify-end gap-4" @submit.prevent="confirmDelete">
          <ButtonSecondary @click="closeDeleteModal"> Cancel </ButtonSecondary>
          <ButtonDanger
            :disabled="form.processing"
            :class="{ 'bg-disabled-100': form.processing }"
          >
            Delete
          </ButtonDanger>
        </form>
      </div>
    </Modal>
  </AuthenticatedLayout>
</template>
