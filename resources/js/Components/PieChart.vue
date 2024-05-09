<script setup>
import { onMounted, ref } from "vue";
import * as echarts from "echarts/core";
import { PieChart } from "echarts/charts";
import {
  TitleComponent,
  TooltipComponent,
  LegendComponent,
} from "echarts/components";
import { CanvasRenderer } from "echarts/renderers";

const props = defineProps({
  stats: {
    type: Object,
    default: () => {},
  },
  title: {
    type: String,
    required: true,
  },
  formatter: {
    type: String,
    default: "{b} <br/> {c} ({d}%)",
  },
  name: {
    type: String,
    required: true,
  },
});

const seriesData = Object.entries(props.stats).map(([title, count]) => ({
  value: count,
  name: title,
}));

echarts.use([
  PieChart,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  CanvasRenderer,
]);

const usersChart = ref(null);

onMounted(() => {
  const usersChartInstance = echarts.init(usersChart.value);

  usersChartInstance.setOption({
    title: {
      text: props.title,
    },
    tooltip: {
      trigger: "item",
      formatter: props.formatter,
    },
    legend: {
      orient: "vertical",
      left: "right",
      data: Object.keys(props.stats),
    },
    series: [
      {
        name: props.name,
        type: "pie",
        radius: "65%",
        data: seriesData,
        label: {
          show: false,
        },
        emphasis: {
          itemStyle: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowColor: "rgba(0, 0, 0, 0.5)",
          },
        },
      },
    ],
  });

  window.addEventListener("resize", () => {
    usersChartInstance.resize();
  });
});
</script>
<template>
  <div ref="usersChart" />
</template>
