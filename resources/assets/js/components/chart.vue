<template>
  <div>
    <h1>Chart Demo</h1>

    <div class="grid">
      <ChartBar />
      <ChartDoughnut />
      <ChartLine />
    </div>
  </div>
</template>

<script>
import ChartBar from "../components/chartjs/chart-bar";
import ChartDoughnut from "../components/chartjs/chart-doughnut";
import ChartLine from "../components/chartjs/chart-line";

export default {
  components: {
    ChartBar,
    ChartDoughnut,
    ChartLine
  }
};
</script>

<style lang="scss" scoped>
.grid {
  display: grid;
  row-gap: 2rem;
}
</style>
