<script setup>
import { reactive, ref, computed, watch } from "vue";
import Spinner from "@/Components/Spinner.vue";
import Input from "@/Components/Input.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import Modal from "@/Components/Modal.vue";
import { ArrowRightIcon } from "@heroicons/vue/20/solid";

const prompt = reactive({
  n: 1000,
  p: 500,
  k: 1000,
  h: 30,
  temp: 20,
  ph: 7,
  rain: 20,
});

const response = ref("");
const errorMessage = ref("");
const isLoading = ref(false);
const isNewlySubmitted = ref(false);
const isModalOpen = ref(false);

const isSubmitDisabled = computed(() => {
  return (
    (!prompt.n && prompt.n !== 0) ||
    (!prompt.p && prompt.p !== 0) ||
    (!prompt.k && prompt.k !== 0) ||
    (!prompt.h && prompt.h !== 0) ||
    (!prompt.temp && prompt.temp !== 0) ||
    (!prompt.ph && prompt.ph !== 0) ||
    (!prompt.rain && prompt.rain !== 0) ||
    isLoading.value ||
    isNewlySubmitted.value
  );
});

watch(prompt, () => {
  isNewlySubmitted.value = false;
});

function submit() {
  isLoading.value = true;
  response.value = null;
  axios
    .post(route("prompts.store.paid"), prompt)
    .then((res) => {
      response.value = res.data.response;
      openModal();
      isNewlySubmitted.value = true;
    })
    .catch((error) => {
      errorMessage.value = error.response.data.message;
    })
    .finally(() => {
      isLoading.value = false;
    });
}

function openModal() {
  isModalOpen.value = true;
}

function closeModal() {
  isModalOpen.value = false;
}
</script>

<template>
  <div>
    <form @submit.prevent="submit" class="sm:w-3/4">
      <h1 class="mb-1 pl-1">
        Use this <span class="text-accent-100">paid</span> version for more
        accurate results.
      </h1>
      <Input
        v-model="prompt.n"
        id="promptN"
        type="number"
        label="Nitrogen (mg/kg)"
        position="first"
        :min="0"
        :step="0.01"
      />
      <Input
        v-model="prompt.p"
        id="promptP"
        type="number"
        label="Phosphorus (mg/kg)"
        position="middle"
        :min="0"
        :step="0.01"
      />
      <Input
        v-model="prompt.k"
        id="promptK"
        type="number"
        label="Potassium (mg/kg)"
        position="middle"
        :min="0"
        :step="0.01"
      />
      <Input
        v-model="prompt.h"
        id="promptH"
        type="number"
        label="Humidity (%)"
        position="middle"
        :min="0"
        :max="100"
        :step="0.1"
      />
      <Input
        v-model="prompt.temp"
        id="promptTemp"
        type="number"
        label="Temperature (°C)"
        position="middle"
        :step="0.1"
      />
      <Input
        v-model="prompt.ph"
        id="promptPh"
        type="number"
        label="Acidity of the soil (pH)"
        position="middle"
        :min="0"
        :max="14"
        :step="0.01"
      />
      <Input
        v-model="prompt.rain"
        id="promptRain"
        type="number"
        label="Rainfall (mm)"
        position="last"
        :min="0"
        :step="0.01"
      />
      <div
        class="flex items-center mt-4"
        :class="[errorMessage ? 'justify-between' : 'justify-end']"
      >
        <p class="text-sm text-error-100">{{ errorMessage }}</p>
        <div class="flex items-center gap-4">
          <p
            class="text-sm text-accent-200 hover:text-accent-100 underline cursor-pointer custom-transition"
            @click="openModal"
            v-if="response"
          >
            View again
          </p>
          <Spinner v-if="isLoading" />
          <ButtonPrimary
            :class="{
              'bg-disabled-100': isSubmitDisabled,
            }"
            :disabled="isSubmitDisabled"
          >
            Submit
          </ButtonPrimary>
        </div>
      </div>
    </form>
    <Modal :show="isModalOpen" @close="closeModal">
      <img
        class="rounded-t-lg"
        v-if="response.suggestions.img_link"
        :src="response.suggestions.img_link"
        alt="Crop"
      />
      <div class="p-5">
        <h5
          v-if="response.predicted_crop"
          class="mb-2 text-2xl font-bold tracking-tight text-primary-100 capitalize"
        >
          {{ response.predicted_crop }}
        </h5>
        <p
          class="mb-3 font-normal text-secondary-100"
          v-if="response.suggestions.description"
        >
          {{ response.suggestions.description }}
        </p>
        <p
          class="mb-3 font-normal text-secondary-100"
          v-if="response.suggestions.best_season_for_planting"
        >
          Best Season:
          {{ response.suggestions.best_season_for_planting }}
        </p>
        <p class="mb-3 font-normal text-secondary-100" v-if="response.suggestions.ideal_weather">
          Ideal Weather: {{ response.suggestions.ideal_weather }}
        </p>
        <a
          :href="response.suggestions.link"
          target="_blank"
          class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-center text-base-100 bg-accent-200 rounded-lg hover:bg-accent-300 focus:ring-2 ring-offset-2 focus:outline-none focus:ring-accent-200"
        >
          Read more
          <ArrowRightIcon class="w-4 h-4" />
        </a>
      </div>
    </Modal>
  </div>
</template>
