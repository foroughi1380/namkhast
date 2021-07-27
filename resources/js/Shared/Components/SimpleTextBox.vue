<template>
  <div class="form-group">
    <div class="controls">
      <label>{{ label }}</label>
      <input :type="type ? type : 'text'" :name="name" class="form-control" :placeholder="placeholder" :value="modelValue" :maxlength="maxlen" @input="this.$emit('update:modelValue', e.target.value)">
    </div>
  </div>
</template>

<script>
export default {
  name: "SimpleTextBox",
  props : ['name' , 'placeholder' , 'label' , 'modelValue' , 'type' , 'maxlen']
}
</script>

<style scoped>

</style>