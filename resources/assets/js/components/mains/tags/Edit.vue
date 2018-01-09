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
    created() {
        let vm = this;
        let url = "/api/tags/" + vm.$route.params.slug;
        axios.get(url)
            .then((response) => {
                vm.tag.name = response.data.data.name;
            })
            .catch((error) => {
                if (error.response.status == 404) {
                    window.flash("Not found", "error");
                    setTimeout(function() {
                        window.location.hash = "#/tags/";
                        window.location.reload();
                    }, 2000);
                    return;
                }
            });
    },
    methods: {
        submit() {
            let vm = this;
            vm.$validator.validateAll().then((result) => {
                let formData = new FormData();
                formData.append("name", vm.tag.name);
                formData.append("_method", "put");
                let url = "/api/tags/" + vm.$route.params.slug;
                axios.post(url, formData)
                    .then((response) => {
                        window.flash("The tag is updated.", "success");
                        setTimeout(function() {
                            window.location.hash = "#/tags/" + response.data.data.slug + "/edit";
                            window.location.reload();
                        }, 2000);
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