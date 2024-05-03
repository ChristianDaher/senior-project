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
import { format } from "date-fns";

const props = defineProps({
  stats: {
    type: Object,
    default: () => {},
  },
});

const days = props.stats?.map((item) => format(new Date(item.date), "eeee").slice(0, 3).toUpperCase());
const counts = props.stats?.map((item) => item.count);

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
      data: days,
    },
    yAxis: {},
    series: [
      {
        name: "Posts",
        type: "bar",
        data: counts,
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
