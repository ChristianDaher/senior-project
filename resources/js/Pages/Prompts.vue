<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import { ref, computed } from "vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import Spinner from "@/Components/Spinner.vue";
import MarkdownRenderer from "vue-markdown-render";

const freePrompt = ref("");
const freeResponse = ref("");
const freeErrorMessage = ref("");
const isFreeLoading = ref(false);

const isSubmitFreeDisabled = computed(() => {
  return !freePrompt.value || isFreeLoading.value;
});

function submitFree() {
  isFreeLoading.value = true;
  axios
    .post(route("prompts.store.free"), { prompt: freePrompt.value })
    .then((response) => {
      freeResponse.value = response.data.response;
    })
    .catch((error) => {
      freeErrorMessage.value = error.response.data.message;
    })
    .finally(() => {
      isFreeLoading.value = false;
    });
}
</script>

<template>
  <Head title="Prompt" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-primary-100 leading-tight">
        Get AI Generated Prompts
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-primary-100">
            <form @submit.prevent="submitFree" class="sm:w-3/4">
              <h1 class="mb-1 pl-1">
                Use this <span class="text-accent-100">free</span> version to
                test our services.
              </h1>
              <Input
                v-model="freePrompt"
                id="freePrompt"
                type="textarea"
                label="Eg: Give me a step-by-step guide to farm tomatoes in my small backyard garden."
                position="alone"
              />
              <div
                class="flex items-center mt-4"
                :class="[freeErrorMessage ? 'justify-between' : 'justify-end']"
              >
                <p class="text-sm text-error-100">{{ freeErrorMessage }}</p>
                <div class="flex items-center gap-4">
                  <Spinner v-if="isFreeLoading" />
                  <ButtonPrimary
                    :class="{
                      'bg-disabled-100': isSubmitFreeDisabled,
                    }"
                    :disabled="isSubmitFreeDisabled"
                  >
                    Submit
                  </ButtonPrimary>
                </div>
              </div>
            </form>
            <MarkdownRenderer
              id="markdown"
              :source="freeResponse"
              v-show="freeResponse"
              class="sm:w-3/4 my-4 space-y-2"
            />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
#markdown p{
  color: #00854a !important;
}
</style>
