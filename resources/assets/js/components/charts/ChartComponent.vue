<template>
<div id="container-gant"> </div>
</template>
<script>
import Highcharts from "highcharts";
export default {
  data() {
    return {
      graphsCategoryData: [],
      graphsCategoryData2: [],
      graphsCategoryData3: [
        42.4,
        33.2,
        34.5,
        39.7,
        52.6,
        75.5,
        57.4,
        60.4,
        47.6,
        39.1,
        46.8,
        51.1
      ],
      graphsCategoryDat4: [],
      graphscolumn: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ]
    };
  },
  methods: {
    loadCategoryColumn() {
      this.graphscolumn = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ];
    },

    loadCategoryData() {
      this.graphsCategoryData = [
        49.9,
        71.5,
        106.4,
        129.2,
        144.0,
        176.0,
        135.6,
        148.5,
        216.4,
        194.1,
        95.6,
        54.4
      ];
    },
    loadCategoryData2() {
      this.graphsCategoryData2 = [
        83.6,
        78.8,
        98.5,
        93.4,
        106.0,
        84.5,
        105.0,
        104.3,
        91.2,
        83.5,
        106.6,
        92.3
      ];
    },
    loadCategoryData3() {
      this.graphsCategoryData3 = [
        48.9,
        38.8,
        39.3,
        41.4,
        47.0,
        48.3,
        59.0,
        59.6,
        52.4,
        65.2,
        59.3,
        51.2
      ];
    },
    loadCategoryData4() {
      this.graphsCategoryDat4 = [
        42.4,
        33.2,
        34.5,
        39.7,
        52.6,
        75.5,
        57.4,
        60.4,
        47.6,
        39.1,
        46.8,
        51.1
      ];
    },
    loadWholeChart() {}
  },
  mounted() {
    Highcharts.chart("container-gant", {
      chart: {
        type: "column"
      },
      color: [
        "#2b908f",
        "#90ee7e",
        "#f45b5b",
        "#7798BF",
        "#aaeeee",
        "#ff0066",
        "#eeaaee",
        "#55BF3B",
        "#DF5353",
        "#7798BF",
        "#aaeeee"
      ],
      title: {
        text: "Monthly Average Rainfall"
      },
      subtitle: {
        text: "Source: WorldClimate.com"
      },
      xAxis: {
        categories: this.graphscolumn,
        crosshair: true
      },
      yAxis: {
        min: 0,
        title: {
          text: "Rainfall (mm)"
        }
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat:
          '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: "</table>",
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: [
        {
          name: "Tokyo",
          data: this.graphsCategoryData
        },
        {
          name: "New York",
          data: this.graphsCategoryData2
        },
        {
          name: "London",
          data: this.loadCategoryData3
        },
        {
          name: "Berlin",
          data: this.loadCategoryData4
        }
      ]
    });
  }
};
</script>