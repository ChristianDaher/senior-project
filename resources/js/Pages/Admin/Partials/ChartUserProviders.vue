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
  providersData: {
    type: Object,
    default: () => {},
  },
});

const seriesData = Object.entries(props.providersData).map(([name, value]) => ({
  value,
  name,
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
      text: "User Providers",
    },
    tooltip: {
      trigger: "item",
      formatter: "{a} from {b} <br/> {c} ({d}%)",
    },
    legend: {
      orient: "vertical",
      left: "right",
      data: Object.keys(props.providersData),
    },
    series: [
      {
        name: "Users",
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
