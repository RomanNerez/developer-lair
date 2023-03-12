import Observer from "$utils/Observer"
import ObjectItem from "./object-items/ObjectItem"

export default class Banner extends Observer {

    _objects = []
    _$elementBannerContainer = null
    _$elementBannerItems = null

    width = 0
    height = 0

    constructor($elementBannerContainer, options = {}) {
        super()
        this._$elementBannerContainer = $elementBannerContainer
        this._$elementBannerItems = this._$elementBannerContainer
            .find('.canvas_banner-items');
        this._initOption(options)
    }

    _initOption(options = {}) {
        for(const key in options) {
            this[key] = options[key]
        }

        this._initSettings()
    }

    _initSettings() {
        this._$elementBannerContainer.css({
            width: `${this.width}px`,
            height: `${this.height}px`,
            marginLeft: `-${this.width / 2}px`,
            marginTop: `-${this.height / 2}px`
        })
    }

    _checkObject(object) {
        if (!(object instanceof ObjectItem)) {
            throw new Error('Error add object')
        }
    }

    add(object) {
        this._checkObject(object)
        this._objects.push(object)
        this.renderAll()
    }

    remove(object) {
        this._checkObject(object)
        this._objects = this._objects.filter(
            obj => obj !== object
        )
        this.renderAll()    
    }

    renderAll() {
        this._$elementBannerItems.empty()
        this._objects.forEach(object => {
            object.init()

            this._$elementBannerItems.append(
                object.$element
            )
        })
    }
}