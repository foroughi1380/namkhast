<template>
  <button @click="onClick" class="btn btn-primary  btn-inline">
    <span  v-if="! wait" v-text="text"></span>
    <hollow-dots-spinner v-else
                         :animation-duration="1000"
                         :dot-size="10"
                         :dots-num="3"
                         color="#ffffff"
    />
  </button>
</template>

<script>
export default {
  name: "WaitButton",
  props : ['wait', 'text' , 'onClick']
}
</script>

<style scoped>

</style>