window.events = new window.Vue();

window.flash = function(message, type) {
    window.events.$emit('flash', message, type);
};

window.loading = () => { window.events.$emit('loading'); }
window.loaded = () => { window.events.$emit('loaded'); }