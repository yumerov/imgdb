const redirect = {
    methods: {
        redirect(to, after = 2000) {
            setTimeout(function() {
                window.location.hash = to;
                window.location.reload();
            }, after);
        }
    },
}

const previewFile = {
    methods: {
        handleFile(event) {
            let vm = this;
            let file = event.target.files[0];
            if (file.type.search("image/") != -1) {
                vm.$store.state.image.file = file;
                vm.renderFile();
            }
        },
        renderFile() {
            let vm = this;
            let file = vm.$store.state.image.file;

            if (file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    vm.$store.state.preview = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        },
    }
}

const validate = {
    methods: {
        validateTags(value) {
            let vm = this;
            vm.$store.state.image.tags = value;
            if (value == null || value.length == 0) {
                vm.errors.add("tags", "Select at least 1 tag.");
                return;
            }

            vm.errors.remove("tags");
        },
    }
}

const errors = {
    methods: {
        renderErrors(error) {
            let data = error.response.data;
            let errors = data.errors;
            for (let field in errors) {
                vm.errors.add(field, errors[field][0]);
            }
        }
    }
}

export { redirect, previewFile, validate, errors }