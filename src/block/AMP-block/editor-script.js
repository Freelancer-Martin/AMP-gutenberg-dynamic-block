import { registerBlockType } from '@wordpress/blocks';
import ServerSideRender from '@wordpress/server-side-render';

registerBlockType( 'gutenberg-examples/example-dynamic', {
    title: 'Example: last post',
    icon: 'megaphone',
    category: 'widgets',

    edit: function( props ) {
        return (
            <ServerSideRender
                block="gutenberg-examples/example-dynamic"
                attributes={ props.attributes }
            />
        );
    },
} );
