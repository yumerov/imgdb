window.events = new window.Vue();

window.flash = function(message, type) {
    window.events.$emit('flash', message, type);
};