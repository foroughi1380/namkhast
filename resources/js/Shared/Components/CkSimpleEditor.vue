<template>
  <ckeditor tag-name="textarea" rows="5" :editor="editor" :config="editorConfig" id="description" maxLenght="20" class="form-control" v-model="description" :disabled="inProcess"></ckeditor>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  name: "CkSimpleEditor",
  props : ['modelValue'],
  created() {
    this.description = this.modelValue;
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        toolbar: [
          'heading', '|',
          'bold', 'italic', 'link', '|',
          'outdent', 'indent', '|',
          'insertTable', '|',
          'blockQuote', '|',
          'undo', 'redo'
        ],
        language: 'fa',
      },
      description : ""
    }
  },
  watch : {
    description(){
      this.$emit("update:modelValue" , this.description)
    }
  }
}
</script>

<style>
.ck-editor__editable {
  min-height: 15rem;
  max-height: 15rem;
  overflow: scroll;
}

</style>