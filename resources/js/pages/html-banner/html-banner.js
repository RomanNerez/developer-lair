window.$ = window.jQuery = require("jquery");
import './plugins/resizable';
import './plugins/draggable';
import './plugins/rotatable';

import ObjectItemBuilder from './builder-banner/object-items/builder/ObjectItemBuilder'
import ControlSettings from './tools/control-settings/ControlSettings';
import BannerBuilder from './builder-banner/BannerBuilder';

(function ($) {

    function randomNumber(min, max) {
        return Math.random() * (max - min) + min;
    }

    function main () {
        const $bannerContainer = $('.canvas_banner-container');
        const $addObjectButton = $('button.add-object');
        const $previewButton = $('button.preview-toggle');
        const $controlSettings = $('#control-settings')

        const bannerInstance = new BannerBuilder($bannerContainer, {
            width: randomNumber(100, 600),
            height: randomNumber(100, 600)
        })

        const controlSettings = new ControlSettings($controlSettings)

        bannerInstance.on({
            [BannerBuilder.ON_SELECTED_OBJECT]: ({ object }) => {
                controlSettings.setObject(object)
            },
            [BannerBuilder.ON_CANCEL_SELECT_OBJECT]: () => {
                controlSettings.setObject(null)
            }
        })
        
        $addObjectButton.on('click', function () {
            const objectItem = new ObjectItemBuilder()
            objectItem.set({
                width: 100,
                height: 100
            })
            bannerInstance.add(objectItem)
        })

        $previewButton.on('click', function () {
            bannerInstance.togglePreview()
        })
    }

    $(document).ready(function () {
        main()
    })
    
})(jQuery);