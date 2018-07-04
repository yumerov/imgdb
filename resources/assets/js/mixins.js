/**
 * @type {{methods: {redirect(*, *=): void}}}
 */
const redirect = {
    methods: {
        /**
         * @param to
         * @param after
         */
        redirect(to, after = 2000) {
            setTimeout(function() {
                window.location.hash = to;
                window.location.reload();
            }, after);
        }
    },
}

/**
 *
 * @type {{methods: {handleFile(*): void, renderFile(): void}}}
 */
const previewFile = {
    methods: {
        /**
         * @param event
         */
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

/**
 *
 * @type {{methods: {validateTags(*): undefined}}}
 */
const validate = {
    methods: {
        /**
         * @param value
         */
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

/**
 * @type {{methods: {renderErrors(*): void}}}
 */
const errors = {
    methods: {
        /**
         * @param error
         */
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