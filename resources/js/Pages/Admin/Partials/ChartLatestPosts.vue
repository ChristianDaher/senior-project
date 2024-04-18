<script setup>
import { onMounted, ref } from "vue";
import * as echarts from "echarts/core";
import { BarChart } from "echarts/charts";
import {
  GridComponent,
  TitleComponent,
  TooltipComponent,
} from "echarts/components";
import { CanvasRenderer } from "echarts/renderers";

const props = defineProps({
  stats: {
    type: Object,
    default: () => {},
  },
});

echarts.use([
  BarChart,
  GridComponent,
  TitleComponent,
  TooltipComponent,
  CanvasRenderer,
]);

const postsChart = ref(null);

onMounted(() => {
  const postsChartInstance = echarts.init(postsChart.value);

  postsChartInstance.setOption({
    title: {
      text: "Posts per Day for the Last 7 Days",
    },
    tooltip: {},
    xAxis: {
      data: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
    },
    yAxis: {},
    series: [
      {
        name: "Posts",
        type: "bar",
        data: [5, 20, 36, 10, 10, 20, 15],
      },
    ],
  });

  window.addEventListener("resize", () => {
    postsChartInstance.resize();
  });
});
</script>
<template>
  <div ref="postsChart" />
</template>
