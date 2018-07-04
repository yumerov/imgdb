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
                    @change="handleFile" v-validate="'image'">
                <span class="file-cta">
                    <span class="file-icon"><i class="fa fa-upload"></i></span>
                    <span class="file-label">Choose a file…</span>
                </span>
                <span class="file-name" v-text="image.file.name"
                    v-if="image.file.name || false"></span>
            </label>
            <span v-if="errors.has('file')" class="help is-danger"
                v-text="errors.first('file')"></span>
            <figure v-if="preview" class="image is-128x128">
                <img :src="preview" id="preview">
            </figure>
        </div>

      <div class="field">
        <div class="control">
            <input class="button" type="submit" value="Update"
                @click.prevent="submit">
        </div>
      </div>
    </form>
</template>

<script>
import { Edit as store } from "../../../stores/Images.js";
import { redirect, previewFile, validate, errors } from "../../../mixins.js";
export default {
    computed: {
        image() { return this.$store.state.image },
        tags() { return this.$store.state.tags },
        preview() { return this.$store.state.preview },
    },
    store,
    mixins: [redirect, previewFile, validate],
    created() {
        this.$store.dispatch("load", this.$route.params.slug);
    },
    methods: {
        submit() {
            let vm = this;
            vm.$validator.validateAll().then((result) => {
                if (!result) {
                    vm.validateTags();
                    return;
                }

                vm.$store.dispatch("save")
                    .then((response) => {
                        window.flash("The image is updated.", "success");
                        vm.redirect("#/images/" + response.data.data.slug + "/edit");
                    })
                    .catch((error) => {
                        vm.renderErrors(error);
                    });
            });
        }
    }
}
</script>;