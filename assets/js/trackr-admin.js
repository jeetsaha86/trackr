(function () {
    const {addAction} = window.cf.hooks;

    addAction('carbon-fields.init', 'carbon-fields/metaboxes', () => {
        console.log('carbon fields metaboxes loaded');
    });
})();