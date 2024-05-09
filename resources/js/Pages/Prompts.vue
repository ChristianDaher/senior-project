<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import { ref, computed, reactive } from "vue";
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
      freeResponse.value = response.data.response.text;
    })
    .catch((error) => {
      freeErrorMessage.value = error.response.data.message;
    })
    .finally(() => {
      isFreeLoading.value = false;
    });
}

const paidPrompt = reactive({
  n: 1000,
  p: 500,
  k: 1000,
  h: 30,
  temp: 20,
  ph: 7,
  rain: 20,
});
const paidResponse = ref("");
const paidErrorMessage = ref("");
const isPaidLoading = ref(false);

const isSubmitPaidDisabled = computed(() => {
  return (
    (!paidPrompt.n && paidPrompt.n !== 0) ||
    (!paidPrompt.p && paidPrompt.p !== 0) ||
    (!paidPrompt.k && paidPrompt.k !== 0) ||
    (!paidPrompt.h && paidPrompt.h !== 0) ||
    (!paidPrompt.temp && paidPrompt.temp !== 0) ||
    (!paidPrompt.ph && paidPrompt.ph !== 0) ||
    (!paidPrompt.rain && paidPrompt.rain !== 0) ||
    isPaidLoading.value
  );
});

function submitPaid() {
  isPaidLoading.value = true;
  axios
    .post(route("prompts.store.paid"), paidPrompt)
    .then((response) => {
      paidResponse.value = response.data.response;
    })
    .catch((error) => {
      paidErrorMessage.value = error.response.data.message;
    })
    .finally(() => {
      isPaidLoading.value = false;
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
              class="sm:w-3/4 my-4"
            />
            <form @submit.prevent="submitPaid" class="sm:w-3/4">
              <h1 class="mb-1 pl-1">
                Use this <span class="text-accent-100">paid</span> version for
                more accurate results.
              </h1>
              <Input
                v-model="paidPrompt.n"
                id="paidPromptN"
                type="number"
                label="Nitrogen (mg/kg)"
                position="first"
                :min="0"
                :step="0.01"
              />
              <Input
                v-model="paidPrompt.p"
                id="paidPromptP"
                type="number"
                label="Phosphorus (mg/kg)"
                position="middle"
                :min="0"
                :step="0.01"
              />
              <Input
                v-model="paidPrompt.k"
                id="paidPromptK"
                type="number"
                label="Potassium (mg/kg)"
                position="middle"
                :min="0"
                :step="0.01"
              />
              <Input
                v-model="paidPrompt.h"
                id="paidPromptH"
                type="number"
                label="Humidity (%)"
                position="middle"
                :min="0"
                :max="100"
                :step="0.1"
              />
              <Input
                v-model="paidPrompt.temp"
                id="paidPromptTemp"
                type="number"
                label="Temperature (°C)"
                position="middle"
                :step="0.1"
              />
              <Input
                v-model="paidPrompt.ph"
                id="paidPromptPh"
                type="number"
                label="Acidity of the soil (pH)"
                position="middle"
                :min="0"
                :max="14"
                :step="0.01"
              />
              <Input
                v-model="paidPrompt.rain"
                id="paidPromptRain"
                type="number"
                label="Rainfall (mm)"
                position="last"
                :min="0"
                :step="0.01"
              />
              <div
                class="flex items-center mt-4"
                :class="[paidErrorMessage ? 'justify-between' : 'justify-end']"
              >
                <p class="text-sm text-error-100">{{ paidErrorMessage }}</p>
                <div class="flex items-center gap-4">
                  <Spinner v-if="isPaidLoading" />
                  <ButtonPrimary
                    :class="{
                      'bg-disabled-100': isSubmitPaidDisabled,
                    }"
                    :disabled="isSubmitPaidDisabled"
                  >
                    Submit
                  </ButtonPrimary>
                </div>
              </div>
            </form>
            <div v-if="paidResponse">
              <p>Predicted Crop: {{ paidResponse.predicted_crop }}</p>
              <ul>
                <li>
                  Best Season for Plating:
                  {{ paidResponse.suggestions.best_season_for_planting }}
                </li>
                <li>Description: {{ paidResponse.suggestions.description }}</li>
                <li>
                  Ideal Weather: {{ paidResponse.suggestions.ideal_weather }}
                </li>
                <li><img :src="paidResponse.suggestions.img_link" /></li>
                <li>
                  More Reference:
                  <a :href="paidResponse.suggestions.link" target="_blank">{{
                    paidResponse.suggestions.link
                  }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style>
#markdown strong {
  @apply text-accent-100 mb-2;
}

#markdown ul {
  list-style-type: disc;
  padding-left: 1.5rem;
  margin-bottom: 1rem;
}

#markdown ol {
  list-style-type: decimal;
  padding-left: 1.5rem;
  margin-bottom: 1rem;
}
</style>
