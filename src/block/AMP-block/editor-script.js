(function (blocks, element, serverSideRender) {

    var el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        ServerSideRender = serverSideRender;

    registerBlockType('gutenberg-examples/example-dynamic', {
        title: 'Amp URLs Block',
        icon: 'megaphone',
        category: 'common',

        edit: function (props) {

            return (
                el(ServerSideRender, {
                    block: "gutenberg-examples/example-dynamic",
                    attributes: props.attributes
                })
            );
        },
    });
}(
    window.wp.blocks,
    window.wp.element,
    window.wp.serverSideRender,
));
