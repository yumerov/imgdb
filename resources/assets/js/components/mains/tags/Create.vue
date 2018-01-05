<template>
    <section class="section">
        <div class="container">
            <form @submit.prevent ref="form">
                <div :class="{'field': true, 'is-danger': errors.has('name')}">
                    <label class="label">Name</label>
                    <div class="control">
                        <input :class="{'input':true,'is-danger':errors.has('name')}"
                            name="name" type="text" placeholder="Funny"
                            v-model="tag.name" v-validate="'required'">
                        <p class="help is-danger" v-if="errors.has('name')"
                            v-text="errors.first('name')"></p>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button" @click="submit">Create</button>
                        <router-link v-if="tag.lastCreated"
                            class="button is-success"
                            :to="tag.lastCreated">Created tag</router-link>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            tag: {
                name: "",
            },
        }
    },
    methods: {
        resetForm() {
            let vm = this;
            vm.tag.name = "";
            vm.erros.remove("name");
        },
        submit() {
            let vm = this;
            let data = new FormData();
            data.append("name", vm.tag.name);
            window.loading();
            axios.post("/api/tags", data)
                .then((response) => {
                    vm.resetForm();
                    window.flash("The tag is created.", "success");
                    vm.tag.lastCreated = "/tags/" + response.data.data.slug;
                    window.loaded();
                })
                .catch((error) => {
                    let data = error.response.data;
                    window.flash(data.message, "error");
                    let errors = data.errors;
                    for (let field in errors) {
                        vm.errors.add(field, errors[field][0]);
                    }
                    window.loaded();
                })
        }
    }
}
</script>