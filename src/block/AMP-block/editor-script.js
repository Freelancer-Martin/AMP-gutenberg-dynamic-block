(function (blocks, element, serverSideRender) {

    var el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        ServerSideRender = serverSideRender;

    registerBlockType('gutenberg-examples/example-dynamic', {
        title: 'Amp URLs Block',
        icon: 'megaphone',
        description: 'A dynamic block, block displays in the block editor and the front-end:The total number of URLs validated and the total number of AMP validation errors. These are in a custom taxonomy.',
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
