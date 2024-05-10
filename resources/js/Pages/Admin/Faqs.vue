<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";

defineProps({
  faqs: {
    type: Array,
    default: () => [],
  },
});

const faqToEdit = ref(null);
const faqToDelete = ref(null);

function openEditModal(faq) {
  faqToEdit.value = faq;
}

function openDeleteModal(faq) {
  faqToDelete.value = faq;
}

function closeEditModal() {
  faqToEdit.value = null;
}

function closeDeleteModal() {
  faqToDelete.value = null;
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
          <ButtonPrimary> Add FAQ </ButtonPrimary>
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
                      class="rounded-md bg-accent-200 p-2 cursor-pointer"
                      @click="openEditModal(faq)"
                    >
                      <PencilSquareIcon
                        class="h-4 w-4 text-white"
                        aria-hidden="true"
                      />
                    </div>
                    <div
                      class="rounded-md bg-error-100 p-2 cursor-pointer"
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
  </AuthenticatedLayout>
</template>
