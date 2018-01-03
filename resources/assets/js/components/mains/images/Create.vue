<template>
    <form ref="form" @submit.prevent>
        <!-- @include("shared.success") -->
      <!-- {{ csrf_field() }} -->
        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input :class="{'input': true, 'is-danger': errors.has('title')}"
                    name="title" type="text" placeholder="Doggo"
                    v-model="image.title" v-validate="'required'">
                <span v-if="errors.has('title')" class="help is-danger"
                        v-text="errors.first('title')"></span>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <v-select multiple label="name" value="id" v-model="image.tags"
                    :options="tags" class="is-danger"></v-select>
            </div>
        </div>

        <div :class="{'file': true, 'is-danger': errors.has('file')}">
            <label class="file-label">
                <input class="file-input" type="file" name="file"
                    @change="handleFile" v-validate="'required|image'">
                <span class="file-cta">
                    <span class="file-icon"><i class="fa fa-upload"></i></span>
                    <span class="file-label">Choose a file…</span>
                </span>
                <span class="file-name" v-text="image.file.name"></span>
            </label>
            <span v-if="errors.has('file')" class="help is-danger"
                    v-text="errors.first('file')"></span>
            <figure class="image is-128x128">
                <img :src="preview" id="preview">
            </figure>
        </div>

      <div class="field">
        <div class="control">
          <input type="submit" value="Create" @click.prevent="submit">
        </div>
      </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            image: {
                title: "",
                tags: null,
                file: {},
            },
            tags: [],
            preview: null,
        }
    },
    created() {
        let vm = this;
        axios
            .get("/api/tags")
            .then((response) => {
                vm.tags = response.data.data
            });
    },
    methods: {
        handleFile(event) {
            let vm = this;
            let file = event.target.files[0];
            if (file.type.search("image/") != -1) {
                vm.image.file = file;
                vm.renderFile();
            }
        },
        renderFile() {
            let vm = this;
            let file = vm.image.file;

            if (file) {
                let reader = new FileReader();
                reader.onload = (e) => { vm.preview = e.target.result }
                reader.readAsDataURL(file);
            }
        },
        formData() {
            let vm = this;
            let formData = new FormData();
            formData.append("title", vm.image.title);
            vm.image.tags.forEach((tag) => {
                formData.append("tags", tag.id);
            });
            formData.append("file", vm.image.file);

            return formData;
        },
        submit() {
            let vm = this;
            let formData = vm.formData();
            axios.post("/api/images", formData)
                .then((e) => {
                    debugger;
                });
        }
    }
}
</script>