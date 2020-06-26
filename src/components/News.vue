<template>
  <div id="app">
    {{ msg }}
    <SimpleComponent />
  </div>
</template>

<script>
import SimpleComponent from "./SimpleComponent.vue";

export default {
  name: "app",
  components: {
    SimpleComponent
  },

  data() {
    return {
      msg: "My Profile Component"
    };
  }
};
</script>