<template>
    <div>
   <div>
    <div class="title-row">
            <span>Chart title:</span>
            <input type="text" v-model="title">
            <span>Estilo:</span>
            <v-select :options="options" v-model="modo" crearable=False></v-select>
        </div>
         
        <highcharts :options="chartOptions" ></highcharts>
    </div>
    </div>
</template>

<script>
import Highcharts from "highcharts";
export default {
  data() {
    return {
      title: "",
      options: ["spline", "line", "bar", "pie"],
      modo: "spline",
      series: [
        {
          data: [15, 3, 6, 2, 6, 4, 5, 5]
        },
        {
          data: [12, 1, 4, 3, 8, 1, 3, 7]
        }
      ]
    };
  },
  computed: {
    chartOptions() {
      return {
        chart: { type: this.modo },
        title: { text: this.title },
        series: this.series
      };
    }
  }
};
</script>

<style lang="scss" scoped>
</style>