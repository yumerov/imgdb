<template>
    <form ref="form" @submit.prevent>
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
                    :options="tags" :on-change="validateTags"
                    :has-error="errors.has('tags')"></v-select>
                <span v-if="errors.has('tags')" class="help is-danger"
                    v-text="errors.first('tags')"></span>
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
                <span class="file-name" v-text="image.file.name"
                    v-if="image.file.name"></span>
            </label>
            <span v-if="errors.has('file')" class="help is-danger"
                v-text="errors.first('file')"></span>
            <figure v-if="preview" class="image is-128x128">
                <img :src="preview" id="preview">
            </figure>
        </div>

      <div class="field">
        <div class="control">
            <input class="button" type="submit" value="Create" @click.prevent="submit">
            <router-link v-if="image.lastCreated" class="button is-success"
                :to="image.lastCreated">Created image</router-link>
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
                lastCreated: null,
            },
            tags: [],
            preview: null,
        }
    },
    created() {
        let vm = this;
        axios.get("/api/tags").then((response) => {
            vm.tags = response.data.data;
        });
    },
    methods: {
        resetForm() {
            this.image = {
                title: "",
                tags: null,
                file: {},
                lastCreated: "",
            };

        },
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
        validateTags(value) {
            let vm = this;
            let tags = vm.image.tags = value;
            console.log("tags", tags);
            if (tags == null || tags.length == 0) {
                vm.errors.add("tags", "Select at least 1 tag.");
                return;
            }

            vm.errors.remove("tags");
        },
        formData() {
            let vm = this;
            let formData = new FormData();
            formData.append("title", vm.image.title);
            vm.image.tags.forEach((tag) => {
                formData.append("tags[]", tag.id);
            });
            formData.append("file", vm.image.file);

            return formData;
        },
        submit() {
            let vm = this;

            vm.$validator.validateAll().then((result) => {
                if (!result) {
                    vm.validateTags();
                    return;
                }

                let formData = vm.formData();
                axios.post("/api/images", formData)
                    .then((response) => {
                        vm.resetForm();
                        window.flash("The image is created.", "success");
                        vm.image.lastCreated = "/images/" + response.data.data.slug;
                    })
                    .catch((error) => {
                        let data = error.response.data;
                        let errors = data.errors;
                        for (let field in errors) {
                            vm.errors.add(field, errors[field][0]);
                        }
                    });
            });

        }
    }
}
</script>