<template>
  <div class="card">
    <div class="card-body">
      <h2 class="card-title">Line</h2>

      <div class="btn-group btn-group-toggle" :styles="myStyles">
        <label
          v-for="(item, index) in btn"
          :key="index"
          :class="{ active: item.value == radio }"
          class="btn btn-success"
             >
          <input
            v-model="radio"
            :name="dataLabel"
            :value="item.value"
            type="radio"
          />
          {{ item.label }}
        </label>
      </div>
    </div>

    <div class="card-img-bottom" >
      <chartjs-line
        :backgroundcolor="bgColor"
        :beginzero="beginZero"
        :bind="true"
        :bordercolor="borderColor"
        :data="data[radio]"
        :datalabel="dataLabel"
        :labels="labels[radio]"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      height: 300,
      bgColor: "#81894e",
      beginZero: true,
      maintainAspectRatio: false,
      responsive: true,
      borderColor: "#81894e",
      btn: [
        { label: "Today", value: "day" },
        { label: "This Week", value: "week" }
      ],
      option: {
        responsive: true, // my new default options
        maintainAspectRatio: false // my new default options
      },
      data: {
        day: [1, 3, 5, 3, 1],
        week: [12, 14, 16, 18, 11, 13, 15]
      },
      dataLabel: "Foo",
      labels: {
        day: [8, 10, 12, 14, 16],
        week: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
      },
      radio: "day"
    };
  },
  methods: {
    increase() {
      this.height += 10;
    }
  },
  computed: {
    myStyles() {
      return {
        height: `${this.height}px`,
        position: "relative"
      };
    }
  }
};
</script>
