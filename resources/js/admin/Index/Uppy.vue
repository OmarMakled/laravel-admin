<template>
  <div url="url"></div>
</template>

<script>
import Uppy from "@uppy/core";
import Dashboard from "@uppy/dashboard";
import XHRUpload from "@uppy/xhr-upload";

export default {
  props: ["url"],
  data() {
    return {
      uppy: null
    };
  },
  mounted() {
    this.uppy = Uppy({
      autoProceed: false,
      allowMultipleUploads: true,
      debug: false,
      restrictions: {
        maxNumberOfFiles: 10,
        minNumberOfFiles: 1,
        maxFileSize: 2097152,
        allowedFileTypes: ["image/png", "image/jpg", "image/jpeg"]
      }
    })
      .use(Dashboard, {
        inline: false,
        trigger: "#uppy",
        target: "body",
        proudlyDisplayPoweredByUppy: false,
        note: "Images *.png, *.jpg, *.jpeg maxsize 2M",
        closeAfterFinish: true
      })
      .on("complete", result => {
        this.$emit("complete");
        this.uppy.getPlugin("Dashboard").closeModal();
      })
      .on("dashboard:modal-closed", () => {})
      .on("upload-success", (file, body) => {})
      .use(XHRUpload, {
        endpoint: this.url,
        headers: {
          "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]')
        }
      })
      .run();
  }
};
</script>

<style lang="sass">
@import "~@uppy/core/src/style.scss"
@import "~@uppy/dashboard/src/style.scss"
</style>
