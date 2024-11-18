/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
    ActionAppCore.common.aw1 = 'true';
    ThisApp.actions.myaw1 = function(theParams, theTarget) {
        var tmpParams = ThisApp.getActionParams(theParams, theTarget, ['setting','settingval']);
        var tmpID = tmpParams.setting;
        var tmpVal = tmpParams.settingval || '';

        var tmpEl = ThisApp.getByAttr$({'data-customize-setting-link':tmpID});

        console.log('myaw1 called',tmpParams,tmpEl);
        tmpEl.get(0).value = tmpVal
        tmpEl.trigger('change');
    }
}( jQuery ) );

