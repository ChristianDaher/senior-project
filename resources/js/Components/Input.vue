<script setup>
import { ref } from "vue";
import { computed } from "vue";

defineEmits(["input"]);

const props = defineProps({
  id: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: "text",
  },
  label: {
    type: String,
    required: true,
  },
  position: {
    type: String,
    default: "middle",
  },
  autocomplete: {
    type: String,
    default: "off",
  },
  refObject: {
    type: Object,
    default: null,
  },
});

const id = props.id + Math.random().toString(36).substring(7);

const model = defineModel({
  type: String,
  required: true,
});

const positionClasses = computed(() => {
  return {
    first: "rounded-t-md",
    middle: "",
    last: "rounded-b-md",
    alone: "rounded-md",
  }[props.position];
});
</script>
<template>
  <div class="relative">
    <input
      :ref="refObject"
      :id="id"
      :type="type"
      class="peer block w-full p-4 bg-base-100 border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
      :class="positionClasses"
      v-model="model"
      :autofocus="position === 'first' || position === 'alone'"
      required
      :autocomplete="autocomplete"
      @input="$emit('input')"
    />
    <label
      :for="id"
      class="cursor-text text-disabled-100 absolute z-20 top-3 left-4 text-lg peer-focus:top-0 peer-focus:text-sm custom-transition"
      :class="{ '!top-0 text-sm': model }"
      >{{ label }}</label
    >
  </div>
</template>
