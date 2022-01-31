<template>
  <div class="card shadow">
    <div v-if="title" class="card-header bg-card-head">
      <h4 class="bg-card-head">{{ title }}</h4>
    </div>
    <div class="card-body bg-card-body">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",

  props: {
    title: { type: String, default: null },
  },
};
</script>
<style scoped>
.shadow {
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
  border-radius: 5px;
}
.bg-card-body {
  background-color: cadetblue;
}
.bg-card-head {
  color: darkcyan;
  font-style: italic;
}
</style>
