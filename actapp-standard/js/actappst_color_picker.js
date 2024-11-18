/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $, ActionAppCore ) {
    ThisApp.actions.actappst_color_picker__select = function(theParams, theTarget) {
        var tmpParams = ThisApp.getActionParams(theParams, theTarget, ['setting','settingval']);
        var tmpID = tmpParams.setting;
        var tmpVal = tmpParams.settingval || '';

        var tmpEl = ThisApp.getByAttr$({'data-customize-setting-link':tmpID});

        console.log('actappst_color_picker__select called',tmpParams,tmpEl);
        tmpEl.get(0).value = tmpVal
        tmpEl.trigger('change');
    }
}( jQuery || $, ActionAppCore ) );

